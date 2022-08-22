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
use BridgeSDK\Model\Bank\Bank;
use BridgeSDK\Model\Error;
use BridgeSDK\Request\BankRequest;
use Tests\Integration\IntegrationTestCase;

class BankRequestIntegrationTest extends IntegrationTestCase
{
    /**
     * @dataProvider getApiCallBankOkDataProvider
     * @param $id
     * @param $expectedName
     * @return void
     */
    public function testApiCallBankOk($id, $expectedName)
    {
        $request = (new BankRequest())
            ->setModel((new Bank())
                ->setId($id)
            );
        $client = new Client();
        $response = $client->setCredentials($this->clientId, $this->clientSecret)
            ->sendRequest($request);

        $model = $response->getModel();

        $this->assertInstanceOf(Bank::class, $model);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($id, $model->getId());
        $this->assertEquals($expectedName, $model->getName());
    }

    /**
     * @dataProvider getApiCallBanksErrorDataProvider
     * @return void
     */
    public function testApiCallBanksError($id, $clientId, $clientSecret, $version, $expectedErrorType)
    {
        $request = (new BankRequest())
            ->setModel((new Bank())
                ->setId($id)
            );
        $client = new Client();
        $response = $client->setCredentials($clientId, $clientSecret)
            ->setVersion($version)
            ->sendRequest($request);

        $model = $response->getModel();

        $this->assertInstanceOf(Error::class, $model);
        $this->assertEquals($expectedErrorType, $model->getType());
    }

    public function getApiCallBanksErrorDataProvider()
    {
        return [
            [1111111, $this->clientId, $this->clientSecret, $this->version, 'not_found'],
            [563, 'test', $this->clientSecret, $this->version, 'invalid_client_credentials'],
            [563, $this->clientId, 'test', $this->version, 'invalid_client_credentials'],
            [563, $this->clientSecret, $this->clientId, $this->version, 'invalid_client_credentials'],
            [563, $this->clientId, $this->clientSecret, 'test', 'invalid_version_header'],
        ];
    }

    public function getApiCallBankOkDataProvider()
    {
        return [
            [563, 'Memo Bank'],
            [543, 'BTP Banque (Lecteur sans fil)'],
        ];
    }
}
