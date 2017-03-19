<?php

namespace App\Repositories;

use App\Entities\VideoTag;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class VideoTagRepositoryEloquent
 * @package namespace App\Repositories;
 */
class VideoTagRepositoryEloquent extends BaseRepository implements VideoTagRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return VideoTag::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function groupBy($by)
    {
        $this->model->groupBy($by);

        return $this;
    }
}
