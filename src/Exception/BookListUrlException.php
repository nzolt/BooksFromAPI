<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 29/09/2017
 * Time: 18:20
 */

namespace BookList\Exception;


class BookListUrlException extends BookListException
{
    const URL_ERROR_CODE = 1002;

    protected $code = self::URL_ERROR_CODE;
    protected $message = 'Url is not provided!';
}