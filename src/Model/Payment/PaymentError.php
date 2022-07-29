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

class PaymentError extends AbstractModel
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $message;

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return PaymentError
     */
    public function setCode($code)
    {
        if (is_string($code) === true) {
            $this->code = $code;
            return $this;
        }

        throw new InvalidArgumentException(
            'Code must be a string ' . gettype($code) . ' is given.'
        );
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return PaymentError
     */
    public function setMessage($message)
    {
        if (is_string($message) === true) {
            $this->message = $message;
            return $this;
        }

        throw new InvalidArgumentException(
            'Message must be a string ' . gettype($message) . ' is given.'
        );
    }
}
