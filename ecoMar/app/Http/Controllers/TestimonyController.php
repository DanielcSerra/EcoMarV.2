<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    public function index()
    {
        $testimonies = Testimony::with('user')
            ->where('is_approved', true)
            ->latest()
            ->take(3)
            ->get();

        return view('voluntarios', compact('testimonies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|min:10|max:300',
        ]);

        Testimony::create([
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Testemunho submetido com sucesso!');
    }

        public function all()
        {
            $testimonies = Testimony::with('user')
                ->where('is_approved', true)
                ->latest()
                ->paginate(10);

            return view('voluntarios.depoimentos', compact('testimonies'));
        }
}
