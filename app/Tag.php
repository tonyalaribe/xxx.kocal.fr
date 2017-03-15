<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';

    public function videos () {
        return $this->hasManyThrough(Video::class, VideoTag::class, 'video_id', 'id');
    }
}
