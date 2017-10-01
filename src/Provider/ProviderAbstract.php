<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 29/09/2017
 * Time: 18:31
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