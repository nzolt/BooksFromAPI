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

use BookList\Connector\ParamBuilder\ParamBuilderInterface;
use BookList\Decorator\DecoratorInterface;

class Curl extends CurlAbstract
{
    const VERSION = '7.4.0';
    const DEFAULT_TIMEOUT = 10;
    const DEFAULT_REFERER = "http://www.example.org/list-books.html";
    protected $id;
    protected $curl;
    protected $params;
    protected $baseUrl = null;
    protected $requestUrl = null;
    protected $response = null;
    protected $rawResponse = null;
    protected $options = array();
    protected $decorator = null;
    protected $i=1;

    /**
     * Curl constructor.
     *
     * @param string $base_url
     * @param array $filters
     * @param ParamBuilderInterface $params
     * @param DecoratorInterface $decorator
     * @param null $timeout
     */
    public function __construct($base_url, array $filters, ParamBuilderInterface $params, DecoratorInterface $decorator, $timeout = null)
    {
        parent::__construct($base_url, $filters, $params, $decorator, $timeout);
        $this->decorator = $decorator;
        $this->params = $params;
        $this->baseUrl = $base_url;
        $this->curl = curl_init();
        $this->id = uniqid('', true);
        $this->setDefaultUserAgent();
        $this->setTimeout($timeout);
        $this->setHeaderOut(CURLINFO_HEADER_OUT, true);

        $this->setUrl($base_url);
    }

    /**
     * Execute cURL request
     *
     * @return mixed
     */
    public function query()
    {
        // Set a referer
        curl_setopt($this->curl, CURLOPT_REFERER, self::DEFAULT_REFERER);
        // Include header in result? (0 = yes, 1 = no)
        curl_setopt($this->curl, CURLOPT_HEADER, 1);
        // Should cURL return or print out the data? (true = return, false = print)
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        // Download the given URL, and return output
        $output = curl_exec($this->curl);

        // Close the cURL resource, and free system resources
        curl_close($this->curl);
        // Sample response for testing purpose only
        /*$output = json_encode(
            [
                ['title' => 'Test Book of One', 'sub_title' => 'Test Subtitle 1', 'price' => 12.00, 'author' => 'Tester John', 'available' => 1, 'edition' => 1997],
                ['title' => 'Test Book of Two', 'sub_title' => 'Test Subtitle 2', 'price' => 15.00, 'author' => 'Tester Thomas', 'available' => 1, 'edition' => 1998],
                ['title' => 'Test Book of Tree', 'sub_title' => 'Test Subtitle 3', 'price' => 18.00, 'author' => 'Tester Rob', 'available' => 1, 'edition' => 1990],
                ['title' => 'Test Book of Four', 'sub_title' => 'Test Subtitle 4', 'price' => 6.00, 'author' => 'Tester Michael', 'available' => 1, 'edition' => 2007],
            ]
        );*/

        return $this->decorator->setData($output)->getBooks();
    }

    /**
     * Set cURL default useragent
     *
     * @return Curl
     */
    protected function setDefaultUserAgent()
    {
        // User agent
        curl_setopt($this->curl, CURLOPT_USERAGENT, "Mozilla/1.0");
    }

    /**
     * Set timeout
     *
     * @param $timeout int
     * @return Curl
     */
    public function setTimeout($timeout)
    {
        curl_setopt($this->curl, CURLOPT_TIMEOUT, self::DEFAULT_TIMEOUT);
        if($timeout) {
            curl_setopt($this->curl, CURLOPT_TIMEOUT, $timeout);
        }

        return $this;
    }

    /**
     * @param $url
     * @return $this Curl
     */
    public function setUrl($url)
    {
        $this->requestUrl = $url . $this->params;
        curl_setopt($this->curl, CURLOPT_URL, $this->requestUrl);

        return $this;
    }

    /**
     * Setheder output
     *
     * @return $this Curl
     */
    public function setHeaderOut()
    {
        curl_setopt($this->curl, CURLINFO_HEADER_OUT, true);

        return $this;
    }

    public function getQueryString()
    {
        return $this->params;
    }

    /**
     * Set Connect Timeout
     *
     * @access public
     * @param  $seconds
     */
    public function setConnectTimeout($seconds)
    {
        curl_setopt($this->curl, CURLOPT_CONNECTTIMEOUT, $seconds);
    }
}