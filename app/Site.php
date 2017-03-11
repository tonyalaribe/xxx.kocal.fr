<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'site';

    public function getScheme() {
        $uri = new \Enrise\Uri($this->url);
        return $uri->getScheme();
    }

    public function getHost() {
        $uri = new \Enrise\Uri($this->url);
        return $uri->getHost();
    }
}
