<?php

namespace App\Observers;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

use App\Exceptions\UrlExistException;
use App\Models\Url;

class UrlObserver
{
    public function creating(Url $url)
    {
        if (empty($url->url)) {
            \abort(500, 'URL 不能为空！');
        }

        if (empty($url->hash) || $url->hash != md5($url->url)) {
            $url->hash = \md5($url->url);
        }

        $exist_url = Url::where('hash', $url->hash)->first();
        if ($exist_url) {
            throw new UrlExistException($exist_url);
        }

        if (empty($url->keyword)) {
            $keywords = generate_keyword($url->url);
            while (empty($url->keyword)) {
                $exist_keywords = Url::whereIn('keyword', $keywords)->pluck('keyword')->toArray();
                $keywords = array_diff($keywords, $exist_keywords);
                if (count($keywords) == 0) {
                    $keywords = generate_keyword($url->url . $url->hash . microtime(true));
                } else {
                    $url->keyword = array_pop($keywords);
                }
            }
        }
    }
}
