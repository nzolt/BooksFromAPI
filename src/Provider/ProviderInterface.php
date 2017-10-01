<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 29/09/2017
 * Time: 18:31
 */

namespace BookList\Provider;

use BookList\Connector\ParamBuilder;
use BookList\Decorator;

interface ProviderInterface
{
    /**
     * ProviderInterface constructor.
     *
     * @param array $data
     * @param array $validParams
     */
    public function __construct(array $data, array $validParams);

    /**
     * Get books by filter from Provider API
     *
     * @return array
     */
    public function getBooks();

    /**
     * Get specifik API endpoint by provider for specific search
     *
     * @return string
     */
    public function getBaseApiUrl();
}