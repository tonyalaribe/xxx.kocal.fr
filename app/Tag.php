<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';

    public function videos() {
        return $this->belongsToMany(Video::class, 'video_tag_through');
//        return $this->hasManyThrough(Video::class, VideoTag::class, 'tag_id', 'id');
    }
}
