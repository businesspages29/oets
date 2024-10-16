@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <h1>Events</h1>
            </div>
            <div class="col-md-12">
                <form action="{{ route('front.home') }}" method="GET" class="mb-4">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <input type="text" name="search" class="form-control" placeholder="Search events"
                                    value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <input type="date" name="date" class="form-control" id="date"
                                    value="{{ request('date') }}">
                                <div class="input-group-append ms-3">
                                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                                    <a href="{{ route('front.home') }}" class="btn btn-outline-danger ms-2">Reset</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row text-center">
            @forelse ($events as $event)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <p class="card-text">{{ $event->title }}</p>
                            <ul class="list-unstyled mb-3">
                                <li>{{ $event->date->format('F j, Y') }}</li>
                                <li>{{ $event->location }}</li>
                            </ul>

                            <a href="{{ route('front.eventDetails', $event->slug) }}" class="btn btn-primary btn-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        No events found.
                    </div>
                </div>
            @endforelse
        </div>
        {{ $events->links() }}
    </div>
@endsection
