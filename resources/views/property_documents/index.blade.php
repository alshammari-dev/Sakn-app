@extends('layouts.dashboard')

@section('main')
    <x-sakn-index-page 
        title="Documents: {{ $property->title }}" 
        subtitle="Manage legal documents and private files for this property"
        :createRoute="route('property-documents.create', ['property_id' => $property->id])"
        createLabel="Add New Document"
        :backRoute="route('properties.index')"
    >
        <table class="table sakn-table align-middle">
            <thead>
                <tr>
                    <th class="ps-4">Document Type</th>
                    <th>Privacy</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($documents as $document)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="sakn-icon-circle me-3">
                                    <i class="bi bi-file-earmark-text text-primary"></i>
                                </div>
                                <div>
                                    <span class="text-capitalize fw-bold d-block text-dark">{{ str_replace('_', ' ', $document->doc_type) }}</span>
                                    <small class="text-muted">ID: #{{ $document->id }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($document->is_private)
                                <span class="status-badge shadow-sm" style="background-color: #F5F2EC; color: #2F4F3E; border: 1px solid #C8A96A;">
                                    <i class="bi bi-lock-fill me-2"></i> PRIVATE
                                </span>
                            @else
                                <span class="status-badge shadow-sm" style="background-color: #C8A96A; color: white;">
                                    <i class="bi bi-globe me-2"></i> PUBLIC
                                </span>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ asset('storage/' . $document->file_url) }}" target="_blank" class="sakn-action-btn" title="Download">
                                    <i class="bi bi-download"></i>
                                </a>
                                <a href="{{ route('property-documents.edit', $document->id) }}" class="sakn-action-btn" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('property-documents.destroy', $document->id) }}" method="POST" onsubmit="return confirm('Delete this document?');" class="d-inline">
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
                        <td colspan="3" class="text-center py-5">
                            <i class="bi bi-file-earmark-lock display-1 text-light mb-3 d-block"></i>
                            <p class="text-muted">No documents found for this property.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-sakn-index-page>
@endsection
