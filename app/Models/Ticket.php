<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;

    // Relationships
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function attendees()
    {
        return $this->hasMany(Attendee::class);
    }

    // Scopes
    public function scopeEventId($query, $event_id)
    {
        return $query->where('event_id', $event_id);
    }

    public function availableTickets()
    {
        return $this->quantity - $this->attendees_count;
    }
}
