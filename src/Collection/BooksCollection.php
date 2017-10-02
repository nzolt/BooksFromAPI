<?php
/**
 * Composer package
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category   Time2
 * @package    Time2_BookList
 * @author     Time2 Digital Limited <zoltan.nagy@time2.digital>
 * @copyright  Copyright (c) 2017 Time2 Digital Limited (http://www.time2.digital)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace BookList\Collection;

use BookList\Decorator\DecoratorInterface;
use BookList\Model\Book;

/**
 * Class BooksCollection
 * @package BookList\Collection
 */
class BooksCollection extends Singleton
{
    protected $books = [];

    /**
     * Add books from respose decorator to Books collection
     *
     * @param string $providerName
     * @param Book $book
     */
    public function addBook($providerName, Book $book)
    {
        $this->books[$providerName][] = $book;
    }

    public function getData()
    {
        return $this->books;
    }

    /**
     * Get list of books as Object or Array
     *
     * @return array
     */
    public function __toArray()
    {
        $booksCollectionAsArray = [];
        foreach ($this->books as $key => $provider) {
            foreach ($provider as $book) {
                $booksCollectionAsArray[$key][] = $book->__toArray();
            }
        }

        return $booksCollectionAsArray;
    }
}