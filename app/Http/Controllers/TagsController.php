<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Support\Facades\Cache;

class TagsController extends Controller
{
    public function showTagsAction()
    {
        $sortedTags = Cache::remember('sortedTags', 60 * 60 * 24, function () {
            return $this->fetchTags();
        });

        return view('tags', [
            'sortedTags' => $sortedTags
        ]);
    }

    public function showTagAction()
    {

    }

    private function fetchTags()
    {
        $sortedTags = [];
        $tags = Tag::select(['tag', 'slug'])->orderBy('tag')->get();

        foreach ($tags as $tag) {
            $key = $tag->slug[0];
            if (is_numeric($key)) {
                $key = '0-9';
            }

            if ($tag->slug === $tag->tag) {
                continue;
            }

            $sortedTags[$key][] = $tag;
        }

        return $sortedTags;
    }
}
