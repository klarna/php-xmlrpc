<?php
/**
 * Created by PhpStorm.
 * User: mattias.nording
 * Date: 2016-09-07
 * Time: 09:42
 */
require_once dirname(dirname(dirname(__FILE__))).'/vendor/autoload.php';

use Klarna\XMLRPC\Klarna;
use Klarna\XMLRPC\Country;
use Klarna\XMLRPC\Language;
use Klarna\XMLRPC\Currency;

$k = new Klarna();

$k->config(
    0,              // Merchant ID
    'test', // Shared secret
    Country::SE,    // Purchase country
    Language::SV,   // Purchase language
    Currency::SEK,  // Purchase currency
    Klarna::BETA    // Server
);

$invNo = '41609665391255774';


try {
    $status =  $k->checkInvoiceStatus($invNo);
    $result["payMethod "] = $status[0];
    $result["isPaid "] = $status[1];
    $result["dueDate "] = $status[2];
    var_dump($result);
} catch (\Exception $e) {
    echo "{$e->getMessage()} (#{$e->getCode()})\n";
}