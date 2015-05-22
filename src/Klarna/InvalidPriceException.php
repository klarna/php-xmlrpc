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
 * Exception for invalid price
 *
 * @category  Payment
 * @package   KlarnaAPI
 * @author    MS Dev <ms.modules@klarna.com>
 * @copyright 2012 Klarna AB (http://klarna.com)
 * @license   http://opensource.org/licenses/BSD-2-Clause BSD-2
 * @link      https://developers.klarna.com/
 */
class Klarna_InvalidPriceException extends KlarnaException
{
    /**
     * Constructor
     *
     * @param mixed $price price
     */
    public function __construct($price)
    {
        parent::__construct(
            "price/amount must be an integer and greater than 0! ($price)",
            50039
        );
    }
}
