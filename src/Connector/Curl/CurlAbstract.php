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