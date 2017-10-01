<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 29/09/2017
 * Time: 20:18
 */

namespace BookList\Connector;

use BookList\Connector\ParamBuilder\ParamBuilderInterface;
use BookList\Decorator\DecoratorInterface;

interface ConnectorInterface
{
    /**
     * Interface constructor.
     * @param string $base_url
     * @param array $filters
     * @param ParamBuilderInterface $params
     * @param DecoratorInterface $decorator
     * @param null|int $timeout
     */
    public function __construct($base_url, array $filters, ParamBuilderInterface $params, DecoratorInterface $decorator, $timeout = null);

    /**
     * Execute query on provider API
     *
     * @return mixed
     */
    public function query();
}