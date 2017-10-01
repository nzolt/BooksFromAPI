<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 30/09/2017
 * Time: 01:28
 */

namespace BookList\Provider\Providers;

use BookList\Provider\ProviderAbstract;

class Bookrix extends ProviderAbstract
{
    protected $format = 'json';
    protected $providerName = 'Bookrix';

    protected $baseUrl = 'https://www.bookrix.com/v-1.1/';
    protected $apiEndpoints = [
        'title' => 'bytitle',
        'author' => 'byauthos',
        'isbn' => 'byisbn'
    ];
}