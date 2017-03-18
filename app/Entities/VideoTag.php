<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class VideoTag extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'videos_tags_through';

    protected $fillable = [];
}
