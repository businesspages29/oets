@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row text-center">
            @forelse ($events as $event)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <p class="card-text">{{ $event->title }}</p>
                            <ul class="list-unstyled mb-3">
                                <li>{{ $event->date->format('F j, Y H:i') }}</li>
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
