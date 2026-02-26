<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventCategory;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $baseQuery = Event::query()->withCount('registrations');

        if ($request->user()) {
            $baseQuery->with([
                'registrations' => function ($q) use ($request) {
                    $q->where('user_id', $request->user()->id);
                }
            ]);
        }

        $upcomingEvents = (clone $baseQuery)
            ->orderBy('event_date')
            ->orderBy('event_time')
            ->limit(2)
            ->get();

        $query = (clone $baseQuery);

        if ($request->has('q') && $request->q) {
            $query->where('title', 'like', '%' . $request->q . '%')
                ->orWhere('description', 'like', '%' . $request->q . '%');
        }

        if ($request->has('tema') && $request->tema) {
            $query->where('category_id', $request->tema);
        }

        if ($request->has('localizacao') && $request->localizacao) {
            $query->where('location', $request->localizacao);
        }

        $events = $query->paginate(6);

        $categories = EventCategory::all();
        $locations = Event::select('location')->distinct()->get();

        return view('eventos', compact('events', 'categories', 'locations', 'upcomingEvents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
