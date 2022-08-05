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

namespace BridgeSDK\Model;

use InvalidArgumentException;
use JsonSerializable;

class Error extends AbstractModel implements JsonSerializable
{
    /**
     * @var null|string
     */
    private $type;

    /**
     * @var null|string
     */
    private $message;

    /**
     * @var null|string
     */
    private $documentationUrl;

    /**
     * @return null|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param null|string $type
     *
     * @return Error
     */
    public function setType($type)
    {
        if (true === \is_string($type) || (null === $type) === true) {
            $this->type = $type;

            return $this;
        }

        throw new InvalidArgumentException(
            'Type must be a string or null but '.\gettype($type).' is given.'
        );
    }

    /**
     * @return null|string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param null|string $message
     *
     * @return Error
     */
    public function setMessage($message)
    {
        if (true === \is_string($message) || (null === $message) === true) {
            $this->message = $message;

            return $this;
        }

        throw new InvalidArgumentException(
            'Message must be a string or null but '.\gettype($message).' is given.'
        );
    }

    /**
     * @return null|string
     */
    public function getDocumentationUrl()
    {
        return $this->documentationUrl;
    }

    /**
     * @param null|string $documentationUrl
     *
     * @return Error
     */
    public function setDocumentationUrl($documentationUrl)
    {
        if (true === \is_string($documentationUrl) || (null === $documentationUrl) === true) {
            $this->documentationUrl = $documentationUrl;

            return $this;
        }

        throw new InvalidArgumentException(
            'Documentation url must be a string or null but '.\gettype($documentationUrl).' is given.'
        );
    }
}
