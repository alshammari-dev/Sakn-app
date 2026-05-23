<?php
namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Property;
use App\Models\User;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Exports\DynamicExport;
use Maatwebsite\Excel\Facades\Excel;

class DepositController extends Controller
{
    public function __construct()
    {
         $this->middleware('permission:deposit-list|deposit-create|deposit-edit|deposit-delete', ['only' => ['index','show']]);
         $this->middleware('permission:deposit-create', ['only' => ['create','store']]);
         $this->middleware('permission:deposit-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:deposit-delete', ['only' => ['destroy']]);
    }

    /**
     * 1. عرض قائمة العرابين (الرادار)
     */
    public function index(Request $request)
    {
        $query = Deposit::with(['property', 'client', 'approvedBy']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('property', function($pq) use ($search) {
                    $pq->where('title', 'like', "%{$search}%");
                })->orWhereHas('client', function($cq) use ($search) {
                    $cq->where('name', 'like', "%{$search}%");
                });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $deposits = $query->latest()->paginate(15);

        return view('deposits.index', compact('deposits'));
    }

    /**
     * Export deposits to Excel
     */
    public function export() 
    {
        $data = Deposit::with(['property', 'client'])->get()->map(function($deposit) {
            return [
                'id' => $deposit->id,
                'property' => $deposit->property->title ?? '-',
                'client' => $deposit->client->name ?? '-',
                'amount' => $deposit->amount,
                'status' => $deposit->status,
                'paid_at' => $deposit->paid_at ? $deposit->paid_at->format('Y-m-d H:i:s') : '-',
            ];
        });
        $headings = ['ID', 'Property', 'Client', 'Amount', 'Status', 'Paid At'];

        return Excel::download(new DynamicExport($data, $headings), 'deposits.xlsx');
    }

    /**
     * 2. واجهة إنشاء عربون جديد
     */
    public function create()
    {
        $properties = Property::whereIn('status', ['available', 'under_negotiation'])->get();
        $clients = User::role('client')->get();

        $offers = Offer::with(['client', 'property'])
        ->whereIn('status', ['pending', 'accepted'])
        ->latest()
        ->get();
        
        return view('deposits.create', compact('properties', 'clients' , 'offers'));
    }

    /**
     * 3. حفظ العربون (The Store Engine)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'property_id'    => 'required|exists:properties,id',
            'client_id'      => 'required|exists:users,id',
            'offer_id'       => 'nullable|exists:offers,id',
            'payment_method' => 'required|in:cash,bank_transfer,online',
            'amount'         => 'required|numeric|min:0',
            'status'         => 'required|in:pending,approved,rejected,refunded',
            'receipt'        => 'nullable|file|image|mimes:jpeg,png,jpg,pdf|max:5120',
            'paid_at'        => 'nullable|date',
        ]);

        return DB::transaction(function () use ($request, $data) {
            // معالجة ملف الوصل إذا تم رفعه
            if ($request->hasFile('receipt')) {
                $data['receipt_url'] = $request->file('receipt')->store('receipts', 'public');
            }

            // إنشاء السجل
            $deposit = Deposit::create($data + [
                'approved_by' => auth()->id(), // الموظف المنشئ
                'paid_at'     => $data['paid_at'] ?? now(),
            ]);

            // تفعيل تأثير الدومينو (تحويل العقار لـ Reserved)
            $deposit->property->syncStatus();

            return redirect()->route('deposits.index')
                ->with('success', 'تم تسجيل العربون وحجز العقار بنجاح.');
        });
    }

    /**
     * 4. عرض تفاصيل العربون (المراجعة)
     */
    public function show(Deposit $deposit)
    {
        $deposit->load(['property', 'client', 'approvedBy',]);
        return view('deposits.show', compact('deposit'));
    }

    /**
     * 5. الموافقة الرسمية (The Approver)
     */
    public function approve(Deposit $deposit)
    {
        return DB::transaction(function () use ($deposit) {
            $deposit->update([
                'status'      => Deposit::STATUS_APPROVED,
                'approved_by' => auth()->id(),
            ]);

            $deposit->property->syncStatus();

            return back()->with('success', 'تم اعتماد العربون، الحجز الآن نهائي.');
        });
    }

    /**
     * 6. الرفض وإعادة الفتح (The Rejection)
     */
    public function reject(Request $request, Deposit $deposit)
    {
        return DB::transaction(function () use ($request, $deposit) {
            $deposit->update([
                'status'      => Deposit::STATUS_REJECTED,
                'approved_by' => auth()->id(),
            ]);

            $deposit->property->syncStatus();

            return back()->with('warning', 'تم رفض العربون وتحديث حالة العقار بناءً على الطلبات الأخرى.');
        });
    }

    /**
     * 7. التعديل (Update)
     */
    public function update(Request $request, Deposit $deposit)
    {
        $data = $request->validate([
            'property_id'    => 'sometimes|required|exists:properties,id',
            'client_id'      => 'sometimes|required|exists:users,id',
            'offer_id'       => 'nullable|exists:offers,id',
            'payment_method' => 'sometimes|required|in:cash,bank_transfer,online',
            'amount'         => 'sometimes|required|numeric|min:0',
            'status'         => 'sometimes|required|in:pending,approved,rejected,refunded',
            'receipt'        => 'nullable|file|image|mimes:jpeg,png,jpg,pdf|max:5120',
            'paid_at'        => 'nullable|date',
        ]);

        return DB::transaction(function () use ($request, $deposit, $data) {
            // إذا رفع وصلاً جديداً، نحذف القديم ونخزن الجديد
            if ($request->hasFile('receipt')) {
                if ($deposit->receipt_url) {
                    Storage::disk('public')->delete($deposit->receipt_url);
                }
                $data['receipt_url'] = $request->file('receipt')->store('receipts', 'public');
            }

            $deposit->update($data);

            // إعادة مزامنة الحالة (لأنه قد يغير مبلغاً أو حالة تؤثر على العقار)
            $deposit->property->syncStatus();

            return redirect()->route('deposits.index')->with('success', 'تم تحديث بيانات العربون.');
        });
    }

    /**
     * 8. الحذف (Destroy)
     */
    public function destroy(Deposit $deposit)
    {
        $property = $deposit->property;
        $deposit->delete();

        // بعد الحذف، العقار يجب أن يعيد فحص نفسه
        $property->syncStatus();

        return redirect()->route('deposits.index')->with('danger', 'تم حذف سجل العربون وتحديث حالة العقار.');
    }
}