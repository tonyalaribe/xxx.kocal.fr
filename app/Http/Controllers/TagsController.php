<?php

namespace App\Http\Controllers;

use App\Tag;
use App\VideoTag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{
    public function showTagsAction()
    {
        $sortedTags = Cache::remember('sortedTags', 60 * 60 * 24, function () {
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
        });

        return view('tags', [
            'sortedTags' => $sortedTags
        ]);
    }

    public function showPopularTagsAction()
    {
        $maxPopularTags = 30;

        $popularTags = Cache::remember('popular_tags', 60 * 60 * 24, function () use ($maxPopularTags) {
            $popularTags = collect();
            $tagsSortedAsMaxCount = VideoTag
                ::orderBy('count', 'desc')
                ->groupBy('tag_id')
                ->limit($maxPopularTags)
                ->get(['tag_id', DB::raw('COUNT(tag_id) AS count')]);

            foreach ($tagsSortedAsMaxCount->pluck('tag_id') as $tag_id) {
                $popularTag = Tag::with([
                    'videos' => function ($q) {
                        $q
                            ->select(['thumbnail_url'])
                            ->inRandomOrder()
                            ->limit(1);
                    }
                ])
                    ->where('id', '=', $tag_id)
                    ->get(['id', 'tag', 'slug']);
                $popularTags = $popularTags->merge($popularTag);
            }

            return $popularTags;
        });

        return view('tags_popular', [
            'maxPopularTags' => $maxPopularTags,
            'popularTags' => collect($popularTags)
        ]);
    }
}
