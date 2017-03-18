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
    private $repository;

    /**
     * AdminController constructor.
     * @param $repository
     */
    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function showVideosAction(Request $request)
    {
        if ($request->ajax()) {
            $this->repository->pushCriteria(new OrderByIdDescCriteria());
            $videos = $this->repository->with(['site']);

            if (null !== $searchTerms = $request->get('search')) {
                $videos = $videos->pushCriteria(new VideoTitleLikeCriteria($searchTerms));
            }

            return $videos->paginate($request->get('paginate'))->toJson();
        }

        return view('admin.videos');
    }

    public function deleteVideo($id)
    {
        $this->repository->delete($id);
    }
}
