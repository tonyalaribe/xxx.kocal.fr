<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class VideoCriteria
 * @package namespace App\Criteria;
 */
class VideoTitleLikeCriteria implements CriteriaInterface
{
    /**
     * @var string
     */
    private $title;

    /**
     * VideoCriteria constructor.
     * @param $title
     */
    public function __construct($title)
    {
        $this->title = $title;
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
        return $model->where('title', 'like', '%' . $this->title . '%');
    }
}
