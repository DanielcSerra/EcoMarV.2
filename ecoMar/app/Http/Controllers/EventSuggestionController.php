<?php

namespace App\Http\Controllers;

use App\Models\EventSuggestion;
use Illuminate\Http\Request;

class EventSuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        EventSuggestion::create([
            'user_id' => $request->user()->id,
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        return back()->with('status', 'Sugestão enviada. Obrigado!');
    }

    /**
     * Display the specified resource.
     */
    public function show(EventSuggestion $eventSuggestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventSuggestion $eventSuggestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventSuggestion $eventSuggestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventSuggestion $eventSuggestion)
    {
        //
    }
}
