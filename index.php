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

namespace BookList;

require_once __DIR__ . '/vendor/autoload.php';

use BookList\Facade;

echo 'Object';
$bookList = new Facade\Books(['title' => 'test book'], ['sub_title', 'not_exist']);
$books = $bookList->getCollection();

foreach ($books as $key => $provider) {
    echo 'Provider: ' . $key . ' </br>';
    foreach ($provider as $book) {
        echo '<pre>';
        echo 'Title: ' . $book->title . ' </br>';
        echo 'Sub title' . $book->sub_title . ' </br>';
        echo 'Not exists: ' . $book->not_exist . ' </br>';
        echo '</pre>';
    }
}


echo 'Array </br>';
//$bookList = new Facade\Books(['title' => 'test book'], ['sub_title', 'not_exist']);
//$books = $bookList->getCollection();
foreach ($books as $key => $provider) {
    echo 'Provider: ' . $key . ' </br>';
    foreach ($provider as $book) {
        $book = $book->__toArray();
        echo '<pre>';
        echo 'Title: ' . $book['title'] . ' </br>';
        echo 'Sub title' . $book['sub_title'] . ' </br>';
        echo 'Not exists: ' . $book['not_exist'] . ' </br>';
        echo '</pre>';
    }
}