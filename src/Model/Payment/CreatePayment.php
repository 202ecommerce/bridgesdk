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
    private $successfulCallbackUrl;

    /**
     * @var string
     */
    private $unsuccessfulCallbackUrl;

    /**
     * @var int
     */
    private $bankId;

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
    public function getSuccessfulCallbackUrl()
    {
        return $this->successfulCallbackUrl;
    }

    /**
     * @param string $successfulCallbackUrl
     *
     * @return CreatePayment
     */
    public function setSuccessfulCallbackUrl($successfulCallbackUrl)
    {
        if (true === \is_string($successfulCallbackUrl)) {
            $this->successfulCallbackUrl = $successfulCallbackUrl;

            return $this;
        }

        throw new InvalidArgumentException(
            'Successful callback url must be a string '.\gettype($successfulCallbackUrl).' is given.'
        );
    }

    /**
     * @return string
     */
    public function getUnsuccessfulCallbackUrl()
    {
        return $this->unsuccessfulCallbackUrl;
    }

    /**
     * @param string $unsuccessfulCallbackUrl
     *
     * @return CreatePayment
     */
    public function setUnsuccessfulCallbackUrl($unsuccessfulCallbackUrl)
    {
        if (true === \is_string($unsuccessfulCallbackUrl)) {
            $this->unsuccessfulCallbackUrl = $unsuccessfulCallbackUrl;

            return $this;
        }

        throw new InvalidArgumentException(
            'Unsuccessful callback url must be a string '.\gettype($unsuccessfulCallbackUrl).' is given.'
        );
    }

    /**
     * @return int
     */
    public function getBankId()
    {
        return $this->bankId;
    }

    /**
     * @param int $bankId
     *
     * @return CreatePayment
     */
    public function setBankId($bankId)
    {
        if (true === \is_int($bankId)) {
            $this->bankId = $bankId;

            return $this;
        }

        throw new InvalidArgumentException(
            'Bank id must be an int '.\gettype($bankId).' is given.'
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
