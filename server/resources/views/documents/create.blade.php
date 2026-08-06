@extends('adminlte::page')

@section('title', 'Receive Document')

@section('content_header')
    <h1>Receive New Document</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Document Information</h3>
    </div>

    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Document Type</label>

                        <select name="category_id" class="form-control" required>

                            <option value="">Select Document Type</option>

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label>Date Received</label>

                        <input
                            type="date"
                            name="date_received"
                            class="form-control"
                            value="{{ date('Y-m-d') }}"
                            required>

                    </div>

                </div>

            </div>

            <div class="form-group">

                <label>Subject</label>

                <input
                    type="text"
                    name="subject"
                    class="form-control"
                    required>

            </div>

            <div class="form-group">

                <label>Sender</label>

                <input
                    type="text"
                    name="sender"
                    class="form-control"
                    required>

            </div>

            <div class="form-group">

                <label>Assign Executive Clerk</label>

                <select
                    name="assigned_to"
                    class="form-control"
                    required>

                    <option value="">Select Executive Clerk</option>

                    @foreach($executiveClerks as $user)

                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="form-group">

                <label>Remarks</label>

                <textarea
                    name="remarks"
                    rows="4"
                    class="form-control"></textarea>

            </div>

            <div class="form-group">

                <label>Upload Document</label>

                <input
                    type="file"
                    name="document_file"
                    class="form-control">

                <small class="text-muted">
                    PDF, JPG, JPEG or PNG
                </small>

            </div>

        </div>

        <div class="card-footer">

            <button class="btn btn-primary">

                <i class="fas fa-save"></i>

                Save Document

            </button>

            <a href="{{ route('documents.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </div>

    </form>

</div>

@stop
