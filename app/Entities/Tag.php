<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Tag extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'tag',
        'slug'
    ];

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'videos_tags_through', 'tag_id', 'video_id');
    }
}
