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
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Manage Tickets</h3>
                <a type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ticketModal">
                    Create Ticket
                </a>
            </div>
            <div class="card-header"></div>

            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="ticketModal" tabindex="-1" aria-labelledby="ticketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="ajax-form" action="{{ route('events.saveTicket') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="ticketModalLabel">Ticket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" name="type" class="form-control" id="type">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" step="0.01" max="100000.00" class="form-control"
                                id="price">
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" name="quantity" min="1" max="100" class="form-control"
                                id="quantity">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module">
        $('#ajax-form').submit(function(e) {
            e.preventDefault();

            var url = $(this).attr("action");
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    $('#ajax-form')[0].reset();
                    alert('Form submitted successfully');
                    location.reload();
                },
                error: function(response) {
                    $('#ajax-form').find(".print-error-msg").find("ul").html('');
                    $('#ajax-form').find(".print-error-msg").css('display', 'block');
                    $.each(response.responseJSON.errors, function(key, value) {
                        $('#ajax-form').find(".print-error-msg").find("ul").append('<li>' +
                            value + '</li>');
                    });
                }
            });

        });
    </script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
