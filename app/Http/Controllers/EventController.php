<?php

namespace App\Http\Controllers;

use App\DataTables\EventsDataTable;
use App\DataTables\TicketsDataTable;
use App\Models\Event;

class EventController extends Controller
{
    public function index(EventsDataTable $dataTable)
    {
        return $dataTable->render('events.index');
    }

    public function show(Event $event, TicketsDataTable $dataTable)
    {
        return $dataTable->with([
            'event_id' => $event->id,
        ])
            ->render('events.show', [
                'event' => $event,
            ]);
    }
}
