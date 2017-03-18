<?php

namespace App\Http\Controllers;

use App\Criteria\OrderByIdDescCriteria;
use App\Criteria\VideoTitleLikeCriteria;
use App\Repositories\VideoRepository;
use App\Video;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * @var VideoRepository
     */
    private $videoRepository;

    /**
     * AdminController constructor.
     * @param $videoRepository
     */
    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function showVideosAction(Request $request)
    {
        if ($request->ajax()) {
            $videos = $this->videoRepository->with(['site']);

            if (null !== $searchTerms = $request->get('search')) {
                $videos = $videos->pushCriteria(new VideoTitleLikeCriteria($searchTerms));
            }

            return $videos->paginate($request->get('paginate'))->toJson();
        }

        return view('admin.videos');
    }

    public function deleteVideo($id)
    {
        $this->videoRepository->delete($id);
    }
}
