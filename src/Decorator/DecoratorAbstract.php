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