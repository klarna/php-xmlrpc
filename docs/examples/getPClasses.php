<?php

require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';

$k = new Klarna();

$k->config(
    0,                    // Merchant ID
    'sharedSecret',       // Shared secret
    KlarnaCountry::SE,    // Purchase country
    KlarnaLanguage::SV,   // Purchase language
    KlarnaCurrency::SEK,  // Purchase currency
    Klarna::BETA          // Server
);

try {
    $pclasses = $k->getPClasses();

    // $pclasses is now a list of KlarnaPClass instances.
    // Store them in your favourite DB for later use.

    var_dump($pclasses);
} catch(Exception $e) {
    echo "{$e->getMessage()} (#{$e->getCode()})\n";
}
