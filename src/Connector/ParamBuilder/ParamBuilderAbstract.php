<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 29/09/2017
 * Time: 19:09
 */

namespace BookList\Connector\ParamBuilder;

use BookList\Exception;

/**
 * Class ParamBuilderAbstract
 * @package BookList
 */
abstract class ParamBuilderAbstract
{
    /**
     * Validate query params
     *
     * @param $data
     * @throws Exception\BookListParamException
     */
    protected function validateParams($data)
    {
        $paramArray = $data;
        $paramCount = 0;
        foreach ($paramArray as $paramKey => $paramValue) {
            if(in_array($paramKey, $this->validParams)) {
                $paramCount++;
            }
        }

        if($paramCount === 0) {
            throw new Exception\BookListParamException();
        }
    }

    /**
     * Combine valid params with predefined valid params
     *
     * @param $validParams
     * @return $this
     */
    protected function setValidParams($validParams)
    {
        if(is_array($validParams)) {
            $this->validParams = array_unique(array_merge($this->validParams, $validParams));
        }

        return $this;
    }
}