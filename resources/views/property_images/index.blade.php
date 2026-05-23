@extends('layouts.dashboard')

@section('main')
    <x-sakn-index-page 
        title="Images: {{ $property->title }} Property" 
        subtitle="Manage gallery and visual assets for this property"
        :createRoute="route('property-images.create', ['property_id' => $property->id])"
        createLabel="Add New Image"
        :backRoute="route('properties.index')"
    >
        <table class="table sakn-table align-middle">
            <thead>
                <tr>
                    <th>Preview</th>
                    <th>Sort Order</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($images as $image)
                    <tr>
                        <td>
                            <div class="sakn-image-preview">
                                <img src="{{ asset('storage/' . $image->url) }}" class="rounded-3 shadow-sm" style="width: 100px; height: 70px; object-fit: cover;">
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                <i class="bi bi-sort-numeric-down me-1"></i> {{ $image->sort_order }}
                            </span>
                        </td>
                        <td>
                            <x-sakn-status-badge :status="$image->is_main ? 'main' : 'gallery'" type="image" />
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ asset('storage/' . $image->url) }}" target="_blank" class="sakn-action-btn" title="View Full">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('property-images.edit', $image->id) }}" class="sakn-action-btn" title="Edit Order">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('property-images.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Delete this image?');" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="sakn-action-btn sakn-action-btn-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <i class="bi bi-images display-1 text-light mb-3 d-block"></i>
                            <p class="text-muted">No images found for this property.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-sakn-index-page>
@endsection
