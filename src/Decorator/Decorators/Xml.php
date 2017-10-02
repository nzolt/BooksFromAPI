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