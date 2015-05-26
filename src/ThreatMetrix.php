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
 * Threatmetrix implementation of CheckoutHTML
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
 * ThreatMetrix is a fraud prevention and device identification software.
 *
 * @category   Payment
 * @package    KlarnaAPI
 * @author     Klarna <support@klarna.com>
 * @copyright  2015 Klarna AB
 * @license    http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link       https://developers.klarna.com/
 * @deprecated Class deprecated in version 3.3.0
 */
class ThreatMetrix extends CheckoutHTML
{
    /**
     * The ID used in conjunction with the Klarna API.
     *
     * @var int
     */
    const ID = 'dev_id_1';

    /**
     * ThreatMetrix organizational ID.
     *
     * @var string
     */
    protected $orgID = 'qicrzsu4';

    /**
     * Session ID for the client.
     *
     * @var string
     */
    protected $sessionID;

    /**
     * Hostname used to access ThreatMetrix.
     *
     * @var string
     */
    protected $host = 'h.online-metrix.net';

    /**
     * Protocol used to access ThreatMetrix.
     *
     * @var string
     */
    protected $proto = 'https';

    /**
     * Initializes this object, this method is always called
     * before {@link CheckoutHTML::toHTML()}.
     * This method is used in {@link Klarna::addTransaction()},
     * {@link Klarna::reserveAmount()} and in {@link Klarna::checkoutHTML()}
     *
     * @param Klarna $klarna The API instance
     * @param int    $eid    Merchant ID
     *
     * @return void
     */
    public function init($klarna, $eid)
    {
        if (!is_int($eid)) {
            throw new Klarna_ConfigFieldMissingException('eid');
        }
        if (isset($_SESSION)) {
            if (!isset($_SESSION[self::ID])
                || (strlen($_SESSION[self::ID]) < 40)
            ) {
                $_SESSION[self::ID] = parent::getSessionID($eid);
                $this->sessionID = $_SESSION[self::ID];
            } else {
                $this->sessionID = $_SESSION[self::ID];
            }
        } else {
            $this->sessionID = parent::getSessionID($eid);
        }

        $klarna->setSessionID(self::ID, $this->sessionID);
    }

    /**
     * This function is used to clear any stored values
     * (in SESSION, COOKIE or similar)
     * which are required to be unique between purchases.
     *
     * @return void
     */
    public function clear()
    {
        if (isset($_SESSION) && isset($_SESSION[self::ID])) {
            $_SESSION[self::ID] = null;
            unset($_SESSION[self::ID]);
        }
    }

    /**
     * This returns the HTML code for this object,
     * which will be used in the checkout page.
     *
     * @return string
     */
    public function toHTML()
    {
        $html
            = "<p style='display: none; ".
            "background:url($this->proto://$this->host/fp/clear.png?org_id=".
            "$this->orgID&session_id=$this->sessionID&m=1)'></p>".
            "<script src='$this->proto://$this->host/fp/check.js?org_id=".
            "$this->orgID&session_id=$this->sessionID' ".
            "type='text/javascript'></script>".
            "<img src='$this->proto://$this->host/fp/clear.png?org_id=".
            "$this->orgID&session_id=$this->sessionID&m=2' alt='' >".
            "<object type='application/x-shockwave-flash' style='display: none' ".
            "data='$this->proto://$this->host/fp/fp.swf?org_id=$this->orgID&".
            "session_id=$this->sessionID' width='1' height='1' id='obj_id'>".
            "<param name='movie' value='$this->proto://$this->host/fp/fp.swf?".
            "org_id=$this->orgID&session_id=$this->sessionID' />".
            "<div></div>".
            "</object>";
        return $html;
    }
}
