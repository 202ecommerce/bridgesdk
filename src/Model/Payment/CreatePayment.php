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

class CreatePayment extends AbstractModel
{
    /**
     * @var string
     */
    private $callbackUrl;

    /**
     * @var int
     */
    private $providerId;

    /**
     * @var array<CreatePaymentTransaction>
     */
    private $transactions;

    /**
     * @var PaymentUser
     */
    private $user;

    /**
     * @return string
     */
    public function getCallbackUrl()
    {
        return $this->callbackUrl;
    }

    /**
     * @param string $callbackUrl
     *
     * @return CreatePayment
     */
    public function setCallbackUrl($callbackUrl)
    {
        if (true === \is_string($callbackUrl)) {
            $this->callbackUrl = $callbackUrl;

            return $this;
        }

        throw new InvalidArgumentException(
            'Callback url must be a string '.\gettype($callbackUrl).' is given.'
        );
    }

    /**
     * @return int
     */
    public function getProviderId()
    {
        return $this->providerId;
    }

    /**
     * @param int $providerId
     *
     * @return CreatePayment
     */
    public function setProviderId($providerId)
    {
        if (true === \is_int($providerId)) {
            $this->providerId = $providerId;

            return $this;
        }

        throw new InvalidArgumentException(
            'Provider id must be an int '.\gettype($providerId).' is given.'
        );
    }

    /**
     * @return array<CreatePaymentTransaction>
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * @param array<CreatePaymentTransaction> $transactions
     *
     * @return CreatePayment
     */
    public function setTransactions($transactions)
    {
        if (\is_array($transactions)) {
            $this->transactions = $transactions;

            return $this;
        }

        throw new InvalidArgumentException(
            'Transactions must be an array '.\gettype($transactions).' is given.'
        );
    }

    /**
     * @return PaymentUser
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param PaymentUser $user
     *
     * @return CreatePayment
     */
    public function setUser($user)
    {
        if ($user instanceof PaymentUser) {
            $this->user = $user;

            return $this;
        }

        throw new InvalidArgumentException(
            'User must be an ArrayCollection '.\gettype($user).' is given.'
        );
    }

    public function jsonSerialize()
    {
        return parent::jsonSerialize();
    }
}
