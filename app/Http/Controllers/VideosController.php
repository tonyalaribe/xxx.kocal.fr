<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VideosController extends Controller
{
    public function showLastVideosAction()
    {
        $videos = Cache::remember('videos', 60 * 60 * 24, function () {
            return Video::with('site')->paginate(40);
        });

        return view('home', [
            'videos' => $videos
        ]);
    }

    public function showCategoriesAction()
    {
        return view('categories');
    }
}
