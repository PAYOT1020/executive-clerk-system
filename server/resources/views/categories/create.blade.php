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
                    class="form-control"
                    value="{{ old('name') }}"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">Description</label>

                <textarea
                    name="description"
                    class="form-control"
                    rows="3">{{ old('description') }}</textarea>

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

            <a
                href="{{ route('categories.index') }}"
                class="btn btn-secondary">

                Cancel

            </a>

        </form>

    </div>

</div>

@stop
