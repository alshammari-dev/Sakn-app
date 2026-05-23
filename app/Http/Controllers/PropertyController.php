<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\DynamicExport;
use App\Imports\PropertiesImport;
use Maatwebsite\Excel\Facades\Excel;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:property-list|property-create|property-edit|property-delete', ['only' => ['index','show']]);
        $this->middleware('permission:property-create', ['only' => ['create','store']]);
        $this->middleware('permission:property-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:property-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Property::query();

        if (!auth()->user()->hasRole('admin')) {
            $query->notArchived();
        }

        // Search Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('district', 'like', "%{$search}%");
            });
        }

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $properties = $query->latest()->paginate(10);
    
        return view('properties.index', compact('properties'));
    }

    /**
     * Export properties to Excel
     */
    public function export() 
    {
        $query = Property::query();

        if (!auth()->user()->hasRole('admin')) {
            $query->notArchived();
        }

        $data = $query->get()->map(function($property) {
            return [
                'id' => $property->id,
                'title' => $property->title,
                'city' => $property->city,
                'district' => $property->district,
                'price' => $property->price,
                'status' => $property->status,
                'lat' => $property->lat,
                'lng' => $property->lng,
            ];
        });
        $headings = ['ID', 'Title', 'City', 'District', 'Price', 'Status', 'Latitude', 'Longitude'];

        return Excel::download(new DynamicExport($data, $headings), 'properties.xlsx');
    }

    /**
     * Import properties from Excel
     */
    public function import(Request $request) 
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new PropertiesImport, $request->file('file'));

        return back()->with('success', 'Properties imported successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'ai_description' => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'city'           => 'required|string|max:255',
            'district'       => 'required|string|max:255',
            'lat'            => 'required|numeric|between:-90,90',
            'lng'            => 'required|numeric|between:-180,180',
            'is_archived'    => 'boolean',
        ]);

        $validated['added_by']    = auth()->id();
        $validated['status']      = Property::STATUS_AVAILABLE;
        $validated['is_archived'] = $request->boolean('is_archived');

        Property::create($validated);

        return redirect()->route('properties.index')
            ->with('success', 'Property created successfully. Proceed to upload images and documents.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'title'          => 'sometimes|required|string|max:255',
            'ai_description' => 'nullable|string',
            'price'          => 'sometimes|required|numeric|min:0',
            'city'           => 'sometimes|required|string|max:255',
            'district'       => 'sometimes|required|string|max:255',
            'lat'            => 'nullable|numeric|between:-90,90',
            'lng'            => 'nullable|numeric|between:-180,180',
            'is_archived'    => 'boolean',
        ]);

        $validated['is_archived'] = $request->boolean('is_archived');

        $property->update($validated);

        return redirect()->route('properties.index')
            ->with('success', 'Property details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->route('properties.index')
            ->with('success', 'Property deleted successfully.');
    }
}
