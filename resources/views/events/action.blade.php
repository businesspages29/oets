<div class="d-flex gap-2">
    <a href="{{ route('events.show', encryptId($id)) }}" class="btn btn-primary btn-sm d-flex align-items-center"
        title="View Event">
        <i class="bi bi-eye me-2"></i>
        View
    </a>
    <a type="button" class="btn btn-success btn-sm d-flex align-items-center editEventClick" title="Edit Event"
        data-id="{{ encryptId($id) }}" data-title="{{ $title }}" data-date="{{ $date }}"
        data-location="{{ $location }}" data-status="{{ $status }}" data-description="{{ $description }}">
        <i class="bi bi-pencil-square me-2"></i>
        Edit
    </a>
    <button class="btn btn-sm btn-danger"
        onclick="event.preventDefault(); 
    if(confirm('Are you sure you want to delete this event?')) { 
        document.getElementById('delete-form-{{ $id }}').submit(); 
    }">Delete</button>

    <form id="delete-form-{{ $id }}" action="{{ route('events.delete', encryptId($id)) }}" method="POST"
        style="display:none;">
        @csrf
        @method('DELETE')
    </form>
</div>
