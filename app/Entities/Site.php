<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Site extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'name',
        'url',
    ];

    public function getScheme() {
        $uri = new \Enrise\Uri($this->url);
        return $uri->getScheme();
    }

    public function getHost() {
        $uri = new \Enrise\Uri($this->url);
        return $uri->getHost();
    }
}
