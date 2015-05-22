<?php
/**
 * Klarna Exceptions
 *
 * PHP Version 5.3
 *
 * @category  Payment
 * @package   KlarnaAPI
 * @author    Klarna <support@klarna.com>
 * @copyright 2012 Klarna AB (http://klarna.com)
 * @license   http://opensource.org/licenses/BSD-2-Clause BSD-2
 * @link      https://developers.klarna.com/
 */

/**
 * Exception for Country and Currency mismatch
 *
 * @category  Payment
 * @package   KlarnaAPI
 * @author    Klarna <support@klarna.com>
 * @copyright 2012 Klarna AB (http://klarna.com)
 * @license   http://opensource.org/licenses/BSD-2-Clause BSD-2
 * @link      https://developers.klarna.com/
 */
class Klarna_CountryCurrencyMismatchException extends KlarnaException
{
    /**
     * Constructor
     *
     * @param mixed $country  country
     * @param mixed $currency currency
     */
    public function __construct($country, $currency)
    {
        $countryCode = KlarnaCountry::getCode($country);
        parent::__construct(
            "Mismatching country/currency for '{$countryCode}'! ".
            "[country: $country currency: $currency]",
            50011
        );
    }
}
