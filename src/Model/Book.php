<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 30/09/2017
 * Time: 09:23
 */

namespace BookList\Model;

/**
 * Class Book
 * @package BookList\Model
 */
class Book
{
    /**
     * Get book as array
     *
     * @return array
     */
    public function __toArray()
    {
        return get_object_vars($this);
    }
}