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


// Method: addArticle

// Handling fee, price including VAT.
$flags = KlarnaFlags::INC_VAT | KlarnaFlags::IS_HANDLING;
$k->addArticle(
    4,              // Quantity
    "HANDLING",     // Article number
    "Handling fee", // Article name/title
    50.99,          // Price
    25,             // 25% VAT
    0,              // Discount
    $flags          // Flags
);


// Method: setAddress

$addr = new KlarnaAddr(
    'always_approved@klarna.com', // Email address
    '',                           // Telephone number, only one phone number is needed
    '0762560000',                 // Cell phone number
    'Testperson-se',              // First name (given name)
    'Approved',                   // Last name (family name)
    '',                           // No care of, C/O
    'Stårgatan 1',                // Street address
    '12345',                      // Zip code
    'Ankeborg',                   // City
    KlarnaCountry::SE,            // Country
    null,                         // House number (AT/DE/NL only)
    null                          // House extension (NL only)
);

$k->setAddress(KlarnaFlags::IS_BILLING, $addr);
$k->setAddress(KlarnaFlags::IS_SHIPPING, $addr);

// PClass related methods

$pclass1 = new KlarnaPClass();
$pclass1->setId(1);

$pclass2 = new KlarnaPClass();
$pclass2->setId(2);


// Method: calcMonthlyCost

$amount = 149.99;
$pclass = $k->getCheapestPClass($amount, KlarnaFlags::PRODUCT_PAGE, array($pclass1, $pclass2));
if ($pclass) {
    $monthly = KlarnaCalc::calc_monthly_cost($amount, $pclass, KlarnaFlags::PRODUCT_PAGE);

    echo "monthly cost: {$monthly}\n";
}


// Method: totalCreditPurchaseCost

$amount = 100.50;
if ($pclass) {
    $total = KlarnaCalc::total_credit_purchase_cost($amount, $pclass1, KlarnaFlags::CHECKOUT_PAGE);

    echo "total credit purchase cost: {$total}\n";
}


// Method: calcAPR

$amount = 105.50;
if ($pclass) {
    $apr = KlarnaCalc::calc_apr($amount, $pclass2, KlarnaFlags::CHECKOUT_PAGE);

    echo "apr: {$apr}\n";
}


// $pclasses is now a list of KlarnaPClass instances.
