<?php

namespace App\Events;

use App\Models\Url;
use Illuminate\Http\Request;
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
     * @var array
     */
    protected $headers;

    /**
     * Create a new event instance.
     *
     * @param Url $url
     * @param Request $request
     */
    public function __construct(Url $url, Request $request)
    {
        $this->url = $url;
        $request->headers->set('ip_address', $request->getClientIp());
        $this->headers = $request->headers;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

}
