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