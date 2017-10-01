<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 29/09/2017
 * Time: 19:09
 */

namespace BookList\Connector\ParamBuilder;

interface ParamBuilderInterface
{
    /**
     * ParamBuilderInterface constructor.
     *
     * @param $data array
     * @param $validParams array
     * @return $this ParamBuilderInterface
     */
    public function __construct(array $data, array $validParams);

    /**
     * ParamBuilderInterface __toString.
     *
     * @return array
     */
    public function __toString();
}