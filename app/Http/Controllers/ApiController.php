<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Support\Facades\Redis;

class ApiController extends Controller
{
    /**
     * GET /api/inFrontTags
     */
    public function getInFrontTags()
    {
        $inFrontTags = Redis::get('inFrontTags');

        if (!$inFrontTags) {
            $inFrontTags = $this->fetchInFrontTags();
            Redis::set('inFrontTags', $inFrontTags);
        }

        return $inFrontTags;
    }

    /**
     * GET /api/sortedTags
     */
    public function getSortedTags()
    {
        $sortedTags = Redis::get('sortedTags');

        if (!$sortedTags) {
            $sortedTags = $this->fetchShortedTags();
            Redis::set('sortedTags', $sortedTags);
        }

        return $sortedTags;
    }

    /**
     * Fetch tags which are marked as "in-front", and return a JSON.
     * @return string
     */
    private function fetchInFrontTags()
    {
        $inFrontTags = [];
        $tags = Tag::with('videos')->orderBy('tag')->whereIn('tag', [
            'Lesbian', 'Young', 'French', 'Teen',
            'Ebony', 'Domination', 'Bus', 'Foot',
            'Amateur', 'Anal', 'Babysitter', 'Hentai',
            'Big tits', 'Japanese', 'Grandpa', 'Public',
        ])->get();

        foreach ($tags as $tag) {
            $video = $tag->videos->last();
            $inFrontTags[] = [
                'tag' => [
                    'tag' => $tag->tag,
                    'slug' => $tag->slug,
                ],
                'video' => [
                    'thumbnail_url' => $video->thumbnail_url
                ],
                'site' => [
                    'url' => $video->site->url
                ]
            ];
        }

        return json_encode(['inFrontTags' => $inFrontTags]);
    }

    /**
     * Fetch tags in database, sort them and return a JSON.
     * @return string
     */
    private function fetchShortedTags()
    {
        $sortedTags = [];
        $tags = Tag::select(['tag', 'slug'])->orderBy('tag')->get();

        foreach ($tags as $tag) {
            $key = $tag->slug[0];
            if (is_numeric($key)) $key = '0-9';

            $sortedTags[$key][] = $tag;
        }

        return json_encode(['sortedTags' => $sortedTags]);
    }
}
