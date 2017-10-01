<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 29/09/2017
 * Time: 18:09
 */

namespace BookList\Decorator;

use BookList\Collection;
use BookList\Model\Book;

/**
 * Class Time2BookListDecoratorAbstract
 * @package BookList
 */
abstract class DecoratorAbstract implements DecoratorInterface {

    protected $expectedParams = ['title', 'price', 'author', 'available', 'edition'];
    protected $data;
    protected $result;
    protected $booksCollection;
    protected $providerName;

    /**
     * Time2BookListDecoratorAbstract constructor.
     *
     * @param mixed $data
     * @param array $expectedParams
     */
    public function __construct($data = null, array $expectedParams = [])
    {
        $this->addExpectedParams($expectedParams);
        $this->booksCollection = Collection\BooksCollection::getInstance();
    }

    /**
     * Set $data from API response
     *
     * @param string $data
     * @return $this
     */
    public function setData($data)
    {
        $this->validateResult($data);
        $this->buildResponse();

        return $this;
    }

    public function addToCollection(Book $book)
    {
        $this->booksCollection->addBook($this->providerName, $book);
    }

    /**
     * Add more expected params to default set
     *
     * @param array $expectedParams
     * @return $this
     */
    public function addExpectedParams(array $expectedParams)
    {
        $this->expectedParams = array_unique(array_merge($this->expectedParams, $expectedParams));

        return $this;
    }

    /**
     * Get array of books from response with values based on $expectedParams
     *
     * @return array;
     */
    public function getBooks()
    {
        return $this->booksCollection;
    }

    /**
     * Set provider name
     *
     * @param string $providerName
     * @return $this
     */
    public function setProviderName($providerName)
    {
        $this->providerName = $providerName;

        return $this;
    }

}