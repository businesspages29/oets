<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'date' => 'datetime:Y-m-d H:i',
        ];
    }

    // Relationships
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // Scopes
    public function scopeOrganizerId($query, $organizer_id)
    {
        return $query->where('organizer_id', $organizer_id);
    }

    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
}
