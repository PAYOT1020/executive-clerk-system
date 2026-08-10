@extends('adminlte::page')

@section('title', 'Edit Document')

@section('content_header')
    <h1>Edit Document — {{ $document->tracking_number }}</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('documents.update', $document) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">Document Type</label>

                    <select
                        name="category_id"
                        class="form-control @error('category_id') is-invalid @enderror"
                        required>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $document->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>

                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Date Received</label>

                    <input
                        type="date"
                        name="date_received"
                        class="form-control @error('date_received') is-invalid @enderror"
                        value="{{ old('date_received', $document->date_received->format('Y-m-d')) }}"
                        required>

                    @error('date_received')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>

            </div>

            <div class="mb-3">

                <label class="form-label">Subject</label>

                <input
                    type="text"
                    name="subject"
                    class="form-control @error('subject') is-invalid @enderror"
                    value="{{ old('subject', $document->subject) }}"
                    required>

                @error('subject')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <div class="mb-3">

                <label class="form-label">Sender</label>

                <input
                    type="text"
                    name="sender"
                    class="form-control @error('sender') is-invalid @enderror"
                    value="{{ old('sender', $document->sender) }}"
                    required>

                @error('sender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <button class="btn btn-success">Update</button>

            <a href="{{ route('documents.show', $document) }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>

</div>

@stop
