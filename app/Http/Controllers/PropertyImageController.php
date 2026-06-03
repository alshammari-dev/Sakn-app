<?php

namespace App\Http\Controllers;

use App\Models\PropertyImage;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyImageController extends Controller
{

    public function __construct()
    {
         $this->middleware('permission:Property image list|Property image create|Property image edit|Property image delete', ['only' => ['index','show']]);
         $this->middleware('permission:Property image create', ['only' => ['create','store']]);
         $this->middleware('permission:Property image edit', ['only' => ['edit','update']]);
         $this->middleware('permission:Property image delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $propertyId = $request->get('property_id');
        $property   = Property::findOrFail($propertyId);
        $images     = $property->images;

        return view('property_images.index', compact('property', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $propertyId = $request->get('property_id');
        $property   = Property::findOrFail($propertyId);

        return view('property_images.create', compact('property'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_main'     => 'boolean',
            'sort_order'  => 'required|integer|min:0',
        ]);

        $validated['is_main'] = $request->boolean('is_main');

        if ($validated['is_main']) {
            PropertyImage::where('property_id', $validated['property_id'])->update(['is_main' => 0]);
        }

        if ($request->hasFile('image')) {
            $validated['url'] = $request->file('image')->store('properties/images', 'public');
            PropertyImage::create($validated);
        }

        return redirect()->route('property-images.index', ['property_id' => $validated['property_id']])
            ->with('success', 'Image uploaded successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyImage $propertyImage)
    {
        return view('property_images.edit', [
            'image' => $propertyImage
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PropertyImage $propertyImage)
    {
        $validated = $request->validate([
            'sort_order' => 'required|integer|min:0',
            'is_main'    => 'boolean',
        ]);

        $validated['is_main'] = $request->boolean('is_main');

        if ($validated['is_main']) {
            PropertyImage::where('property_id', $propertyImage->property_id)
                ->where('id', '!=', $propertyImage->id)
                ->update(['is_main' => 0]);
        }

        $propertyImage->update($validated);

        return redirect()->route('property-images.index', ['property_id' => $propertyImage->property_id])
            ->with('success', 'Image details updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyImage $propertyImage)
    {
        $propertyId = $propertyImage->property_id;

        if (Storage::disk('public')->exists($propertyImage->url)) {
            Storage::disk('public')->delete($propertyImage->url);
        }
        
        $propertyImage->delete();

        return redirect()->route('property-images.index', ['property_id' => $propertyId])
            ->with('success', 'Image deleted successfully.');
    }
}
