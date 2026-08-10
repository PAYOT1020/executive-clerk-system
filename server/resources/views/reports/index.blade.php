@extends('adminlte::page')

@section('title', 'Document Reports')

@section('content_header')
    <h1>
        <i class="fas fa-chart-bar"></i>
        Document Reports
    </h1>
@stop

@section('content')

<div class="row">

    {{-- Today --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $todayCount }}</h3>
                <p>Received Today</p>
            </div>

            <div class="icon">
                <i class="fas fa-calendar-day"></i>
            </div>
        </div>
    </div>

    {{-- Week --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $weekCount }}</h3>
                <p>Received This Week</p>
            </div>

            <div class="icon">
                <i class="fas fa-calendar-week"></i>
            </div>
        </div>
    </div>

    {{-- Month --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $monthCount }}</h3>
                <p>Received This Month</p>
            </div>

            <div class="icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>
    </div>

    {{-- Year --}}
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $yearCount }}</h3>
                <p>Received This Year</p>
            </div>

            <div class="icon">
                <i class="fas fa-calendar"></i>
            </div>
        </div>
    </div>

</div>


{{-- Category Statistics --}}

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-chart-pie"></i>
            Documents by Category
        </h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Document Category</th>
                    <th width="200">Documents Received</th>
                </tr>
            </thead>

            <tbody>

                @forelse($categoryStatistics as $category => $count)

                    <tr>

                        <td>
                            {{ $category }}
                        </td>

                        <td>
                            <span class="badge badge-primary">
                                {{ $count }}
                            </span>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="2" class="text-center text-muted">
                            No documents received for this period.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop
