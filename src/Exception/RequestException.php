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

namespace BridgeSDK\Exception;

use BridgeSDK\Request\AbstractRequest;
use Exception;
use RuntimeException;

/**
 * Request Exception
 *
 * Failed http request exception class
 */
class RequestException extends RuntimeException
{
    /**
     * Request object
     *
     * @var AbstractRequest
     */
    private $request;

    /**
     * Create request exception object
     *
     * @param string  $message  Exception message
     * @param AbstractRequest  $request  Request object
     * @param \Exception|null  $last_exception  Previous exception object
     */
    public function __construct($message, AbstractRequest $request, ?Exception $last_exception)
    {
        $this->request = $request;

        parent::__construct($message, 0, $last_exception);
    }

    /**
     * Get the request object
     *
     * @return AbstractRequest
     */
    public function getRequest()
    {
        return $this->request;
    }
}
