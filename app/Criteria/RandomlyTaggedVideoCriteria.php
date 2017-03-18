<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class RandomlyTaggedVideoCriteria
 * @package namespace App\Criteria;
 */
class RandomlyTaggedVideoCriteria implements CriteriaInterface
{
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
        return $model->with([
            'videos' => function ($q) {
                $q
                    ->select(['thumbnail_url'])
                    ->inRandomOrder()
                    ->limit(1);
            }]);
    }
}
