<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';

    public function getUrlAttribute()
    {
        return $this->absolutizeUrl($this->attributes['url']);
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->absolutizeUrl($this->attributes['thumbnail_url']);
    }

    public function site()
    {
        return $this->belongsTo('App\Site');
    }

    private function absolutizeUrl($uri)
    {
        $uri = new \Enrise\Uri($uri);

        if ($uri->isRelative()) {
            $uri->setHost($this->site->getHost());
            $uri->setScheme($this->site->getScheme());
        }

        return $uri->getUri();
    }
}
