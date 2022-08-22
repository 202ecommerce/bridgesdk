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
use BridgeSDK\Model\Bank\Bank;
use BridgeSDK\Request\BankRequest;
use BridgeSDK\Response\BankResponse;
use BridgeSDK\Model\Error;
use PHPUnit\Framework\TestCase;

class BankRequestTest extends TestCase
{
    /**
     * @dataProvider getCallBankOkDataProvider
     * @param $id
     * @param $expectedResult
     * @param $expectedName
     * @return void
     */
    public function testCallBankOk($id, $expectedResult, $expectedName)
    {
        $request = (new BankRequest())
            ->setModel((new Bank())
                ->setId($id)
            );
        $client = $this->createMock(Client::class);
        $response = new BankResponse(200, [], $expectedResult);

        $client->expects($this->once())
            ->method('sendRequest')
            ->willReturn($response);

        $response = $client->sendRequest($request);

        $model = $response->getModel();

        $this->assertInstanceOf(Bank::class, $model);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($id, $model->getId());
        $this->assertEquals($expectedName, $model->getName());
    }

    /**
     * @dataProvider getCallBanksErrorDataProvider
     * @return void
     */
    public function testCallBanksError($id, $clientId, $clientSecret, $version, $expectedErrorType, $expectedOutput, $errorCode)
    {
        $request = (new BankRequest())
            ->setModel((new Bank())
                ->setId($id)
            );

        $client = $this->createMock(Client::class);
        $response = new BankResponse($errorCode, [], $expectedOutput);
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
            [1111111, 'valid', 'valid', 'valid', 'not_found', '{"type":"not_found","message":"The requested resource doesn\'t exist","documentation_url":"https://docs.bridgeapi.io/"}', 404],
            [563, 'invalid', 'valid', 'valid', 'invalid_client_credentials', '{"type":"invalid_client_credentials","message":"client_id and client_secret are invalid","documentation_url":"https://docs.bridgeapi.io/"}', 401],
            [563, 'valid', 'invalid', 'valid', 'invalid_client_credentials', '{"type":"invalid_client_credentials","message":"client_id and client_secret are invalid","documentation_url":"https://docs.bridgeapi.io/"}', 401],
            [563, 'invalid', 'invalid', 'valid', 'invalid_client_credentials', '{"type":"invalid_client_credentials","message":"client_id and client_secret are invalid","documentation_url":"https://docs.bridgeapi.io/"}', 401],
            [563, 'valid', 'valid', 'invalid', 'invalid_version_header', '{"type":"invalid_version_header","message":"API version Bridge-Version is invalid","documentation_url":"https://docs.bridgeapi.io/"}', 400],
        ];
    }

    public function getCallBankOkDataProvider()
    {
        return [
            [563, '{"id":563,"name":"Memo Bank","country_code":"FR","logo_url":"https://web.bankin.com/img/banks-logo/fr/memo-bank.png","authentication_type":"WEBVIEW","url":"https://sync.bankin.com/v2/banks/563/connect-item","is_highlighted":false,"primary_color":null,"secondary_color":null,"parent_name":null,"capabilities":["ais"],"channel_type":["dsp2"],"display_order":null,"deeplink_ios":null,"deeplink_android":null,"form":[{"label":"Identifiant","type":"USER","isNum":"0","maxLength":null},{"label":"Mot de passe","type":"PWD","isNum":"1","maxLength":null}]}', 'Memo Bank'],
            [543, '{"id":543,"name":"BTP Banque (Lecteur sans fil)","country_code":"FR","logo_url":"https://web.bankin.com/img/banks-logo/fr/btp.png","authentication_type":"INTERNAL_CREDS","is_highlighted":false,"primary_color":null,"secondary_color":null,"parent_name":"BTP Banque","capabilities":["ais","account_check"],"channel_type":["dsp2"],"display_order":null,"deeplink_ios":null,"deeplink_android":null,"form":[{"label":"Identifiant client","type":"USER","isNum":"1","maxLength":null},{"label":"Numéro d\'usager","type":"PWD","isNum":"0","maxLength":null}]}', 'BTP Banque (Lecteur sans fil)'],
        ];
    }
}
