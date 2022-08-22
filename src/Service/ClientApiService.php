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

namespace BridgeSDK\Service;

use BridgeSDK\Model\Bank\Bank;
use BridgeSDK\Model\Payment\CreatePayment;
use BridgeSDK\Model\Payment\Payment;
use BridgeSDK\Request\BankRequest;
use BridgeSDK\Request\CreatePaymentRequest;
use BridgeSDK\Request\ListBanksRequest;
use BridgeSDK\Request\PaymentRequest;
use BridgeSDK\Response\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * Client Api Service Class.
 */
class ClientApiService extends AbstractClientApiService
{
    /**
     * @return ErrorResponse|ResponseInterface
     */
    public function getListBanks()
    {
        $request = new ListBanksRequest();

        return $this->call(null, $request);
    }

    /**
     * @param int $id
     *
     * @return ErrorResponse|ResponseInterface
     */
    public function getBankById($id)
    {
        $model = (new Bank())
            ->setId($id)
        ;

        $request = new BankRequest();

        return $this->call($model, $request);
    }

    /**
     * @param string $id
     *
     * @return ErrorResponse|ResponseInterface
     */
    public function getPayment($id)
    {
        $model = (new Payment())
            ->setId($id)
        ;

        $request = new PaymentRequest();

        return $this->call($model, $request);
    }

    /**
     * @return ErrorResponse|ResponseInterface
     */
    public function createPayment(CreatePayment $createPayment)
    {
        $request = new CreatePaymentRequest();

        return $this->call($createPayment, $request);
    }
}
