<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';

    public function video() {
        return $this->belongsToMany(Video::class, 'video_tag_through');
    }
}
