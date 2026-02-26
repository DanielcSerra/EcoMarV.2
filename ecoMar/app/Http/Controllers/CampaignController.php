<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    private const ITEMS_PER_PAGE = 5;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campaigns = Campaign::paginate(self::ITEMS_PER_PAGE);
        return view('campanhas', compact('campaigns'));
    }

    /**
     * Load more campaigns via AJAX
     */
    public function loadMore(Request $request)
    {
        $page = $request->get('page', 2);
        $campaigns = Campaign::paginate(self::ITEMS_PER_PAGE, ['*'], 'page', $page);

        return response()->json([
            'html' => view('campanhas.cards', compact('campaigns'))->render(),
            'hasMore' => $campaigns->hasMorePages(),
            'nextPage' => $campaigns->currentPage() + 1,
        ]);
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
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campaign $campaign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaign $campaign)
    {
        //
    }
}
