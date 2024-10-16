<?php

namespace App\Models;

use App\Enums\EventStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $fillable = [
        'organizer_id',
        'title',
        'slug',
        'description',
        'date',
        'location',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'datetime:Y-m-d',
        ];
    }

    // search functionality
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('title', 'like', '%'.$search.'%')
                ->orWhere('location', 'like', '%'.$search.'%');
        }

        return $query;
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

    public function scopePublished($query)
    {
        return $query->where('status', EventStatus::PUBLISHED->value);
    }

    public function scopeDraft($query)
    {
        return $query->where('status', EventStatus::DRAFT->value);
    }
}
