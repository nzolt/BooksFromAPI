<?php
/**
 * Created by PhpStorm.
 * User: nzolt
 * Date: 30/09/2017
 * Time: 09:04
 */

namespace BookList\Collection;

/**
 * Class Singleton
 * @package BookList\Collection
 */
class Singleton
{
    private static $instances = array();

    /**
     * Singleton constructor.
     */
    protected function __construct() {}

    /**
     * Singleton clone.
     */
    protected function __clone() {}

    /**
     * Singleton wakeup.
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }

    /**
     * Singleton getInstance.
     *
     * @return mixed
     */
    public static function getInstance()
    {
        $cls = get_called_class();
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static;
        }
        return self::$instances[$cls];
    }
}