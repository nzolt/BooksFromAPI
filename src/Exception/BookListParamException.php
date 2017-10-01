<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 29/09/2017
 * Time: 18:20
 */

namespace BookList\Exception;

/**
 * Class BookListParamException
 * @package BookList
 */
class BookListParamException extends BookListException
{
    const PARAM_ERROR_CODE = 1003;

    protected $code = self::PARAM_ERROR_CODE;
    protected $message = 'Valid parameters must be provided';
}