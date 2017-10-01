<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 30/09/2017
 * Time: 12:04
 */

namespace BookList\Test\Model;

use BookList\Model\Book;

class BookTest extends \PHPUnit_Framework_TestCase
{
    protected $bookClass;

    public function setUp()
    {
        $this->bookClass = new Book();
    }

    public function testClass()
    {
        self::assertInstanceOf('BookList\\Model\\Book', $this->bookClass);
    }
}