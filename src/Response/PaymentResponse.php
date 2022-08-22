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

namespace BridgeSDK\Response;

use BridgeSDK\Model\AbstractModel;
use BridgeSDK\Model\ArrayCollection;
use BridgeSDK\Model\Error;
use BridgeSDK\Model\Payment\Payment;
use BridgeSDK\Model\Payment\PaymentErrors;
use InvalidArgumentException;

class PaymentResponse extends AbstractResponse
{
    /**
     * Get body.
     *
     * @return null|AbstractModel|ArrayCollection<AbstractModel>
     */
    public function getModel()
    {
        $content = (string) $this->stream;
        if (true === empty($content)) {
            return new ArrayCollection();
        }
        $output = json_decode($content, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new InvalidArgumentException(
                'json_decode error: '.json_last_error_msg()
            );
        }
        if (true === empty($output)) {
            return new Payment();
        }

        if (404 === $this->getStatusCode()) {
            $errors = (new PaymentErrors())->hydrate($output);
            if (null !== $errors) {
                return $errors;
            }

            return (new Error())->hydrate($output);
        }

        if ($this->getStatusCode() < 200 || $this->getStatusCode() > 299) {
            return (new Error())->hydrate($output);
        }

        return (new Payment())->hydrate($output);
    }
}
