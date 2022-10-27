<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * PHP version 5.6+
 *
 * @category  BridgeSDK
 * @package   Ecommercebridgesdk
 * @author    202-ecommerce <tech@202-ecommerce.com>
 * @copyright 2022 (c) 202-ecommerce
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * @link      https://docs.bridgeapi.io/
 */

namespace BridgeSDK\Model\Payment;

use BridgeSDK\Model\AbstractModel;
use InvalidArgumentException;

class PaymentUser extends AbstractModel
{
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $ipAddress;

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return PaymentUser
     */
    public function setFirstName($firstName)
    {
        if (true === \is_string($firstName)) {
            $this->firstName = $firstName;

            return $this;
        }

        throw new InvalidArgumentException('First name must be a string '.\gettype($firstName).' is given.');
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return PaymentUser
     */
    public function setLastName($lastName)
    {
        if (true === \is_string($lastName)) {
            $this->lastName = $lastName;

            return $this;
        }

        throw new InvalidArgumentException('Last name must be a string '.\gettype($lastName).' is given.');
    }

    /**
     * @return string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param string $ipAddress
     *
     * @return PaymentUser
     */
    public function setIpAddress($ipAddress)
    {
        if (true === \is_string($ipAddress)) {
            $this->ipAddress = $ipAddress;

            return $this;
        }

        throw new InvalidArgumentException('Ip address must be a string '.\gettype($ipAddress).' is given.');
    }
}
