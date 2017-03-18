<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function videos()
    {
        return $this->belongsToMany(Video::class, 'videos_tags_through', 'tag_id', 'video_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
