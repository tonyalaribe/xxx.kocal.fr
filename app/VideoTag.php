<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoTag extends Model
{
    protected $table = 'video_tag_through';

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'id', 'video_id');
    }

    public function video()
    {
        return $this->hasOne(Video::class, 'id', 'video_id');
    }
}
