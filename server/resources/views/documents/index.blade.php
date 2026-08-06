@extends('adminlte::page')

@section('title', 'Documents')

@section('content_header')
    <h1>Document Repository</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">

    <div class="card-header">

        <a href="{{ route('documents.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Receive Document
        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>

                <tr>
                    <th>Tracking No.</th>
                    <th>Type</th>
                    <th>Subject</th>
                    <th>Sender</th>
                    <th>Status</th>
                    <th>Assigned To</th>
                </tr>

            </thead>

            <tbody>

            @forelse($documents as $document)

                <tr>

                    <td>{{ $document->tracking_number }}</td>

                    <td>{{ $document->category->name }}</td>

                    <td>{{ $document->subject }}</td>

                    <td>{{ $document->sender }}</td>

                    <td>

                        <span class="badge bg-info">

                            {{ ucfirst(str_replace('_',' ',$document->current_status)) }}

                        </span>

                    </td>

                    <td>

                        {{ $document->assignedTo->name }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center">

                        No documents found.

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
