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

namespace BookList\Provider;

use BookList\Connector\Facade;

abstract class ProviderAbstract implements ProviderInterface
{
    protected $format = 'json';
    protected $providerName;
    protected $validParams;
    protected $connectorClass = 'curl';
    protected $connector;
    protected $baseUrl = '';
    protected $apiEndpoints = [];
    protected $data;

    /**
     * Readanybook constructor.
     *
     * @param array $data
     * @param array $validParams
     */
    public function __construct(array $data, array $validParams)
    {
        $this->data = $data;
        // Instantiate Connector for this provider
        $this->connector = new Facade\Connector(
            $this->getBaseApiUrl(),
            $this->data,
            $validParams,
            $this->connectorClass,
            $this->format
        );
    }

    /**
     * Get books by filter from Provider API
     *
     * @return mixed
     */
    public function getBooks()
    {
        $connector = $this->connector->getConnector();
        $connector->getDecorator()->setProviderName($this->providerName);

        $this->connector->getConnector()->query();
        return $this;
    }

    /**
     * Get specifik API endpoint by provider for specific search
     *
     * @return string
     */
    public function getBaseApiUrl()
    {
        $apiUrl = $this->baseUrl . $this->apiEndpoints[key($this->data)];

        return $apiUrl;
    }
}