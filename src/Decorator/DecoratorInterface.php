<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 29/09/2017
 * Time: 19:11
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