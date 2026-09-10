@extends('adminlte::page')

@section('title', 'System Administration')

@section('content_header') <div class="d-flex justify-content-between align-items-center"> <div> <h1> <i class="fas fa-user-shield mr-2"></i>
System Administration </h1> <p class="text-muted mb-0">
Executive Clerk System Management </p> </div>


    <span class="badge badge-primary p-2">
        <i class="fas fa-shield-alt mr-1"></i>
        Administrator
    </span>
</div>

@stop

@section('content')

{{-- Statistics --}}
<div class="row">

    {{-- Users --}}
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $totalUsers }}</h3>
                <p>Total Users</p>
            </div>

            <div class="icon">
                <i class="fas fa-users"></i>
            </div>

            <a href="#" class="small-box-footer">
                Manage Users
                <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>
    </div>

    {{-- Documents --}}
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalDocuments }}</h3>
                <p>Total Documents</p>
            </div>

            <div class="icon">
                <i class="fas fa-folder-open"></i>
            </div>

            <a href="{{ route('documents.index') }}" class="small-box-footer">
                View Documents
                <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>
    </div>

    {{-- Pending --}}
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $pendingDocuments }}</h3>
                <p>Pending Documents</p>
            </div>

            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>

            <a href="{{ route('documents.index') }}" class="small-box-footer">
                View Pending
                <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>
    </div>

    {{-- Released --}}
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $releasedDocuments }}</h3>
                <p>Released Documents</p>
            </div>

            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>

            <a href="{{ route('documents.index') }}" class="small-box-footer">
                View Released
                <i class="fas fa-arrow-circle-right ml-1"></i>
            </a>
        </div>
    </div>

</div>


{{-- Administration Modules --}}
<div class="row">

    {{-- User Management --}}
    <div class="col-lg-4 col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users-cog mr-2"></i>
                    User Management
                </h3>
            </div>

            <div class="card-body">
                <p class="text-muted">
                    Manage system accounts, roles, and user access.
                </p>

                <a href="#" class="btn btn-primary btn-block">
                    <i class="fas fa-users mr-1"></i>
                    Manage Users
                </a>
            </div>
        </div>
    </div>


    {{-- Department Management --}}
    <div class="col-lg-4 col-md-6">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-building mr-2"></i>
                    Department Management
                </h3>
            </div>

            <div class="card-body">
                <p class="text-muted">
                    Add and manage departments that transmit and receive documents.
                </p>

                <a href="#" class="btn btn-success btn-block">
                    <i class="fas fa-building mr-1"></i>
                    Manage Departments
                </a>
            </div>
        </div>
    </div>


    {{-- Document Categories --}}
    <div class="col-lg-4 col-md-6">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-folder mr-2"></i>
                    Document Categories
                </h3>
            </div>

            <div class="card-body">
                <p class="text-muted">
                    Manage document types and categories used by the system.
                </p>

                <a href="#" class="btn btn-info btn-block">
                    <i class="fas fa-folder-open mr-1"></i>
                    Manage Categories
                </a>
            </div>
        </div>
    </div>

</div>


{{-- System Management --}}
<div class="row">

    {{-- Activity Logs --}}
    <div class="col-lg-4 col-md-6">
        <div class="info-box">
            <span class="info-box-icon bg-secondary">
                <i class="fas fa-history"></i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">
                    Activity Logs
                </span>

                <span class="info-box-number">
                    System Activity
                </span>

                <a href="#" class="text-muted">
                    View system logs
                </a>
            </div>
        </div>
    </div>


    {{-- System Settings --}}
    <div class="col-lg-4 col-md-6">
        <div class="info-box">
            <span class="info-box-icon bg-dark">
                <i class="fas fa-cogs"></i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">
                    System Settings
                </span>

                <span class="info-box-number">
                    Configuration
                </span>

                <a href="#" class="text-muted">
                    Manage settings
                </a>
            </div>
        </div>
    </div>


    {{-- Security --}}
    <div class="col-lg-4 col-md-6">
        <div class="info-box">
            <span class="info-box-icon bg-danger">
                <i class="fas fa-shield-alt"></i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">
                    Security
                </span>

                <span class="info-box-number">
                    Access Control
                </span>

                <a href="#" class="text-muted">
                    Security settings
                </a>
            </div>
        </div>
    </div>

</div>


{{-- Recent Documents --}}
<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-file-alt mr-2"></i>
            Recent Documents
        </h3>

        <div class="card-tools">
            <a href="{{ route('documents.index') }}"
               class="btn btn-sm btn-primary">
                <i class="fas fa-list mr-1"></i>
                View All
            </a>
        </div>
    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover table-striped mb-0">

                <thead class="thead-light">
                    <tr>
                        <th>Tracking Number</th>
                        <th>Subject</th>
                        <th>Category</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($recentDocuments as $document)

                        <tr>

                            <td>
                                <a href="{{ route('documents.show', $document) }}">
                                    <strong>
                                        {{ $document->tracking_number }}
                                    </strong>
                                </a>
                            </td>

                            <td>
                                {{ $document->subject }}
                            </td>

                            <td>
                                {{ $document->category->name ?? 'N/A' }}
                            </td>

                            <td>
                                {{ $document->assignedTo->name ?? 'Unassigned' }}
                            </td>

                            <td>

                                @php
                                    $statusClass = match($document->current_status) {
                                        'released' => 'success',
                                        'received' => 'info',
                                        'for_signature' => 'warning',
                                        default => 'secondary',
                                    };
                                @endphp

                                <span class="badge badge-{{ $statusClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $document->current_status)) }}
                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="fas fa-folder-open fa-2x mb-2"></i>
                                <br>
                                No documents found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>
```

@stop

@section('css')

<style>

    .small-box {
        border-radius: 8px;
    }

    .card {
        border-radius: 8px;
    }

    .info-box {
        border-radius: 8px;
    }

    .card-title {
        font-weight: 600;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

</style>

@stop
