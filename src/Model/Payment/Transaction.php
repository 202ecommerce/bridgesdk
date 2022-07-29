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

use BridgeSDK\Constant\PaymentStatuses;
use BridgeSDK\Model\AbstractModel;
use InvalidArgumentException;

class Transaction extends CreatePaymentTransaction
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $status;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Transaction
     */
    public function setId($id)
    {
        if (is_string($id) === true) {
            $this->id = $id;
            return $this;
        }

        throw new InvalidArgumentException(
            'Id must be a string ' . gettype($id) . ' is given.'
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
     * @return Transaction
     */
    public function setStatus($status)
    {
        if (is_string($status) === true && in_array($status, PaymentStatuses::getAllStatuses())) {
            $this->status = $status;
            return $this;
        }

        throw new InvalidArgumentException(
            'Status must be a string ' . gettype($status) . ' is given or status is not valid.'
        );
    }
}
