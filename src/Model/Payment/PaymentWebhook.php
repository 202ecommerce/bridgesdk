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

class PaymentWebhook extends AbstractModel
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var null|PaymentWebhookTransactionUpdated
     */
    protected $content;

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return PaymentWebhook
     */
    public function setType($type)
    {
        if (true === \is_string($type)) {
            $this->type = $type;

            return $this;
        }

        throw new InvalidArgumentException(
            'Type must be a string '.\gettype($type).' is given.'
        );
    }

    /**
     * @return null|PaymentWebhookTransactionUpdated
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param null|PaymentWebhookTransactionUpdated $content
     *
     * @return PaymentWebhook
     */
    public function setContent($content)
    {
        if (null === $content || $content instanceof PaymentWebhookTransactionUpdated) {
            $this->content = $content;

            return $this;
        }

        throw new InvalidArgumentException(
            'Content must be a PaymentWebhookTransactionUpdated or null, '.\gettype($content).' is given.'
        );
    }

    public function hydrate(array $content)
    {
        if (!empty($content['type'])) {
            $this->setType($content['type']);
        }

        if (!empty($content['content'])) {
            $paymentWebhookTransaction = (new PaymentWebhookTransactionUpdated())->hydrate($content['content']);
            $this->setContent($paymentWebhookTransaction);
        }

        return $this;
    }
}
