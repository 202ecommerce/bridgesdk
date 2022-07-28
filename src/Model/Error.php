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

namespace BridgeSDK\Model;

use InvalidArgumentException;
use JsonSerializable;

class Error extends AbstractModel implements JsonSerializable
{
    /**
     * @var string|null
     */
    private $type;

    /**
     * @var string|null
     */
    private $message;

    /**
     * @var string|null
     */
    private $documentationUrl;

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return Error
     */
    public function setType($type)
    {
        if (is_string($type) === true || is_null($type) === true) {
            $this->type = $type;
            return $this;
        }

        throw new InvalidArgumentException(
            'Type must be a string or null but ' . gettype($type) . ' is given.'
        );
    }

    /**
     * @return string|null
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     * @return Error
     */
    public function setMessage($message)
    {
        if (is_string($message) === true || is_null($message) === true) {
            $this->message = $message;
            return $this;
        }

        throw new InvalidArgumentException(
            'Message must be a string or null but ' . gettype($message) . ' is given.'
        );
    }

    /**
     * @return string|null
     */
    public function getDocumentationUrl()
    {
        return $this->documentationUrl;
    }

    /**
     * @param string|null $documentationUrl
     * @return Error
     */
    public function setDocumentationUrl($documentationUrl)
    {
        if (is_string($documentationUrl) === true || is_null($documentationUrl) === true) {
            $this->documentationUrl = $documentationUrl;
            return $this;
        }

        throw new InvalidArgumentException(
            'Documentation url must be a string or null but ' . gettype($documentationUrl) . ' is given.'
        );
    }
}
