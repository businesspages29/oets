<div class="d-flex gap-2">
    <a href="{{ route('events.show', $id) }}" class="btn btn-primary btn-sm d-flex align-items-center" title="View Event">
        <i class="bi bi-eye me-2"></i>
        View
    </a>
    <a href="{{ route('events.show', $id) }}" class="btn btn-success btn-sm d-flex align-items-center" title="Edit Event">
        <i class="bi bi-pencil-square me-2"></i>
        Edit
    </a>
    <a href="{{ route('events.show', $id) }}" class="btn btn-danger btn-sm d-flex align-items-center"
        title="Delete Event">
        <i class="bi bi-trash me-2"></i>
        Delete
    </a>
</div>
