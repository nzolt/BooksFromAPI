<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 29/09/2017
 * Time: 20:15
 */

namespace BookList\Connector\Curl;

use BookList\Connector\ConnectorInterface;
use BookList\Connector\ParamBuilder\ParamBuilderInterface;
use BookList\Decorator\DecoratorInterface;

/**
 * Class CurlAbstract
 * @package BookList
 */
abstract class CurlAbstract implements ConnectorInterface
{
    /**
     * CurlAbstract constructor.
     * @param string $base_url
     * @param array $filters
     * @param ParamBuilderInterface $params
     * @param DecoratorInterface $decorator
     * @param null $timeout
     * @throws BookListCurlException
     */
    public function __construct($base_url, array $filters, ParamBuilderInterface $params, DecoratorInterface $decorator, $timeout = null)
    {
        // is cURL installed yet?
        if (!extension_loaded('curl') || !function_exists('curl_init')) {
            throw new BookListCurlException();
        }

        $this->validateUrl($base_url);
    }

    /**
     * Validate API base url
     *
     * @param string $url
     * @throws BookListUrlException
     */
    protected function validateUrl($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new BookListUrlException();
        }
    }

    /**
     * Get decorator instance from connector
     *
     * @return DecoratorInterface
     */
    public function getDecorator()
    {
        return $this->decorator;
    }
}