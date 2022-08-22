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

namespace BridgeSDK\Request;

use BridgeSDK\Model\AbstractModel;
use BridgeSDK\Model\Payment\Payment;
use BridgeSDK\Response\PaymentResponse;
use InvalidArgumentException;

class PaymentRequest extends AbstractRequest
{
    protected $requestTarget = '/payment-requests/:idPayment';

    protected $method = 'GET';

    protected $response = PaymentResponse::class;

    public function setModel(AbstractModel $body)
    {
        if ($body instanceof Payment) {
            $this->uri = $this->uri->withPath(str_replace(':idPayment', $body->getId(), $this->uri->getPath()));

            return parent::setModel($body);
        }

        throw new InvalidArgumentException(
            'Body must be an instance of '.Payment::class.' '.\get_class($body).' given.'
        );
    }
}
