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

class CreatePaymentTransaction extends AbstractModel
{
    /**
     * @var string
     */
    protected $currency = 'EUR';

    /**
     * @var string
     */
    protected $label;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @var string
     */
    protected $clientReference;

    /**
     * @var string
     */
    protected $endToEndId;

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     *
     * @return CreatePaymentTransaction
     */
    public function setCurrency($currency)
    {
        if (true === \is_string($currency)) {
            $this->currency = $currency;

            return $this;
        }

        throw new InvalidArgumentException(
            'Currency must be a string '.\gettype($currency).' is given.'
        );
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return CreatePaymentTransaction
     */
    public function setLabel($label)
    {
        if (true === \is_string($label)) {
            $this->label = $label;

            return $this;
        }

        throw new InvalidArgumentException(
            'Label must be a string '.\gettype($label).' is given.'
        );
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     *
     * @return CreatePaymentTransaction
     */
    public function setAmount($amount)
    {
        if (true === \is_float($amount)) {
            $this->amount = $amount;

            return $this;
        }

        throw new InvalidArgumentException(
            'Amount must be a float '.\gettype($amount).' is given.'
        );
    }

    /**
     * @return string
     */
    public function getClientReference()
    {
        return $this->clientReference;
    }

    /**
     * @param string $clientReference
     *
     * @return CreatePaymentTransaction
     */
    public function setClientReference($clientReference)
    {
        if (true === \is_string($clientReference)) {
            $this->clientReference = $clientReference;

            return $this;
        }

        throw new InvalidArgumentException(
            'Client reference must be a string '.\gettype($clientReference).' is given.'
        );
    }

    /**
     * @return string
     */
    public function getEndToEndId()
    {
        return $this->endToEndId;
    }

    /**
     * @param string $endToEndId
     *
     * @return CreatePaymentTransaction
     */
    public function setEndToEndId($endToEndId)
    {
        if (true === \is_string($endToEndId)) {
            $this->endToEndId = $endToEndId;

            return $this;
        }

        throw new InvalidArgumentException(
            'End to end id must be a string '.\gettype($endToEndId).' is given.'
        );
    }
}
