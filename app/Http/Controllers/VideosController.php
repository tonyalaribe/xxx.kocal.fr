<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function showLastVideosAction()
    {
        return view('home');
    }

    public function showCategoriesAction()
    {
        return view('categories');
    }
}
