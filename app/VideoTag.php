<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoTag extends Model
{
    protected $table = 'videos_tags_through';

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'id', 'video_id');
    }
}
