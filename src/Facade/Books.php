<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 30/09/2017
 * Time: 01:31
 */

namespace BookList\Facade;

use BookList\Provider\Providers;
use BookList\Collection;

class Books
{
    const RESULT_TYPE = 'json';

    protected $availableProviders = [
        'BookList\\Provider\\Providers\\Bookrix',
        'BookList\\Provider\\Providers\\Readanybook'
        ];
    protected $providers = [];
    protected $booksList = [];

    /**
     * Books constructor.
     *
     * @param array $params
     * @param array $expectedFields
     */
    public function __construct(array $params, array $expectedFields)
    {
        $this->registerProviders($params, $expectedFields);

        return $this;
    }

    /**
     * Get Collection of Books
     *
     * @param bool $asArray
     * @return mixed
     */
    public function getCollection($asArray = false)
    {
        $this->getBooks();

        return Collection\BooksCollection::getInstance()->getData();
    }

    /**
     * Register available Provider instances
     *
     * @param array $params
     * @param array $expectedFields
     */
    function registerProviders(array $params, array $expectedFields)
    {
        // Instantiate Providers
        foreach ($this->availableProviders as $availableProvider) {
            $provider = new $availableProvider($params, $expectedFields);
            if (is_subclass_of($provider, 'BookList\\Provider\\ProviderAbstract')) {
                $this->addProvider($provider);
            }
        }
    }

    /**
     * Get books by filter from Provider API
     *
     * @param boolean $asArray
     * @return mixed
     */
    public function getBooks($asArray = false)
    {
        foreach ($this->providers as $provider) {
            $provider->getBooks($asArray);
        }
    }

    protected function addProvider($provider)
    {
        $this->providers[] = $provider;
    }

    public function getProviders()
    {
        return $this->providers;
    }

}