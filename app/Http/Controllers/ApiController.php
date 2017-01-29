<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Support\Facades\DB;
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

    public function getVideosForTag($tag)
    {
        //TODO: use Eloquent models and relations :~)
        $videos = DB::table('tag')
            ->select(
                'video.url as video_url', 'video.duration as video_duration',
                'video.thumbnail_url as video_thumbnail_url',
                'video.title as video_title',
                'site.url as site_url', 'site.name as site_name'
            )
            ->join('video_tag_through', 'tag.id', '=', 'video_tag_through.tag_id')
            ->join('video', 'video_tag_through.video_id', '=', 'video.id')
            ->join('site', 'video.site_id', '=', 'site.id')
            ->where('tag.slug', $tag)
            ->orderBy('video.id', 'desc')
            ->paginate(20);

        return response()->json($videos);
    }

    /**
     * Fetch tags which are marked as "in-front", and return a JSON.
     * @return string
     */
    private function fetchInFrontTags()
    {
        $inFrontTags = [];
        $tags = Tag::with('video')->orderBy('tag')->whereIn('tag', [
            'Lesbian', 'Young', 'French', 'Teen',
            'Ebony', 'Domination', 'Bus', 'Foot',
            'Amateur', 'Anal', 'Babysitter', 'Hentai',
            'Big tits', 'Japanese', 'Grandpa', 'Public',
        ])->get();

        foreach ($tags as $tag) {
            $video = $tag->video->last();
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
