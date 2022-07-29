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
use BridgeSDK\Model\Error;
use BridgeSDK\Model\Bank\ListBanks;
use BridgeSDK\Request\ListBanksRequest;
use Tests\Integration\IntegrationTestCase;

class ListBanksRequestTest extends IntegrationTestCase
{
    public function testApiCallBanksOk()
    {
        $request = new ListBanksRequest();
        $client = new Client();
        $response = $client->setCredentials($this->clientId, $this->clientSecret)
            ->sendRequest($request);

        $model = $response->getModel();

        $this->assertInstanceOf(ListBanks::class, $model);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @dataProvider getApiCallBanksErrorDataProvider
     * @return void
     */
    public function testApiCallBanksError($clientId, $clientSecret, $version, $expectedErrorType)
    {
        $request = new ListBanksRequest();
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
            ['test', $this->clientSecret, $this->version, 'invalid_client_credentials'],
            [$this->clientId, 'test', $this->version, 'invalid_client_credentials'],
            [$this->clientSecret, $this->clientId, $this->version, 'invalid_client_credentials'],
            [$this->clientId, $this->clientSecret, 'test', 'invalid_version_header'],
        ];
    }
}
