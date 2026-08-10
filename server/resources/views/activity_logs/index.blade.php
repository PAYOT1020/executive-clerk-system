@extends('adminlte::page')

@section('title', 'Activity Logs')

@section('content_header')
    <h1>Activity Logs</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-history"></i>
            System Activity Logs
        </h3>
    </div>

    <div class="card-body">

        {{-- Search --}}
        <form method="GET" action="{{ route('activity-logs.index') }}" class="mb-3">

            <div class="input-group">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search activity..."
                    value="{{ request('search') }}"
                >

                <div class="input-group-append">

                    <button class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        Search
                    </button>

                </div>

            </div>

        </form>

        <div class="table-responsive">

            <table class="table table-bordered table-striped">

                <thead>

                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Module</th>
                        <th>Description</th>
                        <th>IP Address</th>
                        <th>Date & Time</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($logs as $log)

                        <tr>

                            <td>
                                {{ $logs->firstItem() + $loop->index }}
                            </td>

                            <td>
                                {{ $log->user->name ?? 'Unknown User' }}
                            </td>

                            <td>

                                @if(str_contains(strtolower($log->action), 'created'))

                                    <span class="badge badge-success">
                                        {{ $log->action }}
                                    </span>

                                @elseif(str_contains(strtolower($log->action), 'updated'))

                                    <span class="badge badge-warning">
                                        {{ $log->action }}
                                    </span>

                                @elseif(str_contains(strtolower($log->action), 'assigned'))

                                    <span class="badge badge-info">
                                        {{ $log->action }}
                                    </span>

                                @else

                                    <span class="badge badge-secondary">
                                        {{ $log->action }}
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ $log->module }}
                            </td>

                            <td>
                                {{ $log->description ?? '-' }}
                            </td>

                            <td>
                                {{ $log->ip_address ?? '-' }}
                            </td>

                            <td>
                                {{ $log->created_at->format('M d, Y h:i A') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center text-muted">

                                <i class="fas fa-info-circle"></i>
                                No activity logs found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    @if($logs->hasPages())

        <div class="card-footer">

            {{ $logs->links() }}

        </div>

    @endif

</div>

@stop
