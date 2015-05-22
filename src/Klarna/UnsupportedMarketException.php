<?php
/**
 * Klarna Exceptions
 *
 * PHP Version 5.3
 *
 * @category  Payment
 * @package   KlarnaAPI
 * @author    MS Dev <ms.modules@klarna.com>
 * @copyright 2012 Klarna AB (http://klarna.com)
 * @license   http://opensource.org/licenses/BSD-2-Clause BSD-2
 * @link      https://developers.klarna.com/
 */

/**
 * Exception for invalid Email
 *
 * @category  Payment
 * @package   KlarnaAPI
 * @author    MS Dev <ms.modules@klarna.com>
 * @copyright 2012 Klarna AB (http://klarna.com)
 * @license   http://opensource.org/licenses/BSD-2-Clause BSD-2
 * @link      https://developers.klarna.com/
 */
class Klarna_UnsupportedMarketException extends KlarnaException
{
    /**
     * Constructor
     *
     * @param string|array $countries allowed countries
     */
    public function __construct($countries)
    {
        if (is_array($countries)) {
            $countries = implode(", ", $countries);
        }
        parent::__construct(
            "This method is only available for customers from: {$countries}",
            50025
        );
    }
}
