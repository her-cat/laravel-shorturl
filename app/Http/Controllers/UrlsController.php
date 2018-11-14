<?php

namespace App\Http\Controllers;

use App\Events\UrlClicked;
use App\Exceptions\UrlExistException;
use App\Http\Requests\UrlRequest;
use App\Models\Url;
use Illuminate\Http\Request;

class UrlsController extends Controller
{
    public function create()
    {
        return view('urls.create');
    }

    public function store(UrlRequest $request, Url $url)
    {
        try {
            $url->fill($request->all())->save();
        } catch (UrlExistException $e) {
            $url = $e->geturl();
            $this->setMessage('网址已存在！');
        }

        $this->setKeyContent('shorturl', $url->shorturl);

        return $this->response();
    }

    public function redirect(Request $request, Url $url)
    {
        event(new UrlClicked($url, $request));

        return redirect($url->url);
    }
}
