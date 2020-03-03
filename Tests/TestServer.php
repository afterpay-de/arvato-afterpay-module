<?php
/**
 * This Software is the property of OXID eSales and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license key
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * @category  module
 * @package   afterpay
 * @author    OXID Professional services
 * @link      http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2020
 */

/**
 * Test server for WebServiceClientTest.
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo 'GET works';
} else {
    $data = file_get_contents('php://input');

    if ($data == 'POST data') {
        echo 'POST works';
    } elseif ($data == '{"data":"json"}') {
        echo '{"status":"success"}';
    }
}