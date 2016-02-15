<?php

require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';

$k = new Klarna();

$k->config(
    0,                    // Merchant ID
    'sharedSecret',       // Shared secret
    KlarnaCountry::SE,    // Purchase country
    KlarnaLanguage::SV,   // Purchase language
    KlarnaCurrency::SEK,  // Purchase currency
    Klarna::BETA,         // Server
    'json',               // PClass storage
    './pclasses.json'     // PClass storage URI path
);

$invNo = '123456';
$numDays = 5; // Numbers of days to extend with

try {
    $result = $k->extendInvoiceDueDate($invNo, $numDays);
    $cost = $result['cost'];
    $newDate = $result['new_date'];

    echo "OK: extended invoice due date to {$newDate} which costs ${cost}\n";
} catch(Exception $e) {
    echo "{$e->getMessage()} (#{$e->getCode()})\n";
}
