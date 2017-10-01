<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 30/09/2017
 * Time: 01:28
 */

namespace BookList\Provider\Providers;

use BookList\Provider\ProviderAbstract;

class Readanybook extends ProviderAbstract
{
    protected $format = 'json';
    protected $providerName = 'Readanybook';

    protected $baseUrl = 'https://www.readanybook.com/V1/';
    protected $apiEndpoints = [
        'title' => 'by-title',
        'author' => 'by-authos',
        'isbn' => 'by-isbn'
    ];
}