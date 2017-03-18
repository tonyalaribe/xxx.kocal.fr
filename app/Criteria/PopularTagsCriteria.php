<?php

namespace App\Criteria;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class PopularTagsCriteria
 * @package namespace App\Criteria;
 */
class PopularTagsCriteria implements CriteriaInterface
{
    private $max;

    /**
     * PopularTagsCriteria constructor.
     * @param $max
     */
    public function __construct($max = 30)
    {
        $this->max = $max;
    }


    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model
            ->select(['tag_id', DB::raw('COUNT(video_id) as count')])
            ->orderBy('count', 'desc')
            ->groupBy('tag_id')
            ->limit($this->max);
    }
}
