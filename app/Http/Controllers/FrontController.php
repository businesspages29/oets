<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Notifications\TicketConfirmationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FrontController extends Controller
{
    public function home(Request $request)
    {
        // $currentPage = $request->input('page', 1);
        // $cacheKey = 'events_page_'.$currentPage;
        // $cacheDuration = now()->addHour(24);

        // $events = cache()->remember($cacheKey, $cacheDuration, function () {
        //     Log::info('Fetching events from the database for the home page.');
        //     return Event::paginate(12);
        // });
        $currentDate = now();

        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);
        $events = Event::query();

        if ($request->filled('search')) {
            $events->search($request->search);
        }

        if ($request->filled('date')) {
            $events->where('date', '=', $request->date);
        }

        $events = $events->where('date', '>=', $currentDate)->paginate(12);

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
        if (! auth()->user()->isAttendee()) {
            return abort(403);
        }
        $decryptId = decryptId($id);
        $ticket = Ticket::with('event')->withCount('attendees')->findOrFail($decryptId);

        if (! ($ticket->availableTickets() > 0)) {
            return redirect()->back()->with('error', 'No more tickets available!');
        }

        return view('front.join_details', compact('ticket'));
    }

    public function join(Request $request, $id)
    {
        if (! auth()->user()->isAttendee()) {
            return abort(403);
        }
        $request->validate([
            'quantity' => 'required|numeric|min:1',
            'card_number' => 'required|numeric|digits:16|in:4242424242424242,4000000000000341',
        ]);

        if ($request->card_number == '4000000000000341') {
            return redirect()->back()->with('error', 'Your card was declined!');
        }

        $decryptId = decryptId($id);
        $ticket = Ticket::withCount('attendees')->findOrFail($decryptId);

        if (! ($ticket->availableTickets() > 0)) {
            return redirect()->back()->with('error', 'No more tickets available!');
        }

        foreach (range(1, $request->quantity) as $i) {
            $ticket->attendees()->create([
                'user_id' => auth()->id(),
                'ticket_id' => $ticket->id,
            ]);
        }

        auth()->user()->notify(new TicketConfirmationNotification($ticket));

        return redirect()->back()->with('success', 'You have successfully joined the event!');
    }
}
