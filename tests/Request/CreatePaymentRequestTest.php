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

namespace Tests\Request;

use BridgeSDK\Client;
use BridgeSDK\Model\Error;
use BridgeSDK\Model\Payment\CreatePayment;
use BridgeSDK\Model\Payment\CreatePaymentTransaction;
use BridgeSDK\Model\Payment\CreatePaymentUrl;
use BridgeSDK\Model\Payment\PaymentErrors;
use BridgeSDK\Model\Payment\PaymentUser;
use BridgeSDK\Request\CreatePaymentRequest;
use BridgeSDK\Response\CreatePaymentResponse;
use PHPUnit\Framework\TestCase;

class CreatePaymentRequestTest extends TestCase
{
    public function testCallCreatePaymentOk()
    {
        $body = $this->getValidBody();

        $request = (new CreatePaymentRequest())
            ->setModel($body);

        $client = $this->createMock(Client::class);
        $response = new CreatePaymentResponse(200, [], '{"id":"test_id","consent_url":"https://pay.bridgeapi.io/payment/test_id/initiate"}');

        $client->expects($this->once())
            ->method('sendRequest')
            ->willReturn($response);

        $response = $client->sendRequest($request);
        $model = $response->getModel();

        $this->assertInstanceOf(CreatePaymentUrl::class, $model);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @dataProvider getCallCreatePaymentErrorDataProvider
     * @return void
     */
    public function testCallCreatePaymentError($clientId, $clientSecret, $version, $expectedErrorType, $expectedOutput, $errorCode)
    {
        $body = $this->getValidBody();
        $request = (new CreatePaymentRequest())
            ->setModel($body);

        $client = $this->createMock(Client::class);
        $response = new CreatePaymentResponse($errorCode, [], $expectedOutput);
        $client->expects($this->once())
            ->method('sendRequest')
            ->willReturn($response);
        $response = $client->sendRequest($request);

        $model = $response->getModel();

        $this->assertInstanceOf(Error::class, $model);
        $this->assertEquals($expectedErrorType, $model->getType());
    }

    /**
     * @dataProvider getCallCreatePaymentPaymentErrorDataProvider
     * @param $bankId
     * @param $error
     * @return void
     */
    public function testCallCreatePaymentPaymentError($bankId, $error, $expectedOutput, $errorCode)
    {
        $body = $this->getValidBody();
        $body->setBankId($bankId);

        $request = (new CreatePaymentRequest())
            ->setModel($body);

        $client = $this->createMock(Client::class);
        $response = new CreatePaymentResponse($errorCode, [], $expectedOutput);
        $client->expects($this->once())
            ->method('sendRequest')
            ->willReturn($response);
        $response = $client->sendRequest($request);

        $model = $response->getModel();

        $this->assertInstanceOf(PaymentErrors::class, $model);
        $this->assertNotEmpty($model->getErrors());
        $this->assertEquals($error, $model->getErrors()[0]->getCode());
    }

    public function getCallCreatePaymentErrorDataProvider()
    {
        return [
            ['invalid', 'valid', 'valid', 'invalid_client_credentials', '{"type":"invalid_client_credentials","message":"client_id and client_secret are invalid","documentation_url":"https://docs.bridgeapi.io/"}', 401],
            ['valid', 'invalid', 'valid', 'invalid_client_credentials', '{"type":"invalid_client_credentials","message":"client_id and client_secret are invalid","documentation_url":"https://docs.bridgeapi.io/"}', 401],
            ['invalid', 'invalid', 'valid', 'invalid_client_credentials', '{"type":"invalid_client_credentials","message":"client_id and client_secret are invalid","documentation_url":"https://docs.bridgeapi.io/"}', 401],
            ['valid', 'valid', 'invalid', 'invalid_version_header', '{"type":"invalid_version_header","message":"API version Bridge-Version is invalid","documentation_url":"https://docs.bridgeapi.io/"}', 400],
        ];
    }

    public function getCallCreatePaymentPaymentErrorDataProvider()
    {
        return [
            [14, 'bank.unsupported_operation', '{"errors":[{"code":"bank.unsupported_operation","message":"The selected bank does not support payment from a sandbox application, please try with another bank or from your production application"}]}', 400],
            [22213, 'payment.bank_not_found', '{"errors":[{"code":"payment.bank_not_found","message":"This bank does not exist or accept payments"}]}', 400],
        ];
    }

    protected function getValidBody()
    {
        return (new CreatePayment())
            ->setBankId(6)
            ->setSuccessfulCallbackUrl('http://prestashop171.denys.tot/?success')
            ->setUnsuccessfulCallbackUrl('http://prestashop171.denys.tot/?error')
            ->setTransactions([
                (new CreatePaymentTransaction())
                    ->setCurrency('EUR')
                    ->setLabel('Label Unit test')
                    ->setAmount(10.50)
                    ->setClientReference('unit_test')
                    ->setEndToEndId('unit_test')
            ])
            ->setUser(
                (new PaymentUser())
                    ->setFirstName('Unit')
                    ->setLastName('Test')
                    ->setExternalReference('unit_test')
                    ->setIpAddress('192.168.1.1')
            );
    }
}
