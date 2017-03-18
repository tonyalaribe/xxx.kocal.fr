<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\VideoTagRepository;
use App\Entities\VideoTag;
use App\Validators\VideoTagValidator;

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
}
