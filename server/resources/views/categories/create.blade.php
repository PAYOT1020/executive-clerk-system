@extends('adminlte::page')

@section('title', 'Add Document Type')

@section('content_header')
    <h1>Add Document Type</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('categories.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">Document Type</label>

                <input
                    type="text"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
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
                    rows="3">{{ old('description') }}</textarea>

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
                    checked>

                <label class="form-check-label">

                    Active

                </label>

            </div>

            <button
                class="btn btn-success">

                Save

        </button>
        <button
                class="btn btn-secondary" href="{{ route('categories.index') }}">

            Cancel


        </button>

            </a>

        </form>

    </div>

</div>

@stop
