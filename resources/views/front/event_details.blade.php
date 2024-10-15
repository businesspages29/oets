@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Event Details</h3>
                <a href="{{ route('front.home') }}" class="btn btn-secondary">Back to Events</a>
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
                            <p id="date">{{ $event->date->format('F j, Y H:i') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label fw-bold">Location:</label>
                            <p id="location">{{ $event->location }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label fw-bold">Status:</label>
                            <p id="status">{{ $event->status }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Available Tickets</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Available</th>
                                <th>Join</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($event->tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->type }}</td>
                                    <td>{{ $ticket->price }}</td>
                                    <td>{{ $ticket->quantity }}</td>
                                    <td>{{ $ticket->availableTickets() }}</td>
                                    <td>
                                        @if ($ticket->availableTickets() > 0)
                                            <a href="{{ route('front.joinDetails', ['id' => $ticket->id]) }}"
                                                class="btn btn-primary btn-sm">
                                                Join
                                            </a>
                                        @else
                                            <button class="btn btn-secondary btn-sm" disabled>
                                                Sold Out
                                            </button>
                                        @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
