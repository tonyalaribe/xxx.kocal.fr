<?php

namespace App\Repositories;

use App\Entities\Site;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class SiteRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SiteRepositoryEloquent extends BaseRepository implements SiteRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Site::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
