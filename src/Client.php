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

namespace BridgeSDK;

use BridgeSDK\Exception\RequestException;
use BridgeSDK\Request\AbstractRequest;
use BridgeSDK\Response\AbstractResponse;
use BridgeSDK\Response\DefaultResponse;
use BridgeSDK\Response\ResponseBuilder;
use BridgeSDK\Response\WebhookResponse;
use InvalidArgumentException;
use Logger\NullLogger;
use Psr\Http\Message\RequestInterface;
use Psr\Log\LoggerInterface;
use RuntimeException;
use UnexpectedValueException;

/**
 * API client.
 */
class Client
{
    /**
     * cURL handler.
     *
     * @var \CurlHandle|resource
     */
    protected $ch;

    /**
     * cURL options array.
     *
     * @var array<mixed>
     */
    protected $options;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Maximum request body size.
     *
     * @var int
     */
    protected static $MAX_BODY_SIZE;

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var string
     */
    private $version = '2021-06-01';

    /**
     * @var Stream
     */
    private $stream;

    /**
     * Create new cURL http client object.
     */
    public function __construct()
    {
        self::$MAX_BODY_SIZE = 1024 * 1024;
        $this->setLogger(new NullLogger());
    }

    /**
     * Send a PSR-7 Request.
     *
     * @return AbstractResponse
     *
     * @throws RequestException         Invalid request
     * @throws InvalidArgumentException Invalid header names and/or values
     * @throws RuntimeException         Failure to create stream
     */
    public function sendRequest(AbstractRequest $request)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Bridge-Version' => $this->version,
            'Client-Id' => $this->clientId,
            'Client-Secret' => $this->clientSecret,
        ];

        $request->setHeaders($headers);

        $this->logger->info((string) $request->getBody(), [
            'path' => $request->getUri()->getPath(),
            'query' => $request->getUri()->getQuery(),
            'type' => \get_class($request),
        ]);

        $response = $this->createResponse($request);

        $options = $this->createOptions($request, $response);
        $this->ch = curl_init();

        // Setup the cURL request
        curl_setopt_array($this->ch, $options);

        // Execute the request
        $result = curl_exec($this->ch);
        $infos = curl_getinfo($this->ch);
        // Check for any request errors
        switch (curl_errno($this->ch)) {
            case CURLE_OK:
                break;

            case CURLE_COULDNT_RESOLVE_PROXY:
            case CURLE_COULDNT_RESOLVE_HOST:
            case CURLE_COULDNT_CONNECT:
            case CURLE_OPERATION_TIMEOUTED:
            case CURLE_SSL_CONNECT_ERROR:
                throw new RequestException('curl error '.curl_error($this->ch), $request);

            default:
                throw new RequestException('curl error: network error', $request);
        }
        curl_close($this->ch);

        $errors = [];
        $result = $response->getResponse();
        $body = $result->getBody(false);
        if (isset($body->errors)) {
            $errors = $body->errors;
        }
        $this->setErrorsOnResponse($result, $errors);

        $this->logger->info((string) json_encode($result->getBody()), [
            'path' => $request->getUri()->getPath(),
            'query' => $request->getUri()->getQuery(),
            'type' => \get_class($result),
            'response' => json_encode($response),
        ]);

        // Get the response
        return $result;
    }

    /**
     * Retrieve a callback request from API.
     *
     * @return AbstractResponse
     *
     * @throws RuntimeException Failure to create stream
     */
    public function retrieveWebhookResponse()
    {
        try {
            $this->stream = new Stream();
            $content = fopen('php://input', 'r+');
            if (false === $content) {
                $body = $this->stream->create();
            } else {
                $body = $this->stream->create($content);
            }
        } catch (InvalidArgumentException $e) {
            throw new RuntimeException('Unable to create stream "php://input"');
        }

        $message = DefaultResponse::getInstance(WebhookResponse::class)->withBody($body);

        return (new ResponseBuilder($message))->getResponse();
    }

    /**
     * Set credentials.
     *
     * @param string $clientId     api client key
     * @param string $clientSecret api client secret
     *
     * @return self
     */
    public function setCredentials($clientId, $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;

        return $this;
    }

    /**
     * @param string $version
     *
     * @return Client
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @param LoggerInterface $logger
     *
     * @return Client
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * Create a new http response.
     *
     * @param AbstractRequest $request
     *
     * @return ResponseBuilder
     *
     * @throws RuntimeException Failure to create stream
     */
    protected function createResponse($request)
    {
        try {
            $this->stream = new Stream();
            $content = fopen('php://temp', 'w+');
            if (false === $content) {
                $body = $this->stream->create();
            } else {
                $body = $this->stream->create($content);
            }
        } catch (InvalidArgumentException $e) {
            throw new RuntimeException('Unable to create stream "php://temp"');
        }
        $responseObject = $request->getResponseObject();
        $message = DefaultResponse::getInstance($responseObject)
            ->withBody($body)
        ;

        return new ResponseBuilder(
            $message
        );
    }

    /**
     * Create array of headers to pass to CURLOPT_HTTPHEADER.
     *
     * @param RequestInterface $request Request object
     * @param array<mixed>     $options cURL options
     *
     * @return array<mixed> Array of http header lines
     */
    protected function createHeaders(RequestInterface $request, array $options)
    {
        $headers = [];
        $request_headers = $request->getHeaders();

        foreach ($request_headers as $name => $values) {
            $header = strtoupper($name);

            // cURL does not support 'Expect-Continue', skip all 'EXPECT' headers
            if ('EXPECT' === $header) {
                continue;
            }

            if ('CONTENT-LENGTH' === $header) {
                if (\array_key_exists(CURLOPT_POSTFIELDS, $options)) {
                    $values = [\strlen($options[CURLOPT_POSTFIELDS])];
                } // Force content length to '0' if body is empty
                elseif (!\array_key_exists(CURLOPT_READFUNCTION, $options)) {
                    $values = [0];
                }
            }

            foreach ($values as $value) {
                $headers[] = $name.': '.$value;
            }
        }

        // Although cURL does not support 'Expect-Continue', it adds the 'Expect'
        // header by default, so we need to force 'Expect' to empty.
        $headers[] = 'Expect:';

        return $headers;
    }

    /**
     * Create cURL request options.
     *
     * @return array<mixed> cURL options
     *
     * @throws RequestException         Invalid request
     * @throws InvalidArgumentException Invalid header names and/or values
     * @throws RuntimeException         Unable to read request body
     */
    protected function createOptions(RequestInterface $request, ResponseBuilder $response)
    {
        $options = $this->options;

        // These options default to false and cannot be changed on set up.
        // The options should be provided with the request instead.
        $options[CURLOPT_FOLLOWLOCATION] = false;
        $options[CURLOPT_HEADER] = false;
        $options[CURLOPT_RETURNTRANSFER] = false;
        $options[CURLOPT_SSLVERSION] = CURL_SSLVERSION_TLSv1_2;

        try {
            $options[CURLOPT_HTTP_VERSION] = $this->getProtocolVersion($request->getProtocolVersion());
        } catch (UnexpectedValueException $e) {
            throw new RequestException($e->getMessage(), $request);
        }
        $options[CURLOPT_URL] = (string) $request->getUri();

        $options = $this->addRequestBodyOptions($request, $options);

        $options[CURLOPT_HTTPHEADER] = $this->createHeaders($request, $options);

        if ($request->getUri()->getUserInfo()) {
            $options[CURLOPT_USERPWD] = $request->getUri()->getUserInfo();
        }

        $options[CURLOPT_HEADERFUNCTION] = function ($ch, $data) use ($response) {
            $clean_data = trim($data);

            if ('' !== $clean_data) {
                if (0 === strpos(strtoupper($clean_data), 'HTTP/')) {
                    $response->setStatus($clean_data)->getResponse();
                } else {
                    $response->addHeader($clean_data);
                }
            }

            return \strlen($data);
        };

        $options[CURLOPT_WRITEFUNCTION] = function ($ch, $data) use ($response) {
            /** @var \Psr\Http\Message\StreamInterface $bodyStreamInterface */
            $bodyStreamInterface = $response->getResponse()->getBody();
            $response->getResponse()->setBody($data);

            return $bodyStreamInterface->write($data);
        };

        return $options;
    }

    /**
     * Add cURL options related to the request body.
     *
     * @param RequestInterface $request Request object
     * @param array<mixed>     $options cURL options
     *
     * @return mixed
     */
    protected function addRequestBodyOptions(RequestInterface $request, array $options)
    {
        /*
         * HTTP methods that cannot have payload:
         * - GET   => cURL will automatically change method to PUT or POST if we
         *            set CURLOPT_UPLOAD or CURLOPT_POSTFIELDS.
         * - HEAD  => cURL treats HEAD as GET request with a same restrictions.
         * - TRACE => According to RFC7231: a client MUST NOT send a message body
         *            in a TRACE request.
         */
        $http_methods = [
            'GET',
            'HEAD',
            'TRACE',
        ];
        if (!\in_array($request->getMethod(), $http_methods, true)) {
            $body = $request->getBody();
            $body_size = $body->getSize();
            if (0 !== $body_size) {
                if ($body->isSeekable()) {
                    $body->rewind();
                }
                if (null === $body_size || $body_size > self::$MAX_BODY_SIZE) {
                    $options[CURLOPT_UPLOAD] = true;

                    if (null !== $body_size) {
                        $options[CURLOPT_INFILESIZE] = $body_size;
                    }

                    $options[CURLOPT_READFUNCTION] = function ($ch, $fd, $len) use ($body) {
                        return $body->read($len);
                    };
                } else {
                    $options[CURLOPT_POSTFIELDS] = (string) $body;
                }
            }
        }

        if ('HEAD' === $request->getMethod()) {
            $options[CURLOPT_NOBODY] = true;
        } elseif ('GET' !== $request->getMethod()) {
            $options[CURLOPT_CUSTOMREQUEST] = $request->getMethod();
        }

        return $options;
    }

    /**
     * Get cURL constant for request http protocol version.
     *
     * @param string $requestProtocolVersion Request http protocol version
     *
     * @return int cURL constant for request http protocol version
     *
     * @throws UnexpectedValueException Unsupported cURL http protocol version
     */
    protected function getProtocolVersion($requestProtocolVersion)
    {
        switch ($requestProtocolVersion) {
            case '1.0':
                return CURL_HTTP_VERSION_1_0;

            case '1.1':
                return CURL_HTTP_VERSION_1_1;

            case '2.0':
                if (\defined('CURL_HTTP_VERSION_2_0')) {
                    return CURL_HTTP_VERSION_2_0;
                }

                throw new UnexpectedValueException('libcurl 7.33 required for HTTP 2.0');
        }

        return CURL_HTTP_VERSION_NONE;
    }

    /**
     * @param AbstractResponse $response
     * @param mixed            $errors
     *
     * @return void
     */
    private function setErrorsOnResponse($response, $errors)
    {
        $errorsToSet = [];
        foreach ($errors as $oneError) {
            if (isset($oneError->message)) {
                $errorsToSet[] = $oneError->message;
            }
        }
        $response->setError($errorsToSet);
    }
}
