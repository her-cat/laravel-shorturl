<?php
/**
 * Created by PhpStorm.
 * User: HeXiangHui
 * Date: 2018/11/9
 * Time: 11:25
 */

namespace App\Exceptions;


use App\Models\Url;

class UrlExistException extends \Exception
{
    /**
     * @var Url
     */
    private $url;

    /**
     * UrlExistsException constructor.
     * @param Url $url
     */
    public function __construct(Url $url)
    {
        $this->url = $url;
    }

    /**
     * @return Url
     */
    public function getUrl()
    {
        return $this->url;
    }
}