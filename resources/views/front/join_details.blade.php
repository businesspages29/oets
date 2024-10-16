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
                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Title:</label>
                            <p id="title">{{ $ticket->event->title }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label fw-bold">Date:</label>
                            <p id="date">{{ $ticket->event->date->format('F j, Y') }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label fw-bold">Location:</label>
                            <p id="location">{{ $ticket->event->location }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="type" class="form-label fw-bold">Type:</label>
                            <p id="type">{{ $ticket->type }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label fw-bold">Price:</label>
                            <p id="price">{{ $ticket->price }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label fw-bold">Available Tickets:</label>
                            <p id="quantity">{{ $ticket->availableTickets() }}</p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('front.join', encryptId($ticket->id)) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="quantity" class="form-label fw-bold">Quantity:</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" value="1"
                                    min="1" max="{{ $ticket->availableTickets() }}">
                            </div>
                            <div class="mb-3">
                                <label for="card_number" class="form-label fw-bold">Card Number:</label>
                                <input type="number" name="card_number" id="card_number" class="form-control">
                                <div class="form-text">
                                    success: 4242424242424242<br>
                                    fail: 4000000000000341
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="expires" class="form-label fw-bold">Expires:</label>
                                <input type="text" name="expires" id="expires" class="form-control" placeholder="MM/YY"
                                    maxlength="5" required pattern="(0[1-9]|1[0-2])\/[0-9]{2}">
                                <div class="form-text">Format: MM/YY (e.g., 09/24)</div>
                            </div>
                            <div class="mb-3">
                                <label for="cvv" class="form-label fw-bold">CVV:</label>
                                <input type="text" name="cvv" id="cvv" class="form-control"
                                    placeholder="Enter 3-digit CVV" required maxlength="3" pattern="^\d{3}$"
                                    title="Please enter exactly 3 digits">
                                <div class="form-text">3 digits on the back of the card</div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Join</button>
                </form>
            </div>
        </div>
    </div>
@endsection
