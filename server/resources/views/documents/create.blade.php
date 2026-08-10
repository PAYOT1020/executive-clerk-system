@extends('adminlte::page')

@section('title', 'Receive Document')

@section('content_header')
    <h1>Receive Document</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">Document Type</label>

                    <select
                        name="category_id"
                        class="form-control @error('category_id') is-invalid @enderror"
                        required>

                        <option value="">-- Select Document Type --</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                        value="{{ old('date_received', now()->format('Y-m-d')) }}"
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
                    value="{{ old('subject') }}"
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
                    value="{{ old('sender') }}"
                    required>

                @error('sender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <div class="mb-3">

                <label class="form-label">Assign To (Executive Clerk)</label>

                <select name="assigned_to" class="form-control @error('assigned_to') is-invalid @enderror">

                    <option value="">-- Leave Unassigned --</option>

                    @foreach($executiveClerks as $clerk)
                        <option value="{{ $clerk->id }}" {{ old('assigned_to') == $clerk->id ? 'selected' : '' }}>
                            {{ $clerk->name }}
                        </option>
                    @endforeach

                </select>

                @error('assigned_to')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <div class="mb-3">

                <label class="form-label">Attach File (optional)</label>

                <input
                    type="file"
                    name="document_file"
                    class="form-control @error('document_file') is-invalid @enderror"
                    accept=".pdf,.jpg,.jpeg,.png">

                <small class="form-text text-muted">Accepted: PDF, JPG, PNG. Max 10MB.</small>

                @error('document_file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <div class="mb-3">

                <label class="form-label">Remarks</label>

                <textarea
                    name="remarks"
                    class="form-control @error('remarks') is-invalid @enderror"
                    rows="3">{{ old('remarks') }}</textarea>

                @error('remarks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <button class="btn btn-success">Save</button>

            <a href="{{ route('documents.index') }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>

</div>

@stop
