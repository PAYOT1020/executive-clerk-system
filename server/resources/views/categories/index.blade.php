@extends('adminlte::page')

@section('title', 'Document Types')

@section('content_header')
    <h1>Document Types</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">

    <div class="card-header d-flex justify-content-between">

        <h3 class="card-title">List of Document Types</h3>

        <a href="{{ route('categories.create') }}"
           class="btn btn-primary">

            Add Document Type

        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Name</th>

                    <th>Description</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

            @forelse($categories as $category)

                <tr>

                    <td>{{ $category->id }}</td>

                    <td>{{ $category->name }}</td>

                    <td>{{ $category->description }}</td>

                    <td>

                        @if($category->is_active)

                            <span class="badge bg-success">Active</span>

                        @else

                            <span class="badge bg-danger">Inactive</span>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4" class="text-center">

                        No document types found.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop
