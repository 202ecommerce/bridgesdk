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

namespace Integration\Request;

use BridgeSDK\Client;
use BridgeSDK\Constant\PaymentStatuses;
use BridgeSDK\Model\Payment\Payment;
use BridgeSDK\Request\PaymentRequest;
use Tests\Integration\IntegrationTestCase;

class PaymentRequestTest extends IntegrationTestCase
{
    /**
     * @dataProvider getApiCallPaymentOkDataProvider
     * @param $id
     * @param $status
     * @param $bankId
     * @return void
     */
    public function testApiCallPaymentOk($id, $status, $bankId, $amount)
    {
        $request = (new PaymentRequest())
            ->setModel((new Payment())
                ->setId($id)
            );
        $client = new Client();
        $response = $client->setCredentials($this->clientId, $this->clientSecret)
            ->sendRequest($request);

        $model = $response->getModel();

        $this->assertInstanceOf(Payment::class, $model);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($id, $model->getId());
        $this->assertEquals($status, $model->getStatus());
        $this->assertEquals($bankId, $model->getBankId());
        $this->assertEquals($amount, $model->getTransactions()[0]->getAmount());
    }

    public function getApiCallPaymentOkDataProvider()
    {
        return [
            ['e815420d4b414a9c8b007c57196c19b5', PaymentStatuses::REJECTED_PAYMENTS[1], 6, 10.5],
            ['bf80034b41764d88b0bb4eef9017e6bb', PaymentStatuses::REJECTED_PAYMENTS[1], 6, 10.5],
            ['2dd3d0b2abe443b98f0e6a2763c37bca', PaymentStatuses::REJECTED_PAYMENTS[1], 17, 12],
        ];
    }
}
