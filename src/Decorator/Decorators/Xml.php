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

class Xml extends DecoratorAbstract
{
    /**
     * Buld books array from response
     *
     * @return $this
     */
    protected function buildResponse()
    {
        $book = new Model\Book();
        foreach ($this->result as $result) {
            foreach ($this->expectedParams as $expectedParam) {
                $book[$expectedParam] = call_user_func(array($result, $expectedParam));
            }
            $this->addToCollection($book);
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
        $this->result = simplexml_load_string($this->data);
        $this->result->setParserProperty(XMLReader::VALIDATE, true);

        if($this->result === false) {
            throw new BookListResultException('The result is not valid XML');
        }
    }
}