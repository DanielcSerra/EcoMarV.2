<?php

namespace App\Http\Controllers;

use App\Models\EventRegistration;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registrations = EventRegistration::with(['user', 'event'])
            ->latest('created_at')
            ->paginate(20);

        return response()->json($registrations);
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
        $validated = $request->validate([
            'event_id' => ['required', 'exists:events,id'],
        ]);

        $userId = $request->user()->id;

        $registration = EventRegistration::firstOrCreate(
            [
                'user_id' => $userId,
                'event_id' => $validated['event_id'],
            ],
            [
                'created_at' => now(),
            ]
        );

        $message = $registration->wasRecentlyCreated
            ? 'Inscrição realizada com sucesso.'
            : 'Já está inscrito neste evento.';

        return back()->with('status', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(EventRegistration $eventRegistration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventRegistration $eventRegistration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventRegistration $eventRegistration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, EventRegistration $eventRegistration)
    {
        if ($eventRegistration->user_id !== $request->user()->id) {
            abort(403);
        }

        $eventRegistration->delete();

        return back()->with('status', 'Inscrição cancelada.');
    }
}
