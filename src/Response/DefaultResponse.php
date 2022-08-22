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

namespace BridgeSDK\Response;

use BridgeSDK\Model\Error;

/**
 * Default Response.
 */
class DefaultResponse extends AbstractResponse
{
    /**
     * Get isntance of a response.
     *
     * @param string $classname
     *
     * @return DefaultResponse
     */
    public static function getInstance($classname)
    {
        return new $classname();
    }

    /**
     * @inherit
     */
    public function getModel()
    {
        return new Error();
    }
}
