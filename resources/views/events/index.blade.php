@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Events</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $counts['total'] }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Events Published</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $counts['published'] }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Events Draft</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $counts['draft'] }}</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Manage Events</h3>
                <a type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#eventModal">
                    Create Event
                </a>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="ajax-form" action="{{ route('events.save') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel">Ticket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="title">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" class="form-control" id="date">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" name="location" class="form-control" id="location">
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select form-select-sm" name="status" id="status">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->value }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                            </div>
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
        var myModal = new bootstrap.Modal(document.getElementById('eventModal'))

        document.getElementById('eventModal').addEventListener('hidden.bs.modal', function() {
            // Reset the form when the modal is hidden
            $('#ajax-form')[0].reset();
        });

        $(document).on('click', '.editEventClick', function() {
            const id = $(this).data('id');
            if (id) {
                const title = $(this).data('title');
                const date = $(this).data('date');
                const location = $(this).data('location');
                const status = $(this).data('status');
                const description = $(this).data('description');
                $('#id').val(id);
                $('#title').val(title);
                $('#date').val(date);
                $('#location').val(location);
                $('#status').val(status);
                $('#description').val(description);
                myModal.show()
            }
        });

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
