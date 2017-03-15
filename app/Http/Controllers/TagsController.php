<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{
    public function showCategoriesAction()
    {
        $maxCategories = 15;
        /*
        $popularTags = VideoTag
            ::with('tag')
            ->orderBy('count', 'desc')
            ->groupBy('tag_id')
            ->limit($maxCategories)
            ->get(['tag_id', DB::raw('COUNT(tag_id) AS count')]);

        $videos = VideoTag
            ::with(['videos' => function ($q) {
                $q->inRandomOrder();
            }])
            ->groupBy('tag_id')
            ->whereInStrict('tag_id', $popularTags->pluck('tag_id')->map(function ($n) {
                return intval($n);
            }))
            ->get(['video_id', 'tag_id']);
        */


//        dd();

        /*
        foreach ($popularTags as $popularTag) {
            var_dump($popularTag->tag->id);
            $video = $videos
                ->where('tag_id', $popularTag->tag->id)
                ->tap(function ($coll) {
                    dump($coll);
                })
                ->first()
                ->videos()
                ->first();

            $categories[] = [
                'tag' => $popularTag->tag->tag,
                'slug' => $popularTag->tag->slug,
                'thumbnail_url' => $video->thumbnail_url
            ];
        }

        dd($categories);
        */

//        $categories = VideoTag::with(['tag', 'videos', 'videos.site'])
//            ->orderBy('count', 'desc')
//            ->groupBy('tag_id')
//            ->limit(40)
//            ->get(['tag_id', 'video_id', DB::raw('count(tag_id) as count')]);


        return view('categories', [
            'categories' => $popularTags
//            'categories' => $categories
        ]);
    }

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
        $tags = Tag::select(['tag', 'slug'])
            ->orderBy('tag')
            ->get();

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
