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
use BridgeSDK\Model\Bank\ListBanks;
use BridgeSDK\Request\ListBanksRequest;
use BridgeSDK\Response\ListBanksResponse;
use PHPUnit\Framework\TestCase;

class ListBanksRequestTest extends TestCase
{
    public function testCallBanksOk()
    {
        $request = new ListBanksRequest();

        $client = $this->createMock(Client::class);
        $response = new ListBanksResponse(200, [], '{"resources": [{"id": 563,"name": "Memo Bank","country_code": "FR","logo_url": "https://web.bankin.com/img/banks-logo/fr/memo-bank.png","authentication_type": "WEBVIEW","url": "https://sync.bankin.com/v2/banks/563/connect-item","is_highlighted": false,"primary_color": null,"secondary_color": null,"parent_name": null,"capabilities": ["ais"],"channel_type": ["dsp2"],"display_order": null}],"pagination": {    "next_uri": "/v2/banks?after=NDc2&limit=50"    }}');

        $client->expects($this->once())
            ->method('sendRequest')
            ->willReturn($response);

        $response = $client->sendRequest($request);

        $model = $response->getModel();

        $this->assertInstanceOf(ListBanks::class, $model);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertCount(1, $model->getBanks());
    }

    /**
     * @dataProvider getCallBanksErrorDataProvider
     * @return void
     */
    public function testCallBanksError($clientId, $clientSecret, $version, $expectedErrorType, $expectedOutput, $errorCode)
    {
        $request = new ListBanksRequest();

        $client = $this->createMock(Client::class);
        $response = new ListBanksResponse($errorCode, [], $expectedOutput);
        $client->expects($this->once())
            ->method('sendRequest')
            ->willReturn($response);
        $response = $client->sendRequest($request);

        $model = $response->getModel();

        $this->assertInstanceOf(Error::class, $model);
        $this->assertEquals($expectedErrorType, $model->getType());
    }

    public function getCallBanksErrorDataProvider()
    {
        return [
            ['invalid', 'valid', 'valid', 'invalid_client_credentials', '{"type":"invalid_client_credentials","message":"client_id and client_secret are invalid","documentation_url":"https://docs.bridgeapi.io/"}', 401],
            ['valid', 'invalid', 'valid', 'invalid_client_credentials', '{"type":"invalid_client_credentials","message":"client_id and client_secret are invalid","documentation_url":"https://docs.bridgeapi.io/"}', 401],
            ['invalid', 'invalid', 'valid', 'invalid_client_credentials', '{"type":"invalid_client_credentials","message":"client_id and client_secret are invalid","documentation_url":"https://docs.bridgeapi.io/"}', 401],
            ['valid', 'valid', 'invalid', 'invalid_version_header', '{"type":"invalid_version_header","message":"API version Bridge-Version is invalid","documentation_url":"https://docs.bridgeapi.io/"}', 400],
        ];
    }
}
