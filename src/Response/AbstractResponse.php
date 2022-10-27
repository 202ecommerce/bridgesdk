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

use BridgeSDK\Model\AbstractModel;
use BridgeSDK\Model\ArrayCollection;
use BridgeSDK\Request\MessageTrait;
use BridgeSDK\Stream;
use JsonSerializable;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * API client.
 */
abstract class AbstractResponse implements ResponseInterface, JsonSerializable
{
    use MessageTrait;

    /**
     * @var AbstractModel
     */
    protected $body;

    /** @var array<int,string> Map of standard HTTP status code/reason phrases */
    private static $PHRASES = [
        100 => 'Continue', 101 => 'Switching Protocols', 102 => 'Processing',
        200 => 'OK', 201 => 'Created', 202 => 'Accepted', 203 => 'Non-Authoritative Information', 204 => 'No Content', 205 => 'Reset Content', 206 => 'Partial Content', 207 => 'Multi-status', 208 => 'Already Reported',
        300 => 'Multiple Choices', 301 => 'Moved Permanently', 302 => 'Found', 303 => 'See Other', 304 => 'Not Modified', 305 => 'Use Proxy', 306 => 'Switch Proxy', 307 => 'Temporary Redirect',
        400 => 'Bad Request', 401 => 'Unauthorized', 402 => 'Payment Required', 403 => 'Forbidden', 404 => 'Not Found', 405 => 'Method Not Allowed', 406 => 'Not Acceptable', 407 => 'Proxy Authentication Required', 408 => 'Request Time-out', 409 => 'Conflict', 410 => 'Gone', 411 => 'Length Required', 412 => 'Precondition Failed', 413 => 'Request Entity Too Large', 414 => 'Request-URI Too Large', 415 => 'Unsupported Media Type', 416 => 'Requested range not satisfiable', 417 => 'Expectation Failed', 418 => 'I\'m a teapot', 422 => 'Unprocessable Entity', 423 => 'Locked', 424 => 'Failed Dependency', 425 => 'Unordered Collection', 426 => 'Upgrade Required', 428 => 'Precondition Required', 429 => 'Too Many Requests', 431 => 'Request Header Fields Too Large', 451 => 'Unavailable For Legal Reasons',
        500 => 'Internal Server Error', 501 => 'Not Implemented', 502 => 'Bad Gateway', 503 => 'Service Unavailable', 504 => 'Gateway Time-out', 505 => 'HTTP Version not supported', 506 => 'Variant Also Negotiates', 507 => 'Insufficient Storage', 508 => 'Loop Detected', 511 => 'Network Authentication Required',
    ];

    /** @var string */
    private $reasonPhrase = '';

    /** @var string[] */
    private $error = [];

    /** @var int */
    private $statusCode;

    /**
     * @param int                                  $status  Status code
     * @param array<string>                        $headers Response headers
     * @param null|resource|StreamInterface|string $body    Response body
     * @param string                               $version Protocol version
     * @param null|string                          $reason  Reason phrase (when empty a default will be used based on the status code)
     */
    public function __construct($status = 200, array $headers = [], $body = null, $version = '1.1', $reason = null)
    {
        // If we got no body, defer initialization of the stream until Response::getBody()
        if ('' !== $body && null !== $body) {
            $this->stream = Stream::create($body);
        }

        $this->statusCode = $status;
        $this->setHeaders($headers);
        if (null === $reason && isset(self::$PHRASES[$this->statusCode])) {
            $this->reasonPhrase = self::$PHRASES[$status];
        } else {
            $this->reasonPhrase = empty($reason) ? '' : $reason;
        }

        $this->protocol = $version;
    }

    /**
     * Get body.
     *
     * @return null|AbstractModel|ArrayCollection<AbstractModel>
     */
    abstract public function getModel();

    /**
     * Gets the body of the message.
     *
     * @param mixed $returnStream
     *
     * @return null|AbstractModel|StreamInterface returns the body as a stream
     */
    public function getBody($returnStream = true)
    {
        return true === $returnStream ? $this->stream : $this->body;
    }

    /**
     * Set body.
     *
     * @param string $body
     *
     * @return self
     */
    public function setBody($body)
    {
        $jsonBody = json_decode($body);
        $this->body = $jsonBody;

        return $this;
    }

    /**
     * @inherit
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @inherit
     */
    public function getReasonPhrase()
    {
        return $this->reasonPhrase;
    }

    /**
     * @inherit
     *
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @inherit
     *
     * @param mixed $errors
     *
     * @return self
     */
    public function setError($errors)
    {
        $this->error = $errors;

        return $this;
    }

    /**
     * @inherit
     *
     * @param mixed $code
     * @param mixed $reasonPhrase
     */
    public function withStatus($code, $reasonPhrase = '')
    {
        $code = (int) $code;
        if ($code < 100 || $code > 599) {
            throw new \InvalidArgumentException(sprintf('Status code has to be an integer between 100 and 599. A status code of %d was given', $code));
        }

        $new = clone $this;
        $new->statusCode = $code;
        if (true === empty($reasonPhrase) && isset(self::$PHRASES[$new->statusCode])) {
            $reasonPhrase = self::$PHRASES[$new->statusCode];
        }
        $new->reasonPhrase = $reasonPhrase;

        return $new;
    }

    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
