<div class="d-flex gap-2">
    <button class="btn btn-sm btn-danger"
        onclick="event.preventDefault(); 
        if(confirm('Are you sure you want to delete this ticket?')) { 
            document.getElementById('delete-form-{{ $row->id }}').submit(); 
        }">Delete</button>

    <form id="delete-form-{{ $row->id }}" action="{{ route('events.deleteTicket', encryptId($row->id)) }}"
        method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
</div>
