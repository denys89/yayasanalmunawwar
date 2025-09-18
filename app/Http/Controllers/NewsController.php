<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display the specified news article to the public.
     */
    public function show(News $news)
    {
        // Only show published news to the public
        if ($news->status !== 'published') {
            abort(404);
        }

        return view('news.show', compact('news'));
    }
}