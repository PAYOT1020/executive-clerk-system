@extends('adminlte::page')

@section('title', 'Document Archive')

@section('content_header')
    <h1>Document Archive</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Completed &amp; Archived Documents</h3>
    </div>

    <div class="card-body">

        <form method="GET" action="{{ route('archive.index') }}" class="row g-2 mb-3">

            <div class="col-md-4">
                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search tracking no., subject, or sender"
                    value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <select name="category_id" class="form-control">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>



            <div class="col-md-2">
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
                    <th>Received By</th>
                    <th>Status</th>
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
                    <td>{{ $document->receivedBy->name ?? '—' }}</td>
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
                    <td class="text-center">
                        <a href="{{ route('documents.show', $document) }}" class="btn btn-sm btn-info">
                            View
                        </a>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="8" class="text-center">
                        No completed or archived documents yet.
                    </td>
                </tr>
            @endforelse

            </tbody>

        </table>

        <div class="mt-3">
            {{ $documents->links() }}
        </div>

    </div>

</div>

@stop
