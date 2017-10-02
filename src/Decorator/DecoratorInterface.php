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

namespace BookList\Decorator;


interface DecoratorInterface
{

    /**
     * Time2_BookList_Decorator_Interface constructor.
     *
     * @param $data mixed
     * @param $expectedParams array
     */
    public function __construct($data, array $expectedParams = []);

    /**
     * @param array $expectedParams
     * @return Time2_BookList_Decorator_Interface $this
     */
    public function addExpectedParams(array $expectedParams);

    /**
     * Get list of books from query result
     *
     * @return mixed;
     */
    public function getBooks();

    /**
     * Set data from response
     *
     * @param string $data
     * @return $this
     */
    public function setData($data);

    /**
     * Validate response from API
     *
     * @param string $data
     * @throws BookListResultException
     */
    public function validateResult($data);

    /**
     * @param string $providerName
     * @return mixed
     */
    public function setProviderName($providerName);

}