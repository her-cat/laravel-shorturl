<?php

namespace App\Listeners;

use App\Events\UrlClicked;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateUrlClicks implements ShouldQueue
{
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
        $url->update(['clicks' => $url->clicks + 1]);
    }
}