<?php

namespace App\Repositories;

use App\Entities\Video;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class VideoRepositoryEloquent
 * @package namespace App\Repositories;
 */
class VideoRepositoryEloquent extends BaseRepository implements VideoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Video::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
