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
use BridgeSDK\Model\Error;
use BridgeSDK\Model\Payment\CreatePayment;
use BridgeSDK\Model\Payment\CreatePaymentTransaction;
use BridgeSDK\Model\Payment\CreatePaymentUrl;
use BridgeSDK\Model\Payment\PaymentErrors;
use BridgeSDK\Model\Payment\PaymentUser;
use BridgeSDK\Request\CreatePaymentRequest;
use Tests\Integration\IntegrationTestCase;

class CreatePaymentRequestIntegrationTest extends IntegrationTestCase
{
    public function testApiCallCreatePaymentOk()
    {
        $body = $this->getValidBody();

        $request = (new CreatePaymentRequest())
            ->setModel($body);
        $client = new Client();
        $response = $client->setCredentials($this->clientId, $this->clientSecret)
            ->sendRequest($request);
        $model = $response->getModel();

        $this->assertInstanceOf(CreatePaymentUrl::class, $model);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @dataProvider getApiCallCreatePaymentErrorDataProvider
     * @return void
     */
    public function testApiCallCreatePaymentError($clientId, $clientSecret, $version, $expectedErrorType)
    {
        $body = $this->getValidBody();
        $request = (new CreatePaymentRequest())
            ->setModel($body);
        $client = new Client();
        $response = $client->setCredentials($clientId, $clientSecret)
            ->setVersion($version)
            ->sendRequest($request);
        $model = $response->getModel();

        $this->assertInstanceOf(Error::class, $model);
        $this->assertEquals($expectedErrorType, $model->getType());
    }

    /**
     * @dataProvider getApiCallCreatePaymentPaymentErrorDataProvider
     * @param $bankId
     * @param $error
     * @return void
     */
    public function testApiCallCreatePaymentPaymentError($bankId, $error)
    {
        $body = $this->getValidBody();
        $body->setBankId($bankId);

        $request = (new CreatePaymentRequest())
            ->setModel($body);
        $client = new Client();
        $response = $client->setCredentials($this->clientId, $this->clientSecret)
            ->sendRequest($request);
        $model = $response->getModel();

        $this->assertInstanceOf(PaymentErrors::class, $model);
        $this->assertNotEmpty($model->getErrors());
        $this->assertEquals($error, $model->getErrors()[0]->getCode());
    }

    public function getApiCallCreatePaymentErrorDataProvider()
    {
        return [
            ['test', $this->clientSecret, $this->version, 'invalid_client_credentials'],
            [$this->clientId, 'test', $this->version, 'invalid_client_credentials'],
            [$this->clientSecret, $this->clientId, $this->version, 'invalid_client_credentials'],
            [$this->clientId, $this->clientSecret, 'test', 'invalid_version_header'],
        ];
    }

    public function getApiCallCreatePaymentPaymentErrorDataProvider()
    {
        return [
            [14, 'bank.unsupported_operation'],
            [22213, 'payment.bank_not_found'],
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
                    ->setIpAddress('192.168.1.1')
            );
    }
}
