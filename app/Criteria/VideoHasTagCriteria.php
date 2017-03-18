<?php

namespace App\Criteria;

use App\Entities\Tag;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class VideoCriteria
 * @package namespace App\Criteria;
 */
class VideoHasTagCriteria implements CriteriaInterface
{
    /**
     * @var Tag
     */
    private $tag;

    /**
     * VideoCriteria constructor.
     * @param $tag
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
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
        return $model->whereHas('tags', function($q) {
           $q->where('slug', $this->tag->slug);
        });
    }
}
