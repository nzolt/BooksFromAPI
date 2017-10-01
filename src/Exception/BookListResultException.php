<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 29/09/2017
 * Time: 18:20
 */

namespace BookList\Exception;


class BookListResultException extends \Exception
{
    const PARAM_ERROR_CODE = 1004;

    protected $code = self::PARAM_ERROR_CODE;
    protected $message = 'Invalid response';
}