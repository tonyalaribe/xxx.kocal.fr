<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VideosController extends Controller
{
    public function showLastVideosAction()
    {
        $videos = Video::with('site')->paginate(40);

        return view('videos', [
            'videos' => $videos
        ]);
    }
}
