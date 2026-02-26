<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComententsController extends Controller
{
     /* Display a listing of the resource.
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
        $request->validate([
            'conteudo'   => 'required|string|max:1000',
            'id_noticia' => 'required|exists:noticias,id',
        ]);

        Comentario::create([
            'conteudo'      => $request->conteudo,
            'id_noticia'    => $request->id_noticia,
            'id_utilizador' => auth()->id(),
            'data_criacao'  => now(),
        ]);

          return redirect()->back()
            ->with('success', 'Comentário publicado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $noticia = News::find($request->id);
        $comentarios = Coments::where('id_noticia', $request->id)->get();
        return view('coment', compact('noticia', 'comentarios'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
