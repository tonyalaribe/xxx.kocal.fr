<?php

namespace App\Http\Controllers;

use App\Criteria\OrderByIdDescCriteria;
use App\Criteria\VideoHasTagCriteria;
use App\Criteria\VideoTitleLikeCriteria;
use App\Entities\Tag;
use App\Repositories\VideoRepository;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    /**
     * @var VideoRepository
     */
    protected $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function showLastVideosAction()
    {
        $videos = $this->repository->with(['site'])->paginate();

        return view('videos', [
            'videos' => $videos
        ]);
    }

    public function showVideosBySearchTermsAction(Request $request)
    {
        if (null === $searchTerms = $request->get('q')) {
            return redirect()->route('videos');
        }

        $this->repository->pushCriteria(new VideoTitleLikeCriteria($searchTerms));
        $videos = $this->repository->with(['site'])->paginate();
        $videos->appends(['q' => $searchTerms]);

        $request->flashOnly('q');

        return view('videos_by_search_terms', [
            'searchTerms' => $searchTerms,
            'videos' => $videos
        ]);
    }

    public function showVideosByTagAction(Tag $tag)
    {
        $this->repository->pushCriteria(new VideoHasTagCriteria($tag));
        $videos = $this->repository->with(['site', 'tags'])->paginate();

        return view('videos_by_tag', [
            'tag' => $tag,
            'videos' => $videos
        ]);
    }
}
