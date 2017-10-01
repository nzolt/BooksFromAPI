<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 30/09/2017
 * Time: 02:10
 */

namespace BookList\Connector\Facade;


use BookList\Connector\ParamBuilder;
use BookList\Decorator\DecoratorInterface;
use BookList\Decorator\Decorators;

class Connector
{
    /**
     * @var ParamBuilder
     */
    protected $paramBuilder;
    /**
     * @var DecoratorInterface
     */
    protected $decorator;

    protected $connectorFacade;

    public function __construct($baseUrl, $data, $validParams, $connector = 'curl', $format = 'json', $timeout = 30)
    {
        $this->paramBuilder = new ParamBuilder($data, $validParams);

        switch ($format) {
            case 'json':
                $this->decorator = new Decorators\Json($data, $validParams);
                break;
            case 'xml':
                $this->decorator = new Decorators\Xml($data, $validParams);
        }

        switch($connector) {
            case 'curl':
                $facadeClass = "BookList\\Connector\\Curl\\Curl";
                break;
        }

        $this->connectorFacade = new $facadeClass(
            $baseUrl,
            $data,
            $this->paramBuilder,
            $this->decorator,
            30
        );
    }

    /**
     *
     */
    public function getConnector()
    {
        return $this->connectorFacade;
    }
}