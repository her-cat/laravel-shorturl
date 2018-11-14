<?php

namespace App\Listeners;

use App\Events\UrlClicked;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateUrlClicks implements ShouldQueue
{
    /**
     * 最大尝试次数
     * @var int
     */
    public $tries = 1;

    /**
     * Handle the event.
     *
     * @param  UrlClicked  $event
     * @return void
     */
    public function handle(UrlClicked $event)
    {
        $url = $event->getUrl();
        // 更新点击次数
        \DB::table($url->getTable())->where('id', $url->id)->increment('clicks');
    }
}
