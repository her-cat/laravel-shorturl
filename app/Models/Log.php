<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['url_id', 'shorturl', 'referer', 'user_agent', 'ip_address'];
}
