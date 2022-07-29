<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * PHP version 5.6+
 *
 * @category  BridgeSDK
 * @package   EcommerceBridgeSDK
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
    private $externalReference;

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
     * @return PaymentUser
     */
    public function setFirstName($firstName)
    {
        if (is_string($firstName) === true) {
            $this->firstName = $firstName;
            return $this;
        }

        throw new InvalidArgumentException(
            'First name must be a string ' . gettype($firstName) . ' is given.'
        );
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
     * @return PaymentUser
     */
    public function setLastName($lastName)
    {
        if (is_string($lastName) === true) {
            $this->lastName = $lastName;
            return $this;
        }

        throw new InvalidArgumentException(
            'Last name must be a string ' . gettype($lastName) . ' is given.'
        );
    }

    /**
     * @return string
     */
    public function getExternalReference()
    {
        return $this->externalReference;
    }

    /**
     * @param string $externalReference
     * @return PaymentUser
     */
    public function setExternalReference($externalReference)
    {
        if (is_string($externalReference) === true) {
            $this->externalReference = $externalReference;
            return $this;
        }

        throw new InvalidArgumentException(
            'External reference must be a string ' . gettype($externalReference) . ' is given.'
        );
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
     * @return PaymentUser
     */
    public function setIpAddress($ipAddress)
    {
        if (is_string($ipAddress) === true) {
            $this->ipAddress = $ipAddress;
            return $this;
        }

        throw new InvalidArgumentException(
            'Ip address must be a string ' . gettype($ipAddress) . ' is given.'
        );
    }
}
