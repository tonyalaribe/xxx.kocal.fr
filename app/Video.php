<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';

    public function site() {
        return $this->belongsTo('App\Site');
    }
}
