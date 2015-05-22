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
 * Exception for invalid pcstorage class
 *
 * @category  Payment
 * @package   KlarnaAPI
 * @author    Klarna <support@klarna.com>
 * @copyright 2012 Klarna AB (http://klarna.com)
 * @license   http://opensource.org/licenses/BSD-2-Clause BSD-2
 * @link      https://developers.klarna.com/
 */
class Klarna_PCStorageInvalidException extends KlarnaException
{
    /**
     * Constructor
     *
     * @param string $className     classname
     * @param string $pclassStorage pcstorage class file
     */
    public function __construct($className, $pclassStorage)
    {
        parent::__construct(
            "$className located in $pclassStorage is not a PCStorage instance.",
            50052
        );
    }
}
