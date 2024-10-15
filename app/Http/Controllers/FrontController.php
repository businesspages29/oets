<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FrontController extends Controller
{
    public function home(Request $request)
    {
        $currentPage = $request->input('page', 1);
        $cacheKey = 'events_page_'.$currentPage;
        $cacheDuration = now()->addHour(24);

        $events = cache()->remember($cacheKey, $cacheDuration, function () {
            Log::info('Fetching events from the database for the home page.');

            return Event::paginate(12);
        });

        return view('front.home', compact('events'));
    }

    public function eventDetails($slug)
    {
        $cacheKey = 'event_details_'.$slug;
        $event = cache()->remember($cacheKey, now()->addHour(24), function () use ($slug) {
            Log::info("Fetching event details for slug: $slug from database.");

            return Event::with(['tickets' => function ($query) {
                $query->withCount('attendees');
            }])
                ->where('slug', $slug) // Use where instead of slug() method
                ->firstOrFail();
        });

        return view('front.event_details', compact('event'));
    }

    public function joinDetails($id)
    {
        $ticket = Ticket::with('event')->withCount('attendees')->findOrFail($id);

        if (! ($ticket->availableTickets() > 0)) {
            return redirect()->back()->with('error', 'No more tickets available!');
        }

        return view('front.join_details', compact('ticket'));
    }

    public function join(Request $request)
    {
        dd($request->all());

        $ticket = Ticket::withCount('attendees')->findOrFail($id);

        if (! ($ticket->availableTickets() > 0)) {
            return redirect()->back()->with('error', 'No more tickets available!');
        }

        $ticket->attendees()->create([
            'user_id' => auth()->id(),
            'ticket_id' => $ticket->id,
        ]);

        return redirect()->back()->with('success', 'You have successfully joined the event!');
    }
}
