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

use BridgeSDK\Client;
use BridgeSDK\Model\AbstractModel;
use BridgeSDK\Request\AbstractRequest;
use BridgeSDK\Response\ErrorResponse;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractClientApiService
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param null|AbstractModel $body
     *
     * @return ResponseInterface
     */
    protected function call($body, AbstractRequest $request)
    {
        try {
            if (false === empty($body)) {
                $request = $request->setModel($body);
            }
            $response = $this->client->sendRequest($request);
        } catch (\Exception $e) {
            $message = $e->getMessage().$e->getFile().':'.$e->getLine().$e->getTraceAsString();
            $response = (new ErrorResponse(400, [], null, '1.1', $message));
        }

        return $response;
    }
}
