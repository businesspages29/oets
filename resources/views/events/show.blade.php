@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Event Details</h3>
                <a href="{{ route('events.index') }}" class="btn btn-secondary">Back to Events</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mt-3 fw-bold"></h5>
                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Title:</label>
                            <p id="title">{{ $event->title }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Description:</label>
                            <p id="description">{{ $event->description }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label fw-bold">Date:</label>
                            <p id="date">{{ $event->date }}</p>
                            {{-- <p id="date">{{ $event->date->format('F j, Y') }}</p> --}}
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label fw-bold">Location:</label>
                            <p id="location">{{ $event->location }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">Manage Tickets</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
