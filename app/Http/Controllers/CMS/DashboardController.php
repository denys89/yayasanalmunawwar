<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Program;
use App\Models\News;
use App\Models\Admission;
use App\Models\Media;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the main CMS dashboard
     */
    public function index()
    {
        $stats = [
            'pages' => Page::count(),
            'programs' => Program::count(),
            'news' => News::count(),
            'admissions' => Admission::pending()->count(),
            'media' => Media::count(),
            'users' => User::count(),
        ];

        $recentNews = News::latest()->take(5)->get();
        $recentAdmissions = Admission::latest()->take(5)->get();

        return view('cms.dashboard.index', compact('stats', 'recentNews', 'recentAdmissions'));
    }

    /**
     * Display the content management dashboard for editors
     */
    public function content()
    {
        $stats = [
            'pages' => Page::count(),
            'news' => News::count(),
            'media' => Media::count(),
        ];

        $recentNews = News::latest()->take(5)->get();

        return view('cms.dashboard.content', compact('stats', 'recentNews'));
    }
}
