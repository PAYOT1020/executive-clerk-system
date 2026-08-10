@extends('adminlte::page')

@section('title', 'Document Details')

@section('content_header')
    <h1>{{ $document->tracking_number }}</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="row">

    <div class="col-md-8">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Document Information</h3>
            </div>

            <div class="card-body">

                <dl class="row">

                    <dt class="col-sm-3">Subject</dt>
                    <dd class="col-sm-9">{{ $document->subject }}</dd>

                    <dt class="col-sm-3">Sender</dt>
                    <dd class="col-sm-9">{{ $document->sender }}</dd>

                    <dt class="col-sm-3">Category</dt>
                    <dd class="col-sm-9">{{ $document->category->name ?? '—' }}</dd>

                    <dt class="col-sm-3">Date Received</dt>
                    <dd class="col-sm-9">{{ $document->date_received->format('M d, Y') }}</dd>

                    <dt class="col-sm-3">Received By</dt>
                    <dd class="col-sm-9">{{ $document->receivedBy->name ?? '—' }}</dd>

                    <dt class="col-sm-3">Currently Assigned To</dt>
                    <dd class="col-sm-9">{{ $document->assignedTo->name ?? 'Unassigned' }}</dd>

                    <dt class="col-sm-3">Remarks</dt>
                    <dd class="col-sm-9">{{ $document->remarks ?? '—' }}</dd>

                </dl>

                <a href="{{ route('documents.edit', $document) }}" class="btn btn-sm btn-warning">
                    Edit Details
                </a>

            </div>

        </div>

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Attached Files</h3>
            </div>

            <div class="card-body">

                @forelse($document->files as $file)

                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                        <div>
                            <strong>{{ $file->original_name }}</strong>
                            <br>
                            <small class="text-muted">
                                {{ strtoupper(pathinfo($file->original_name, PATHINFO_EXTENSION)) }}
                                &middot; {{ number_format($file->file_size / 1024, 1) }} KB
                                &middot; Uploaded {{ $file->created_at->format('M d, Y') }}
                            </small>
                        </div>

                        <a href="{{ Storage::url($file->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            View / Download
                        </a>

                    </div>

                @empty

                    <p class="text-muted mb-0">No files attached to this document.</p>

                @endforelse

            </div>

        </div>

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Status History</h3>
            </div>

            <div class="card-body">

                <div class="timeline">

                    @forelse($document->statusHistories->sortByDesc('created_at') as $history)

                        <div class="mb-3 pb-3 border-bottom">

                            <span class="badge bg-primary">
                                {{ ucfirst(str_replace('_', ' ', $history->status)) }}
                            </span>

                            <span class="text-muted ms-2">
                                {{ $history->created_at->format('M d, Y g:i A') }}
                                by {{ $history->updatedBy->name ?? 'Unknown' }}
                            </span>

                            @if($history->remarks)
                                <p class="mb-0 mt-1">{{ $history->remarks }}</p>
                            @endif

                        </div>

                    @empty

                        <p class="text-muted mb-0">No status history yet.</p>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Update Status</h3>
            </div>

            <div class="card-body">

                <form action="{{ route('documents.status.update', $document) }}" method="POST">

                    @csrf
                    @method('PATCH')

                    <div class="mb-3">

                        <label class="form-label">New Status</label>

                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>

                            @foreach(['received', 'checking', 'for_signature', 'signed', 'released', 'archived'] as $status)
                                <option value="{{ $status }}" {{ $document->current_status === $status ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                </option>
                            @endforeach

                        </select>

                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Remarks</label>

                        <textarea name="remarks" class="form-control" rows="2"></textarea>

                    </div>

                    <button class="btn btn-primary w-100">Update Status</button>

                </form>

            </div>

        </div>

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">Assignment</h3>
            </div>

            <div class="card-body">

                <p>
                    Currently assigned to:
                    <strong>{{ $document->assignedTo->name ?? 'Unassigned' }}</strong>
                </p>

                <a href="{{ route('documents.assign.form', $document) }}" class="btn btn-secondary w-100">
                    Reassign Document
                </a>

            </div>

        </div>

    </div>

</div>

@stop
