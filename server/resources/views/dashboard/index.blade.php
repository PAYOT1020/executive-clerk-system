@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Executive Clerk Dashboard</h1>
@stop

@section('content')

{{-- Welcome Message --}}
<div class="alert alert-success">
    Welcome to the Executive Clerk Document Automation and Records Management System.
</div>


{{-- Document Statistics --}}
<div class="row">

    {{-- Total Documents --}}
    <div class="col-lg-3 col-6">

        <div class="small-box bg-primary">

            <div class="inner">

                <h3>{{ $totalDocuments }}</h3>

                <p>Total Documents</p>

            </div>

            <div class="icon">
                <i class="fas fa-folder-open"></i>
            </div>

            <a href="{{ route('documents.index') }}" class="small-box-footer">

                View Documents
                <i class="fas fa-arrow-circle-right"></i>

            </a>

        </div>

    </div>


    {{-- Received --}}
    <div class="col-lg-3 col-6">

        <div class="small-box bg-info">

            <div class="inner">

                <h3>{{ $receivedDocuments }}</h3>

                <p>Received</p>

            </div>

            <div class="icon">
                <i class="fas fa-inbox"></i>
            </div>

            <a href="{{ route('documents.index', ['status' => 'received']) }}"
               class="small-box-footer">

                View Received
                <i class="fas fa-arrow-circle-right"></i>

            </a>

        </div>

    </div>


    {{-- Checking --}}
    <div class="col-lg-3 col-6">

        <div class="small-box bg-warning">

            <div class="inner">

                <h3>{{ $checkingDocuments }}</h3>

                <p>Checking</p>

            </div>

            <div class="icon">
                <i class="fas fa-search"></i>
            </div>

            <a href="{{ route('documents.index', ['status' => 'checking']) }}"
               class="small-box-footer">

                View Checking
                <i class="fas fa-arrow-circle-right"></i>

            </a>

        </div>

    </div>


    {{-- For Signature --}}
    <div class="col-lg-3 col-6">

        <div class="small-box bg-secondary">

            <div class="inner">

                <h3>{{ $forSignatureDocuments }}</h3>

                <p>For Signature</p>

            </div>

            <div class="icon">
                <i class="fas fa-signature"></i>
            </div>

            <a href="{{ route('documents.index', ['status' => 'for_signature']) }}"
               class="small-box-footer">

                View Documents
                <i class="fas fa-arrow-circle-right"></i>

            </a>

        </div>

    </div>

</div>


{{-- Released --}}
<div class="row">

    <div class="col-lg-3 col-6">

        <div class="small-box bg-success">

            <div class="inner">

                <h3>{{ $releasedDocuments }}</h3>

                <p>Released</p>

            </div>

            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>

            <a href="{{ route('documents.index', ['status' => 'released']) }}"
               class="small-box-footer">

                View Released
                <i class="fas fa-arrow-circle-right"></i>

            </a>

        </div>

    </div>

</div>

@stop
