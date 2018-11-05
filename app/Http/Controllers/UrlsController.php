<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlRequest;
use App\Models\Url;

class UrlsController extends Controller
{
    public function create()
    {
        return view('urls.create');
    }

    public function store(UrlRequest $request, Url $url)
    {
        $url->url = $request->url;
        $short_urls = generate_keyword($request->url);
        $url->keyword = array_pop($short_urls);
        $url->save();

        return $url->short_url;
    }

    public function redirect(Url $url)
    {
        return redirect($url->url)->header('reffer', config('app.url'));
    }
}