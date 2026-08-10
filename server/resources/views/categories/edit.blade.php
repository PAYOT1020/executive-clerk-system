@extends('adminlte::page')

@section('title', 'Edit Document Type')

@section('content_header')
    <h1>Edit Document Type</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('categories.update', $category) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">Document Type</label>

                <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $category->name) }}"
                    required>

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <div class="mb-3">

                <label class="form-label">Description</label>

                <textarea
                    name="description"
                    class="form-control @error('description') is-invalid @enderror"
                    rows="3">{{ old('description', $category->description) }}</textarea>

                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-check mb-3">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="is_active"
                    value="1"
                    {{ old('is_active', $category->is_active) ? 'checked' : '' }}>

                <label class="form-check-label">
                    Active
                </label>

            </div>

            <button class="btn btn-success">Update</button>

            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>

</div>

@stop
