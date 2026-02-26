<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Models\SponsorCategory;
use App\Models\SponsorSignup;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $categories = SponsorCategory::all();

    foreach ($categories as $category) {

        $category->paginatedSponsors = $category->sponsors()
            ->where('status', 1)
            ->paginate(140);
    }

    return view('patrocinadores', compact('categories'));
}

public function form()
{
    return view('patrocinar');
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
    $request->validate([
        'nome' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'mensagem' => 'nullable|string|max:500',
    ]);

    SponsorSignup::create([
        'nome' => $request->nome,
        'email' => $request->email,
        'mensagem' => $request->mensagem,
    ]);

    return redirect()->back()->with('success', 'Pedido de patrocínio enviado com sucesso!');
}

    /**
     * Display the specified resource.
     */
    public function show(Sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsor $sponsor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor)
    {
        //
    }
}
