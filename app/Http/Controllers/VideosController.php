<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function showLastVideosAction()
    {
        $videos = Video::paginate(40);

        return view('videos', [
            'videos' => $videos
        ]);
    }

    public function showVideosBySearchTerms(Request $request)
    {
        if (!$request->has('q')) {
            return redirect()->route('videos');
        }

        $searchTerms = $request->get('q');

        $videos = Video::where('title', 'like', '%' . $searchTerms . '%')
            ->paginate(40);

        $videos->appends(['q' => $searchTerms]);
        $request->flashOnly('q');

        return view('videos_by_search_terms', [
            'searchTerms' => $searchTerms,
            'videos' => $videos
        ]);
    }

    public function showVideosByTagAction(Tag $tag)
    {
        $videos = Video::with('tags')
            ->whereHas('tags', function ($q) use ($tag) {
                $q->where('slug', '=', $tag->slug);
            })
            ->paginate(40);

        return view('videos_by_tag', [
            'tag' => $tag,
            'videos' => $videos
        ]);
    }
}
