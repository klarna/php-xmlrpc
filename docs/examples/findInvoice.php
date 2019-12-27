<?php

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
$orderId1 = '55774';
try {
    $invoices = $k->findInvoice($orderId1);
    var_dump($invoices);
} catch (\Exception $e) {
    echo "{$e->getMessage()} (#{$e->getCode()})\n";
}

