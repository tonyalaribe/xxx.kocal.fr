<?php

namespace App\Http\Controllers;

use App\Criteria\PopularTagsCriteria;
use App\Criteria\RandomlyTaggedVideoCriteria;
use App\Repositories\TagRepository;
use App\Repositories\VideoTagRepository;
use Illuminate\Support\Facades\Cache;

class TagsController extends Controller
{
    /**
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * @var VideoTagRepository
     */
    private $videoTagRepository;

    public function __construct(TagRepository $tagRepository, VideoTagRepository $videoTagRepository)
    {
        $this->tagRepository = $tagRepository;
        $this->videoTagRepository = $videoTagRepository;
    }

    public function showTagsAction()
    {
        $sortedTags = Cache::remember('sortedTags', 60 * 60 * 24, function () {
            $tags = $this->tagRepository->orderBy('tag')->all(['tag', 'slug']);
            $sortedTags = [];

            foreach ($tags as $tag) {
                $firstLetter = $tag->slug[0];
                $firstLetter = is_numeric($firstLetter) ? '0-9' : $firstLetter;

                if ($tag->slug === $tag->tag) {
                    continue;
                }

                $sortedTags[$firstLetter][] = $tag;
            }

            return $sortedTags;
        });

        return view('tags', [
            'sortedTags' => $sortedTags
        ]);
    }

    public function showPopularTagsAction()
    {
        $maxPopularTags = 40;

        $popularTags = Cache::remember('popular_tags', 60 * 60 * 24, function () use ($maxPopularTags) {
            $popularTags = collect();

            $this->videoTagRepository->pushCriteria(new PopularTagsCriteria($maxPopularTags));
            $this->tagRepository->pushCriteria(new RandomlyTaggedVideoCriteria());

            foreach ($this->videoTagRepository->all(['tag_id'])->pluck('tag_id') as $tag_id) {
                $popularTag = $this->tagRepository->scopeQuery(function ($q) use ($tag_id) {
                    return $q->where('id', $tag_id);
                })
                    ->all(['id', 'tag', 'slug']);
                $popularTags = $popularTags->merge($popularTag);
            }

            return $popularTags;
        });

        return view('tags_popular', [
            'maxPopularTags' => $maxPopularTags,
            'popularTags' => $popularTags
        ]);
    }
}
