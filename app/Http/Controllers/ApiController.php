<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Support\Facades\Cache;

class ApiController extends Controller
{
    public function getTags()
    {
        $json = Cache::remember('tags', 10, function () {
            $tags = Tag::select(['tag', 'slug'])->orderBy('tag')->get();
            return json_encode(['tags' => $tags]);
        });

        return $json;
    }
}
