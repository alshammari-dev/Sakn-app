@extends('layouts.dashboard')

@section('main')
<main class="p-4 md:p-10 min-h-screen bg-slate-50">
    {{-- Breadcrumbs --}}
    <div class="mb-8">
        <h1 class="text-3xl font-black text-[#2F4F3E]">Transaction Details <span class="text-[#C8A96A]">.</span></h1>
        <nav class="mt-2">
            <ol class="flex text-sm text-slate-500 font-bold uppercase tracking-widest gap-2">
                <li><a href="{{ route('dashboard') }}" class="hover:text-[#C8A96A] transition-colors">Home</a></li>
                <li>/</li>
                <li><a href="{{ route('deposits.index') }}" class="hover:text-[#C8A96A] transition-colors">Deposits</a></li>
                <li>/</li>
                <li class="text-[#C8A96A]">Voucher #{{ $deposit->id }}</li>
            </ol>
        </nav>
    </div>

    <section class="max-w-5xl">
        <div class="bg-white rounded-[2.5rem] shadow-xl overflow-hidden border border-white">
            {{-- Top Header Card --}}
            <div class="bg-[#2F4F3E] p-8 flex justify-between items-center relative overflow-hidden">
                <div class="relative z-10">
                    <h5 class="text-white text-xl font-bold flex items-center gap-3">
                        <i class="fa-solid fa-file-invoice-dollar text-[#C8A96A]"></i>
                        Financial Receipt
                    </h5>
                    <p class="text-white/60 text-xs mt-1 uppercase tracking-widest">Property Reservation Deposit</p>
                </div>
                <div class="text-right z-10">
                    <span class="block text-white/50 text-[10px] uppercase font-black">Method</span>
                    <span class="text-[#C8A96A] font-bold uppercase tracking-widest">{{ str_replace('_', ' ', $deposit->payment_method ?? 'N/A') }}</span>
                </div>
                {{-- Decorative Circle --}}
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/5 rounded-full"></div>
            </div>

            <div class="p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-12">
                    
                    {{-- Column 1: Property & Offer --}}
                    <div class="space-y-6">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                <i class="fa-solid fa-house text-[#C8A96A]"></i> Property Info
                            </label>
                            <p class="text-lg font-extrabold text-[#2F4F3E] leading-tight">{{ $deposit->property->title ?? 'N/A' }}</p>
                            <p class="text-xs text-slate-500 font-bold">{{ $deposit->property->city ?? '' }}</p>
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                <i class="fa-solid fa-handshake text-[#C8A96A]"></i> Linked Offer
                            </label>
                            @if($deposit->offer_id)
                                <a href="{{ route('offers.show', $deposit->offer_id) }}" class="text-sm font-bold text-[#C8A96A] hover:underline">
                                    View Offer #{{ $deposit->offer_id }} <i class="fa-solid fa-arrow-up-right-from-square text-[10px] ml-1"></i>
                                </a>
                            @else
                                <p class="text-sm font-bold text-slate-400 italic">Direct Deposit (No Offer)</p>
                            @endif
                        </div>
                    </div>

                    {{-- Column 2: Client & Agent --}}
                    <div class="space-y-6">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                <i class="fa-solid fa-user-tie text-[#C8A96A]"></i> Beneficiary (Client)
                            </label>
                            <p class="text-lg font-extrabold text-[#2F4F3E]">{{ $deposit->client->name ?? 'N/A' }}</p>
                            <p class="text-xs text-slate-500 font-medium">{{ $deposit->client->email ?? '' }}</p>
                        </div>

                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                                <i class="fa-solid fa-user-check text-[#C8A96A]"></i> Processed By
                            </label>
                            <div class="flex items-center gap-2 mt-1">
                                <div class="w-6 h-6 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-[8px] font-black text-[#2F4F3E]">
                                    {{ strtoupper(substr($deposit->approvedBy->name ?? 'S', 0, 1)) }}
                                </div>
                                <p class="font-bold text-sm text-slate-700">{{ $deposit->approvedBy->name ?? 'System' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Column 3: Amount & Status --}}
                    <div class="bg-slate-50 p-6 rounded-3xl border border-slate-100 flex flex-col justify-center text-center">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Total Amount Received</label>
                        <p class="text-4xl font-black text-[#2F4F3E] tracking-tighter mb-4">
                            ${{ number_format($deposit->amount, 2) }}
                        </p>
                        
                        @php
                            $statusStyles = [
                                'pending' => 'bg-amber-500 text-white shadow-amber-200',
                                'approved' => 'bg-green-600 text-white shadow-green-200',
                                'rejected' => 'bg-red-500 text-white shadow-red-200',
                                'refunded' => 'bg-slate-600 text-white shadow-slate-200',
                            ];
                            $btnStyle = $statusStyles[$deposit->status] ?? 'bg-slate-400 text-white';
                        @endphp
                        <span class="inline-block px-4 py-1.5 rounded-xl text-[10px] font-black uppercase shadow-lg {{ $btnStyle }}">
                            {{ $deposit->status }}
                        </span>
                    </div>
                </div>

                {{-- Receipt & Evidence Section --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                    {{-- Left: Details --}}
                    <div class="space-y-6">
                        <div class="bg-white border-l-4 border-[#C8A96A] p-4 rounded-r-2xl shadow-sm">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Transaction Timestamp</label>
                            <p class="font-bold text-[#2F4F3E]">
                                {{ $deposit->paid_at ? \Carbon\Carbon::parse($deposit->paid_at)->format('F d, Y - H:i A') : 'Not Timestamped' }}
                            </p>
                        </div>

                        <div class="p-6 bg-[#2F4F3E]/5 rounded-3xl border border-[#2F4F3E]/10">
                            <p class="text-xs font-black text-[#2F4F3E] uppercase mb-3 flex items-center gap-2">
                                <i class="fa-solid fa-shield-halved"></i> Verification Note
                            </p>
                            <p class="text-sm text-slate-600 leading-relaxed italic">
                                This deposit confirms the serious intent of the client to proceed with the acquisition of the listed property. 
                                Upon "Approved" status, the property is automatically marked as <b>Reserved</b> in the global inventory.
                            </p>
                        </div>
                    </div>

                    {{-- Right: Receipt Preview --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest flex justify-between">
                            <span>Payment Evidence</span>
                            @if($deposit->receipt_url)
                                <a href="{{ asset('storage/' . $deposit->receipt_url) }}" target="_blank" class="text-[#C8A96A] hover:underline lowercase">View Full File</a>
                            @endif
                        </label>
                        
                        <div class="aspect-video bg-slate-100 rounded-3xl border-2 border-dashed border-slate-200 overflow-hidden flex items-center justify-center group relative">
                            @if($deposit->receipt_url)
                                @if(Str::endsWith($deposit->receipt_url, ['.pdf']))
                                    <div class="text-center">
                                        <i class="fa-solid fa-file-pdf text-4xl text-red-500 mb-2"></i>
                                        <p class="text-xs font-bold text-slate-500 uppercase">PDF Document</p>
                                    </div>
                                @else
                                    <img src="{{ asset('storage/' . $deposit->receipt_url) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @endif
                            @else
                                <div class="text-center p-8">
                                    <i class="fa-solid fa-image-slash text-3xl text-slate-300 mb-2"></i>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">No Receipt Attachment Uploaded</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Footer Actions --}}
                <div class="mt-12 pt-8 border-t border-slate-100 flex flex-wrap gap-4 justify-between items-center">
                    <a href="{{ route('deposits.index') }}" class="text-slate-400 hover:text-[#2F4F3E] font-bold uppercase text-[10px] tracking-[0.2em] flex items-center gap-2 transition-all">
                        <i class="fa-solid fa-arrow-left"></i> Return to Registry
                    </a>
                    
                    <div class="flex gap-3">
                        <button onclick="window.print()" class="bg-slate-100 text-[#2F4F3E] px-6 py-3 rounded-2xl font-bold uppercase text-[10px] tracking-widest hover:bg-slate-200 transition-all">
                            <i class="fa-solid fa-print mr-2"></i> Print Receipt
                        </button>
                        <a href="{{ route('deposits.edit', $deposit->id) }}" class="bg-[#C8A96A] text-white px-8 py-3 rounded-2xl font-bold uppercase text-[10px] tracking-widest hover:bg-[#2F4F3E] transition-all shadow-lg shadow-amber-900/20">
                            <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- منطقة العمليات النهائية - تظهر فقط إذا كان العربون مقبولاً والعقار محجوزاً --}}
@if($deposit->status === 'approved' && $deposit->property->status === 'reserved')
    <div class="mt-8 p-6 border-2 border-dashed border-green-200 rounded-[2rem] bg-green-50/50">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h4 class="text-[#2F4F3E] font-black flex items-center gap-2">
                    <i class="fa-solid fa-handshake-lock text-green-600"></i>
                    Ready for Final Closing?
                </h4>
                <p class="text-sm text-slate-600">This deposit is approved. You can now officially record this as a <b>Final Sale</b>.</p>
            </div>
            
            {{-- زر فتح المودل --}}
            <button type="button" data-bs-toggle="modal" data-bs-target="#finalizeSaleModal" 
                class="bg-green-600 text-white px-8 py-3 rounded-xl font-bold uppercase text-xs tracking-widest hover:bg-[#2F4F3E] transition-all shadow-lg shadow-green-900/20">
                <i class="fa-solid fa-file-signature mr-2"></i> Finalize Sale & Mark as Sold
            </button>
        </div>
    </div>

    {{-- Modal: إتمام البيع نهائياً --}}
    <div class="modal fade" id="finalizeSaleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-[2rem] border-0 shadow-2xl">
                <form action="{{ route('sale-approvals.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="property_id" value="{{ $deposit->property_id }}">
                    <input type="hidden" name="deposit_id" value="{{ $deposit->id }}">

                    <div class="modal-header border-0 p-8 pb-0">
                        <h5 class="text-2xl font-black text-[#2F4F3E]">Confirm Final Sale</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-8">
                        <div class="mb-4">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2 text-start">Closing Notes (Optional)</label>
                            <textarea name="notes" rows="4" 
                                class="w-full rounded-2xl border-slate-200 focus:border-[#C8A96A] focus:ring-[#C8A96A] p-4 text-sm" 
                                placeholder="Add any final contract details, payment references, or handover notes..."></textarea>
                        </div>
                        
                        <div class="bg-amber-50 p-4 rounded-2xl border border-amber-100">
                            <p class="text-[10px] text-amber-700 leading-relaxed font-bold italic">
                                <i class="fa-solid fa-circle-info mr-1"></i> 
                                Warning: This action will permanently change the property status to <b>SOLD</b> and lock this transaction.
                            </p>
                        </div>
                    </div>

                    <div class="modal-footer border-0 p-8 pt-0 flex gap-3">
                        <button type="button" class="flex-1 py-4 text-xs font-bold uppercase tracking-widest text-slate-400" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="flex-1 py-4 bg-[#2F4F3E] text-white rounded-2xl font-bold uppercase text-xs tracking-widest hover:bg-black transition-all">
                            Confirm & Close Deal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

{{-- في حال كان العقار تم بيعه فعلاً --}}
@if($deposit->property->status === 'sold')
    <div class="mt-8 p-6 bg-slate-900 rounded-[2rem] text-center">
        <h4 class="text-[#C8A96A] font-black flex items-center justify-center gap-2">
            <i class="fa-solid fa-award"></i>
            TRANSACTION COMPLETED
        </h4>
        <p class="text-white/60 text-xs mt-1 uppercase tracking-[0.3em]">This property has been officially sold</p>
    </div>
@endif
    </section>
</main>

<style>
    @media print {
        nav, button, a, .no-print { display: none !important; }
        main { padding: 0 !important; background: white !important; }
        .bg-white { shadow: none !important; border: none !important; }
    }
</style>
@endsection
