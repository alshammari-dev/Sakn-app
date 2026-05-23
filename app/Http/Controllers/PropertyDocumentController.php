<?php

namespace App\Http\Controllers;

use App\Models\PropertyDocument;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyDocumentController extends Controller
{
     public function __construct()
    {
         $this->middleware('permission:document-list|document-create|document-edit|document-delete', ['only' => ['index','show']]);
         $this->middleware('permission:document-create', ['only' => ['create','store']]);
         $this->middleware('permission:document-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:document-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $propertyId = $request->get('property_id');
        $property   = Property::findOrFail($propertyId);
        $documents  = $property->documents;

        return view('property_documents.index', compact('property', 'documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $propertyId = $request->get('property_id');
        $property   = Property::findOrFail($propertyId);

        return view('property_documents.create', compact('property'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'doc_type'    => 'required|in:ownership_deed,floor_plan,other',
            'file'        => 'required|file|mimes:pdf,jpeg,png,jpg|max:5120',
            'is_private'  => 'required|boolean',
        ]);

        if ($request->hasFile('file')) {
            $validated['file_url'] = $request->file('file')->store('properties/documents', 'public');
            PropertyDocument::create($validated);
        }

        return redirect()->route('property-documents.index', ['property_id' => $validated['property_id']])
            ->with('success', 'Document uploaded successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyDocument $propertyDocument)
    {
        $property = $propertyDocument->property;

        return view('property_documents.edit', [
            'document' => $propertyDocument,
            'property' => $property
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PropertyDocument $propertyDocument)
    {
        $validated = $request->validate([
            'doc_type'   => 'required|in:ownership_deed,floor_plan,other',
            'is_private' => 'required|boolean',
        ]);

        $propertyDocument->update($validated);

        return redirect()->route('property-documents.index', ['property_id' => $propertyDocument->property_id])
            ->with('success', 'Document updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyDocument $propertyDocument)
    {
        $propertyId = $propertyDocument->property_id;

        if (Storage::disk('public')->exists($propertyDocument->file_url)) {
            Storage::disk('public')->delete($propertyDocument->file_url);
        }

        $propertyDocument->delete();

        return redirect()->route('property-documents.index', ['property_id' => $propertyId])
            ->with('success', 'Document deleted successfully.');
    }
}
