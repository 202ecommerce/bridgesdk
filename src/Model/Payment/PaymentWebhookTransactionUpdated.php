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

use BridgeSDK\Constant\PaymentStatuses;
use BridgeSDK\Model\AbstractModel;
use InvalidArgumentException;

class PaymentWebhookTransactionUpdated extends AbstractModel
{
    /**
     * @var string
     */
    private $paymentTransactionId;

    /**
     * @var string
     */
    private $paymentRequestId;

    /**
     * @var ?string
     */
    private $paymentLinkId;

    /**
     * @var ?string
     */
    private $clientReference;

    /**
     * @var ?string
     */
    private $endToEndId;

    /**
     * @var string
     */
    private $status;

    /**
     * @var ?string
     */
    private $statusReason;

    /**
     * @return string
     */
    public function getPaymentTransactionId()
    {
        return $this->paymentTransactionId;
    }

    /**
     * @param string $paymentTransactionId
     *
     * @return PaymentWebhookTransactionUpdated
     */
    public function setPaymentTransactionId($paymentTransactionId)
    {
        if (true === \is_string($paymentTransactionId)) {
            $this->paymentTransactionId = $paymentTransactionId;

            return $this;
        }

        throw new InvalidArgumentException(
            'Payment transaction ID must be a string '.\gettype($paymentTransactionId).' is given.'
        );
    }

    /**
     * @return string
     */
    public function getPaymentRequestId()
    {
        return $this->paymentRequestId;
    }

    /**
     * @param string $paymentRequestId
     *
     * @return PaymentWebhookTransactionUpdated
     */
    public function setPaymentRequestId($paymentRequestId)
    {
        if (true === \is_string($paymentRequestId)) {
            $this->paymentRequestId = $paymentRequestId;

            return $this;
        }

        throw new InvalidArgumentException(
            'Payment request ID must be a string '.\gettype($paymentRequestId).' is given.'
        );
    }

    /**
     * @return null|string
     */
    public function getPaymentLinkId()
    {
        return $this->paymentLinkId;
    }

    /**
     * @param null|string $paymentLinkId
     *
     * @return PaymentWebhookTransactionUpdated
     */
    public function setPaymentLinkId($paymentLinkId)
    {
        if (true === \is_string($paymentLinkId) || null === $paymentLinkId) {
            $this->paymentLinkId = $paymentLinkId;

            return $this;
        }

        throw new InvalidArgumentException(
            'Payment link ID must be a string '.\gettype($paymentLinkId).' is given.'
        );
    }

    /**
     * @return null|string
     */
    public function getClientReference()
    {
        return $this->clientReference;
    }

    /**
     * @param null|string $clientReference
     *
     * @return PaymentWebhookTransactionUpdated
     */
    public function setClientReference($clientReference)
    {
        if (true === \is_string($clientReference) || null === $clientReference) {
            $this->clientReference = $clientReference;

            return $this;
        }

        throw new InvalidArgumentException(
            'Client reference must be a string '.\gettype($clientReference).' is given.'
        );
    }

    /**
     * @return null|string
     */
    public function getEndToEndId()
    {
        return $this->endToEndId;
    }

    /**
     * @param null|string $endToEndId
     *
     * @return PaymentWebhookTransactionUpdated
     */
    public function setEndToEndId($endToEndId)
    {
        if (true === \is_string($endToEndId) || null === $endToEndId) {
            $this->endToEndId = $endToEndId;

            return $this;
        }

        throw new InvalidArgumentException(
            'End to end id be a string '.\gettype($endToEndId).' is given.'
        );
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return PaymentWebhookTransactionUpdated
     */
    public function setStatus($status)
    {
        if (true === \is_string($status) && \in_array($status, PaymentStatuses::getAllStatuses(), true)) {
            $this->status = $status;

            return $this;
        }

        throw new InvalidArgumentException(
            'Status must be a string '.\gettype($status).' is given or status is not valid.'
        );
    }

    /**
     * @return null|string
     */
    public function getStatusReason()
    {
        return $this->statusReason;
    }

    /**
     * @param null|string $statusReason
     *
     * @return PaymentWebhookTransactionUpdated
     */
    public function setStatusReason($statusReason)
    {
        if (true === \is_string($statusReason) || null === $statusReason) {
            $this->statusReason = $statusReason;

            return $this;
        }

        throw new InvalidArgumentException(
            'Status reason must be a string '.\gettype($statusReason).' is given.'
        );
    }
}
