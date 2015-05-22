<?php
/**
 * Copyright 2015 Klarna AB
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * CheckoutHTML interface for threatmetrix
 *
 * PHP version 5.3
 *
 * @category  Payment
 * @package   KlarnaAPI
 * @author    Klarna <support@klarna.com>
 * @copyright 2015 Klarna AB
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      https://developers.klarna.com/
 */

/**
 * This interface provides methods to supply checkout page specific HTML.<br>
 * Can be used to insert device identification, fraud prevention,<br>
 * client side validation code into the checkout page.
 *
 * @category   Payment
 * @package    KlarnaAPI
 * @author     Klarna <support@klarna.com>
 * @copyright  2015 Klarna AB
 * @license    http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link       https://developers.klarna.com/
 * @deprecated Class deprecated in version 3.3.0
 */
abstract class CheckoutHTML
{
    /**
     * Creates a session ID used for e.g. client identification and fraud
     * prevention.
     *
     * This method creates a 40 character long integer.
     * The first 30 numbers is microtime + random numbers.
     * The last 10 numbers is the eid zero-padded.
     *
     * All random functions are automatically seeded as of PHP 4.2.0.
     *
     * E.g. for eid 1004 output could be:
     * 1624100001298454658880354228080000001004
     *
     * @param int $eid merchant id
     *
     * @return string A integer with a string length of 40.
     */
    public static function getSessionID($eid)
    {
        $eid = strval($eid);
        while (strlen($eid) < 10) {
            $eid = "0" . $eid; //Zero-pad the eid.
        }

        $sid = str_replace(array(' ', ',', '.'), '', microtime());
        $sid[0] = rand(1, 9); //Make sure we always have a non-zero first.

        //microtime + rand = 30 numbers in length
        while (strlen($sid) < 30) {
            //rand is automatically seeded as of PHP 4.2.0
            $sid .= rand(0, 9999);
        }
        $sid = substr($sid, 0, 30);
        $sid .= $eid;

        return $sid;
    }

    /**
     * Initializes this object, this method is always called
     * before {@link CheckoutHTML::toHTML()}.
     * This method is used in {@link Klarna::addTransaction()},
     * {@link Klarna::reserveAmount()} and in {@link Klarna::checkoutHTML()}
     *
     * @param Klarna $klarna The API instance
     * @param int    $eid    merchant id
     *
     * @return void
     */
    abstract public function init($klarna, $eid);

    /**
     * This returns the HTML code for this object,
     * which will be used in the checkout page.
     *
     * @return string HTML
     */
    abstract public function toHTML();

    /**
     * This function is used to clear any stored values
     * (in SESSION, COOKIE or similar)
     * which are required to be unique between purchases.
     *
     * @return void
     */
    abstract public function clear();
}
