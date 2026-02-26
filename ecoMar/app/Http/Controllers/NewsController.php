<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Routing\Controller;
use App\Models\Category;
use App\Models\NewsCategory;
use App\Http\Controllers\NewsCategoryController;

class NewsController extends Controller
{


    public function index(Request $request)
    {


        $query = News::with('category')->orderBy('date_upload', 'DESC');

        if ($request->filled('q')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->q . '%')
                  ->orWhere('description', 'LIKE', '%' . $request->q . '%');
            });
        }


        if ($request->filled('categoria')) {
            $query->where('category_id', $request->categoria);
        }


        if ($request->filled('autor')) {
            $query->where('author', $request->autor);
        }

        $news = $query->paginate(4);

        $categories = NewsCategory::all();
        $authors = News::select('author')->distinct()->get();

        return view('noticias', compact('news', 'categories', 'authors'));
    }
    }

