<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 29/09/2017
 * Time: 19:09
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
     * @return array
     */
    protected function buildParams($data)
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