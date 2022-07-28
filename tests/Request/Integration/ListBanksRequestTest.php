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

namespace Tests\Request\Integration;

use BridgeSDK\Client;
use BridgeSDK\Model\Error;
use BridgeSDK\Model\ListBanks;
use BridgeSDK\Request\ListBanksRequest;
use PHPUnit\Framework\TestCase;

class ListBanksRequestTest extends TestCase
{
    protected $clientId;

    protected $clientSecret;

    protected $version;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->clientId = getenv('BRIDGE_CLIENT_ID');
        $this->clientSecret = getenv('BRIDGE_CLIENT_SECRET');
        $this->version = '2021-06-01';
    }

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
