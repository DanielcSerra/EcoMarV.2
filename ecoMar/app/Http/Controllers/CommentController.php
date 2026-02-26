<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
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
            'message'   => 'required|string|max:1000',
            'news_id' => 'required|exists:news,id',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'news_id' => $request->news_id,
            'message' => $request->message,
            'data_criacao' => now()
        ]);

          return redirect()->back()
            ->with('success', 'Commentário publicado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        $noticia = News::find($request->id);
       // Pega apenas os 3 comentários mais recentes
        $comentarios = Comment::where('news_id', $request->id)
                    ->orderBy('created_at', 'desc')
                    ->take(3)
                    ->get();
        return view('comentarios', compact('noticia', 'comentarios'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

}
