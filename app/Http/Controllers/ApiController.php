<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ApiController extends Controller
{
    public function getSortedTags()
    {
        $sortedTags = Redis::get('sortedTags');

        if (!$sortedTags) {
            $sortedTags = $this->fetchShortedTags();
            Redis::set('sortedTags', $sortedTags);
        }

        return $sortedTags;
    }

    private function fetchShortedTags()
    {
        $sortedTags = [];
        $tags = Tag::select(['tag', 'slug'])->orderBy('tag')->get();

        foreach ($tags as $tag) {
            $key = $tag->slug[0];
            if (is_numeric($key)) $key = '0-9';

            $sortedTags[$key][] = $tag;
        }

        return json_encode(compact('sortedTags'));
    }
}
