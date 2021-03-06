<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Video extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'title',
        'url',
        'thumbnail_url',
        'duration',
    ];

    protected $fieldSearcheable = [
        'title' => 'like'
    ];

    public function getUrlAttribute()
    {
        return $this->absolutizeUrl($this->attributes['url']);
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->absolutizeUrl($this->attributes['thumbnail_url']);
    }

    public function getDurationAttribute()
    {
        $seconds = $this->attributes['duration'];
        $format = 'i:s';

        if ($seconds > 60 * 60) {
            $format = 'H:' . $format;
        }

        return gmdate($format, $seconds);
    }

    public function getISO8601DurationAttribute()
    {
        $duration = new \Bretterer\IsoDurationConverter\DurationParser();
        return $duration->compose($this->attributes['duration']);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'videos_tags_through', 'video_id', 'tag_id');
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
