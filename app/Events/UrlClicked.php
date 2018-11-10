<?php

namespace App\Events;

use App\Models\Url;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UrlClicked
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Url
     */
    protected $url;

    /**
     * Create a new event instance.
     *
     * @param Url $url
     */
    public function __construct(Url $url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }
}
