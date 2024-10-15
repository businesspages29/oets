@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">User Details</h3>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Name:</label>
                            <p id="title">{{ $user->name }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email:</label>
                            <p id="email">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header">Manage Events</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
