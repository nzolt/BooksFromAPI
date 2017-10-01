<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 29/09/2017
 * Time: 18:20
 */

namespace BookList\Exception;


class BookListException extends \Exception
{
    const PARAM_ERROR_CODE = 1000;

    protected $code = self::PARAM_ERROR_CODE;
    protected $message = 'Error during execution';
}