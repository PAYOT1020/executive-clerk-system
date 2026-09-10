@extends('adminlte::page')

@section('title', 'Assign Document')

@section('content_header')
    <h1>Assign — {{ $document->tracking_number }}</h1>
@stop

@section('content')

<div class="card">

    <div class="card-body">

        <p>
            Currently assigned to:
            <strong>{{ $document->assignedTo->name ?? 'Unassigned' }}</strong>
        </p>

        <form action="{{ route('documents.assign', $document) }}" method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">Assign To</label>

                <select
                    name="assigned_to"
                    class="form-control @error('assigned_to') is-invalid @enderror"
                    required>

                    <option value="">-- Select Executive Clerk --</option>

                    @foreach($executiveClerks as $clerk)
                        <option value="{{ $clerk->id }}"
                            {{ old('assigned_to') == $clerk->id ? 'selected' : '' }}>
                            {{ $clerk->name }}
                        </option>
                    @endforeach

                </select>

                @error('assigned_to')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <div class="mb-3">

                <label class="form-label">Remarks</label>

                <textarea
                    name="remarks"
                    class="form-control @error('remarks') is-invalid @enderror"
                    rows="3">{{ old('remarks') }}</textarea>

                @error('remarks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            <button class="btn btn-primary">Assign</button>

            <a href="{{ route('documents.show', $document) }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>

</div>

@stop
