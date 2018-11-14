<?php

namespace App\Listeners;

use App\Events\UrlClicked;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddAccessLog implements ShouldQueue
{
    /**
     * 最大尝试次数
     * @var int
     */
    public $tries = 1;

    /**
     * Handle the event.
     *
     * @param UrlClicked $event
     * @return void
     */
    public function handle(UrlClicked $event)
    {
        $url = $event->getUrl();
        $headers = $event->getHeaders();

        Log::create([
            'url_id' => $url->id,
            'shorturl' => $url->shorturl,
            'referer' => $headers->get('referer'),
            'user_agent' => $headers->get('user_agent'),
            'ip_address' => $headers->get('ip_address'),
        ]);
    }
}
