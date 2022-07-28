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

namespace BridgeSDK\Model;

use InvalidArgumentException;
use JsonSerializable;

class Callback extends AbstractModel implements JsonSerializable
{
    // PROPERTIES

    /**
     * @var string|null
     */
    private $contractReference;

    /**
     * @var string|null
     */
    private $merchantReference;

    /**
     * @var string|null
     */
    private $merchantOrderId;

    /**
     * @var string
     */
    private $eventDate;

    /**
     * @var int
     */
    private $triggeredForStatus;

    // GETTERS & SETTERS

    /**
     * Get Contract Reference
     *
     * @return string|null
     */
    public function getContractReference()
    {
        return $this->contractReference;
    }

    /**
     * Set Contract Reference
     *
     * @param string|null $contractReference
     *
     * @return self
     */
    public function setContractReference($contractReference)
    {
        if (is_string($contractReference) === true || is_null($contractReference) === true) {
            $this->contractReference = $contractReference;
            return $this;
        }

        throw new InvalidArgumentException(
            'Contract Reference must be a string or null but ' . gettype($contractReference) . ' is given.'
        );
    }

    /**
     * Get Merchant Reference
     *
     * @return string|null
     */
    public function getMerchantReference()
    {
        return $this->merchantReference;
    }

    /**
     * Set Merchant Reference
     *
     * @param string|null $merchantReference
     *
     * @return self
     */
    public function setMerchantReference($merchantReference)
    {
        if (is_string($merchantReference) === true || is_null($merchantReference) === true) {
            $this->merchantReference = $merchantReference;
            return $this;
        }

        throw new InvalidArgumentException(
            'Merchant Reference must be a string or null but ' . gettype($merchantReference) . ' is given.'
        );
    }

    /**
     * Get Merchant Order Id
     *
     * @return string|null
     */
    public function getMerchantOrderId()
    {
        return $this->merchantOrderId;
    }

    /**
     * Set Merchant Order Id
     *
     * @param string|null $merchantOrderId
     *
     * @return self
     */
    public function setMerchantOrderId($merchantOrderId)
    {
        if (is_string($merchantOrderId) === true || is_null($merchantOrderId) === true) {
            $this->merchantOrderId = $merchantOrderId;
            return $this;
        }

        throw new InvalidArgumentException(
            'Merchant Order Id must be a string or null but ' . gettype($merchantOrderId) . ' is given.'
        );
    }

    /**
     * Get Event Date
     *
     * @return string
     */
    public function getEventDate()
    {
        return $this->eventDate;
    }

    /**
     * Set Event Date
     *
     * @param string $eventDate
     *
     * @return self
     */
    public function setEventDate($eventDate)
    {
        if (is_string($eventDate) === true) {
            $this->eventDate = $eventDate;
            return $this;
        }

        throw new InvalidArgumentException(
            'Event Date must be a string but ' . gettype($eventDate) . ' is given.'
        );
    }

    /**
     * Get Triggered For Status
     *
     * @return int
     */
    public function getTriggeredForStatus()
    {
        return $this->triggeredForStatus;
    }

    /**
     * Set Triggered For Status
     *
     * @param int $triggeredForStatus
     *
     * @return self
     */
    public function setTriggeredForStatus($triggeredForStatus)
    {
        if (is_int($triggeredForStatus) === true) {
            $this->triggeredForStatus = $triggeredForStatus;
            return $this;
        }

        throw new InvalidArgumentException(
            'Triggered For Status must be an integer but ' . gettype($triggeredForStatus) . ' is given.'
        );
    }
}
