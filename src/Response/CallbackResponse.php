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

namespace BridgeSDK\Response;

use InvalidArgumentException;
use BridgeSDK\Model\ArrayCollection;
use BridgeSDK\Model\Callback;
use BridgeSDK\Model\Error;

class CallbackResponse extends AbstractResponse
{
    /**
     * @inherit
     */
    public function getModel()
    {
        $content = (string) $this->stream;
        if (empty($content) === true) {
            return new ArrayCollection();
        }
        $output = json_decode($content, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new InvalidArgumentException(
                'json_decode error: ' . json_last_error_msg()
            );
        }
        if (empty($output) === true) {
            return new ArrayCollection();
        }

        if ($this->getStatusCode() < 200 || $this->getStatusCode() > 299) {
            $errorDetail = null;

            if ($this->getStatusCode() === 401) {
                $errorDetail = 'Callback processing could not be execute because he does not come from YounitedPay API';
            } elseif ($this->getStatusCode() === 408) {
                $errorDetail = 'Callback processing could not complete in a timely manner, callback will be retried later';
            } elseif ($this->getStatusCode() >= 400 && $this->getStatusCode() <= 499) {
                $errorDetail = 'Callback processing failed due to a non transient error, callback will not be retried.';
            } elseif ($this->getStatusCode() >= 500 && $this->getStatusCode() <= 599) {
                $errorDetail = 'Callback processing failed due to a transient error, callback will be retried later.';
            }

            return (new Error())
                ->setTitle($this->getReasonPhrase())
                ->setStatus($this->getStatusCode())
                ->setDetail($errorDetail);
        }

        return (new Callback())->hydrate($output);
    }
}
