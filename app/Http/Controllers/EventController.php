<?php

namespace App\Http\Controllers;

use App\DataTables\EventsDataTable;
use App\DataTables\TicketsDataTable;
use App\Enums\EventStatus;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(EventsDataTable $dataTable)
    {
        $auth = auth()->user();
        $counts = [
            'total' => $auth->events()->count(),
            'published' => $auth->events()->published()->count(),
            'draft' => $auth->events()->draft()->count(),
        ];

        $statuses = EventStatus::cases();

        return $dataTable
            ->with([
                'organizer_id' => $auth->id,
            ])
            ->render('events.index', [
                'counts' => $counts,
                'statuses' => $statuses,
            ]);
    }

    public function show($id, TicketsDataTable $dataTable)
    {
        $decryptId = decryptId($id);
        $event = Event::findOrFail($decryptId);

        return $dataTable->with([
            'event_id' => $event->id,
        ])
            ->render('events.show', [
                'event' => $event,
            ]);
    }

    public function save(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'date' => 'required|date',
            'status' => 'required|in:'.implode(',', EventStatus::values()),
        ]);

        try {
            $data['slug'] = \Str::slug($data['title']);
            $data['organizer_id'] = auth()->id();

            if ($request->has('id')) {
                $decryptId = decryptId($request->id);
                Event::where('id', $decryptId)->update($data);
            } else {
                Event::create($data);
            }

            return response()->json(['success' => 'Event save successfully.']);

        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'message' => $e->getMessage(),
                ],
            ], 422);
        }
    }

    public function save_ticket(Request $request): JsonResponse
    {
        $data = $request->validate([
            'event_id' => 'required|exists:events,id',
            'type' => 'required',
            'price' => 'required|numeric|min:0.01',
            'quantity' => 'required|numeric|min:1',
        ]);

        Ticket::create($data);

        return response()->json(['success' => 'Ticket save successfully.']);
    }

    public function delete($id)
    {
        try {
            $decryptId = decryptId($id);
            Event::destroy($decryptId);

            return redirect()->back()->with('success', 'Event deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function delete_ticket($id)
    {
        try {
            $decryptId = decryptId($id);
            Ticket::destroy($decryptId);

            return redirect()->back()->with('success', 'Ticket deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
