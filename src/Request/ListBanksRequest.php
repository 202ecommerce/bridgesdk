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

namespace BridgeSDK\Request;

use BridgeSDK\Constant\BankCapability;
use BridgeSDK\Response\ListBanksResponse;

class ListBanksRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $requestTarget = '/banks';

    /**
     * @var string
     */
    protected $method = 'GET';

    /**
     * @var array
     */
    protected $query = [
        'limit' => 500,
        'capabilities' => BankCapability::SINGLE_PAYMENT,
        'after' => '',
    ];

    /**
     * @var string
     */
    protected $response = ListBanksResponse::class;

    /**
     * @param array $query
     * @return array
     */
    protected function filterQuery($query)
    {
        if ($query['after'] == '') {
            unset($query['after']);
        }

        return $query;
    }
}
