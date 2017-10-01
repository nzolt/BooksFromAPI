<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 30/09/2017
 * Time: 07:31
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