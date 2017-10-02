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