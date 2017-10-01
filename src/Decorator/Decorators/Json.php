<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 29/09/2017
 * Time: 18:07
 */

namespace BookList\Decorator\Decorators;

use BookList\Decorator\DecoratorAbstract;
use BookList\Collection;
use BookList\Model;
use BookList\Exception\BookListResultException;

/**
 * Class DecoratorJson
 * @package BookList
 */
class Json extends DecoratorAbstract
{
    /**
     * Buld books array from response
     *
     * @return $this
     */
    protected function buildResponse()
    {
        if(is_array($this->result)) {
            foreach ($this->result as $result) {
                $book = new Model\Book();
                foreach ($this->expectedParams as $expectedParam) {
                    if(array_key_exists($expectedParam, $result)) {
                        $book->{$expectedParam} = $result[$expectedParam];
                    } else {
                        $book->{$expectedParam} ='';
                    }

                }
                $this->addToCollection($book);
            }
        }

        return $this;
    }

    /**
     * Validate response from API
     *
     * @param string $data
     * @throws BookListResultException
     */
    public function validateResult($data)
    {
        $this->result = json_decode($data, true);

        if($this->result === false) {
            throw new BookListResultException('The result is not valid JSON');
        }
    }
}