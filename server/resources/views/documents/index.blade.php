@extends('adminlte::page')

@section('title', 'Documents')

@section('content_header')
    <h1>Documents</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title">Document Registry</h3>

        <a href="{{ route('documents.create') }}" class="btn btn-primary" style="margin-left: auto;">
            Receive Document
        </a>

    </div>

    <div class="card-body">

        <form method="GET" action="{{ route('documents.index') }}" class="row g-2 mb-3">

            <div class="col-md-5">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search tracking no., subject, or sender"
                    value="{{ request('search') }}">
            </div>

            <div class="col-md-4">
                <select name="status" class="form-control">
                    <option value="">All Statuses</option>
                    @foreach(['received', 'checking', 'for_signature', 'signed', 'released', 'archived'] as $status)
                        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-secondary w-100">Filter</button>
            </div>

        </form>

        <table class="table table-bordered table-hover">

            <thead>
                <tr>
                    <th>Tracking No.</th>
                    <th>Subject</th>
                    <th>Sender</th>
                    <th>Category</th>
                    <th>Date Received</th>
                    <th>Status</th>
                    <th>Assigned To</th>
                    <th class="text-center" style="width: 100px;">Action</th>
                </tr>
            </thead>

            <tbody>

            @forelse($documents as $document)

                <tr>
                    <td>{{ $document->tracking_number }}</td>
                    <td>{{ $document->subject }}</td>
                    <td>{{ $document->sender }}</td>
                    <td>{{ $document->category->name ?? '—' }}</td>
                    <td>{{ $document->date_received->format('M d, Y') }}</td>
                    <td>
                        @php
                            $statusColors = [
                                'received' => 'secondary',
                                'checking' => 'info',
                                'for_signature' => 'warning',
                                'signed' => 'primary',
                                'released' => 'success',
                                'archived' => 'dark',
                            ];
                        @endphp
                        <span class="badge bg-{{ $statusColors[$document->current_status] ?? 'secondary' }}">
                            {{ ucfirst(str_replace('_', ' ', $document->current_status)) }}
                        </span>
                    </td>
                    <td>{{ $document->assignedTo->name ?? 'Unassigned' }}</td>
                    <td class="text-center">
                        <a href="{{ route('documents.show', $document) }}" class="btn btn-sm btn-info">
                            View
                        </a>
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="8" class="text-center">
                        No documents found.
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

        {{ $documents->links() }}

    </div>

</div>

@stop
