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

namespace BookList\Connector;

use BookList\Connector\ParamBuilder\ParamBuilderInterface;
use BookList\Decorator\DecoratorInterface;

interface ConnectorInterface
{
    /**
     * Interface constructor.
     * @param string $base_url
     * @param array $filters
     * @param ParamBuilderInterface $params
     * @param DecoratorInterface $decorator
     * @param null|int $timeout
     */
    public function __construct($base_url, array $filters, ParamBuilderInterface $params, DecoratorInterface $decorator, $timeout = null);

    /**
     * Execute query on provider API
     *
     * @return mixed
     */
    public function query();
}