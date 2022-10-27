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

use InvalidArgumentException;

/**
 * Response Builder.
 *
 * Build a PSR-7 Response object
 */
class ResponseBuilder
{
    /**
     * PSR-7 Response.
     *
     * @var AbstractResponse
     */
    protected $response;

    /**
     * Create a Response Builder.
     */
    public function __construct(AbstractResponse $response)
    {
        $this->response = $response;
    }

    /**
     * Return the response.
     *
     * @return AbstractResponse
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set the response.
     *
     * @param AbstractResponse $response Response object
     *
     * @return void
     */
    public function setResponse(AbstractResponse $response)
    {
        $this->response = $response;
    }

    /**
     * Add response header from header line string.
     *
     * @param string $header_line Response header line string
     *
     * @return static
     *
     * @throws InvalidArgumentException Invalid header line argument
     */
    public function addHeader($header_line)
    {
        $header_parts = explode(':', $header_line, 2);

        if (2 !== \count($header_parts)) {
            throw new InvalidArgumentException("'{$header_line}' is not a valid HTTP header line");
        }

        $header_name = trim($header_parts[0]);
        $header_value = trim($header_parts[1]);

        if ($this->response->hasHeader($header_name)) {
            $this->response = $this->response->withAddedHeader($header_name, $header_value);
        } else {
            $this->response = $this->response->withHeader($header_name, $header_value);
        }

        return $this;
    }

    /**
     * Set response headers from header line array.
     *
     * @param array<string> $headers Array of header lines
     *
     * @return self $this
     *
     * @throws InvalidArgumentException Invalid status code argument value
     */
    public function setHeadersFromArray(array $headers)
    {
        $status = (string) array_shift($headers);

        $this->setStatus($status);

        foreach ($headers as $header) {
            $header_line = trim($header);

            if ('' === $header_line) {
                continue;
            }

            $this->addHeader($header_line);
        }

        return $this;
    }

    /**
     * Set reponse status.
     *
     * @param string $statusLine Response status line string
     *
     * @return self $this
     *
     * @throws InvalidArgumentException Invalid status line argument
     */
    public function setStatus($statusLine)
    {
        $statusParts = explode(' ', $statusLine, 3);
        $partsCount = \count($statusParts);

        if ($partsCount < 2 || 0 !== strpos(strtoupper($statusParts[0]), 'HTTP/')) {
            throw new InvalidArgumentException("'{$statusLine}' is not a valid HTTP status line");
        }

        $reasonPhrase = ($partsCount > 2 ? $statusParts[2] : '');

        $this->response = $this->response
            ->withStatus((int) $statusParts[1], $reasonPhrase)
            ->withProtocolVersion(substr($statusParts[0], 5))
        ;

        return $this;
    }
}
