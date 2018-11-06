<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    public function getRouteKeyName()
    {
        return 'keyword';
    }

    public function getShortUrlAttribute()
    {
        $short_url = sprintf(
            '%s/%s',
            config('app.url'),
            $this->keyword
        );

        return $short_url;
    }

    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = $value;
        $this->attributes['hash'] = md5($value);
    }
}
