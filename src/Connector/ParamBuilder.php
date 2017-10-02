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

namespace BookList\Connector;

use BookList\Connector\ParamBuilder\ParamBuilderAbstract;
use BookList\Connector\ParamBuilder\ParamBuilderInterface;
use BookList\Exception\BookListParamException;

class ParamBuilder extends ParamBuilderAbstract implements ParamBuilderInterface
{
    protected $validParams = ['title', 'author', 'isbn'];

    protected $paramArray = [];
    protected $queryParams = [];

    /**
     * Time2BookListDecoratorInterface constructor.
     *
     * @param $data array
     * @param $validParams array
     * @return $this Time2BookListConnectorParamBuilderInterface
     */
    public function __construct(array $data, array $validParams = null)
    {
        $this->setValidParams($validParams);
        $this->validateParams($data);
        $this->buildParams($data);
        return $this;
    }

    /**
     * Time2BookListConnectorParamBuilderInterface constructor.
     *
     * @param array $data
     * @throws BookListParamException
     * @return array
     */
    protected function buildParams(array $data)
    {
        if(count($data) == 1) {
            $this->queryParams = http_build_query($data);
        } else {
            throw new BookListParamException('Too many params provided for search');
        }

        return $this->queryParams;
    }

    /**
     * Get cURL query string
     *
     * @return string;
     */
    public function __toString()
    {
        return '?' . $this->queryParams;
    }

}