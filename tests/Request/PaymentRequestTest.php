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

namespace Tests\Integration\Request;

use BridgeSDK\Client;
use BridgeSDK\Constant\PaymentStatuses;
use BridgeSDK\Model\Payment\Payment;
use BridgeSDK\Request\PaymentRequest;
use BridgeSDK\Response\PaymentResponse;
use Tests\Integration\IntegrationTestCase;

class PaymentRequestTest extends IntegrationTestCase
{
    /**
     * @dataProvider getCallPaymentOkDataProvider
     * @param $id
     * @param $status
     * @param $bankId
     * @return void
     */
    public function testCallPaymentOk($id, $status, $bankId, $amount, $expectedOutput)
    {
        $request = (new PaymentRequest())
            ->setModel((new Payment())
                ->setId($id)
            );

        $client = $this->createMock(Client::class);
        $response = new PaymentResponse(200, [], $expectedOutput);
        $client->expects($this->once())
            ->method('sendRequest')
            ->willReturn($response);
        $response = $client->sendRequest($request);

        $model = $response->getModel();

        $this->assertInstanceOf(Payment::class, $model);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($id, $model->getId());
        $this->assertEquals($status, $model->getStatus());
        $this->assertEquals($bankId, $model->getBankId());
        $this->assertEquals($amount, $model->getTransactions()[0]->getAmount());
    }

    public function getCallPaymentOkDataProvider()
    {
        return [
            ['e815420d4b414a9c8b007c57196c19b5', PaymentStatuses::REJECTED_PAYMENTS[1], 6, 10.5, '{"id":"e815420d4b414a9c8b007c57196c19b5","status":"RJCT","status_reason":"CUST","user":{"first_name":"Unit","last_name":"Test","external_reference":"testApiCallBanksOk","ip_address":"78.203.165.12"},"sender":{},"transactions":[{"id":"8b9a9c6bca8f4e85b5f0b027efce5599","status":"RJCT","status_reason":"CUST","beneficiary":{"iban":"FR76XXXXXXXXXXXXXXXXXXXX185","name":"Denys Bridge","company_name":"Denys Bridge"},"amount":10.5,"currency":"EUR","label":"Label Unit test","client_reference":"testApiCallBanksOk","execution_date":"2022-07-29","end_to_end_id":"testApiCallBanksOk"}],"created_at":"2022-07-29T12:15:06.211Z","updated_at":"2022-07-29T12:33:58.277Z","bank_id":6}'],
            ['bf80034b41764d88b0bb4eef9017e6bb', PaymentStatuses::REJECTED_PAYMENTS[1], 6, 10.5, '{"id":"bf80034b41764d88b0bb4eef9017e6bb","status":"RJCT","status_reason":"NOAS","user":{"first_name":"Thomas","last_name":"Pichet","external_reference":"AEF142536-890","ip_address":"192.168.1.1"},"sender":{},"transactions":[{"id":"79d05eb1684f4afaa8f5e703669e84fb","status":"RJCT","status_reason":"NOAS","beneficiary":{"iban":"FR76XXXXXXXXXXXXXXXXXXXX185","name":"Denys Bridge","company_name":"Denys Bridge"},"amount":10.5,"currency":"EUR","label":"label test","client_reference":"ABCDE-EEEE_9398848","end_to_end_id":"E2E_TEST-123"}],"created_at":"2022-07-29T10:08:39.631Z","updated_at":"2022-07-29T11:09:27.535Z","bank_id":6}'],
            ['2dd3d0b2abe443b98f0e6a2763c37bca', PaymentStatuses::REJECTED_PAYMENTS[1], 17, 12, '{"id":"2dd3d0b2abe443b98f0e6a2763c37bca","status":"RJCT","status_reason":"NOAS","user":{"name":"User name","ip_address":"0.0.0.0"},"sender":{},"transactions":[{"id":"f988f40979554876ab6e375274ba8aee","status":"RJCT","status_reason":"NOAS","beneficiary":{"iban":"FR76XXXXXXXXXXXXXXXXXXXX185","name":"Denys Bridge","company_name":"Denys Bridge"},"amount":12.0,"currency":"EUR","label":"label test","client_reference":"ABCDE-EEEE_9398848","end_to_end_id":"E2E_TEST-123"}],"created_at":"2022-03-15T15:16:35.249Z","updated_at":"2022-03-15T16:17:20.347Z","bank_id":17}'],
        ];
    }
}
