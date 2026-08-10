@extends('adminlte::page')

@section('title', 'Document Types')

@section('content_header')
    <h1>Document Types</h1>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card">
    <div class="card-header d-flex align-items-center">
        <h3 class="card-title">List of Document Types</h3>
        <a href="{{ route('categories.create') }}" class="btn btn-primary" style="margin-left: auto;">
            <i class="fas fa-plus"></i> Add Document Type
        </a>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th class="text-center" style="width: 150px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description ?: '—' }}</td>
                        <td>
                            @if($category->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                            <form action="{{ route('categories.destroy', $category) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Delete this document type?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No document types found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

@stop
