<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'video_tag_through', 'tag_id', 'video_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
