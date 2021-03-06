<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = ['url'];

    public function getRouteKeyName()
    {
        return 'keyword';
    }

    public function getShorturlAttribute()
    {
        $short_url = sprintf(
            '%s/%s',
            config('app.url'),
            $this->keyword
        );

        return $short_url;
    }
}
