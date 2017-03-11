<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function showLastVideosAction()
    {
        $videos = Video::with('site')->paginate(40);

        return view('home', [
            'videos' => $videos
        ]);
    }

    public function showCategoriesAction()
    {
        return view('categories');
    }
}
