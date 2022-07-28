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

use JsonSerializable;
use Psr\Http\Message\RequestInterface;
use BridgeSDK\Model\AbstractModel;
use BridgeSDK\Stream;
use BridgeSDK\Uri\ApiUri;

/**
 * API client
 */
abstract class AbstractRequest implements RequestInterface, JsonSerializable
{
    use MessageTrait;
    use RequestTrait;

    /**
     * @var AbstractModel
     */
    private $body;

    /**
     * @var string
     */
    protected $response;

    /**
     * @var array
     */
    protected $query = [];

    /**
     * @param array<string> $headers Request headers
     * @param string $version protocol version
     */
    public function __construct(array $headers = [], $version = '1.1', $query = [])
    {
        $this->uri = new ApiUri();
        $this->uri = $this->uri->withPath('/v2' . $this->requestTarget);
        $this->setQuery($query);

        if (!empty($this->getQuery())) {
            $this->uri = $this->uri->withQuery(http_build_query($this->getQuery()));
        }

        $this->setHeaders($headers);

        $this->protocol = $version;

        if (!$this->hasHeader('Host')) {
            $this->updateHostFromUri();
        }

        // initialization of the stream until Request::getBody()
        $this->stream = Stream::create('');
    }

    /**
     * Set Body From Model
     * @param AbstractModel $body
     *
     * @return self
     */
    public function setModel(AbstractModel $body)
    {
        $json = json_encode($body->jsonSerialize(), JSON_PRETTY_PRINT);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \InvalidArgumentException(
                'json_encode error: ' . json_last_error_msg()
            );
        }
        $new = clone $this;
        $new->stream = Stream::create((string) $json);

        return $new;
    }

    /**
     * Set Body From Model
     *
     * @return string
     */
    public function getResponseObject()
    {
        return $this->response;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    /**
     * @return array
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param array $query
     * @return AbstractRequest
     */
    protected function setQuery($query)
    {
        $this->query = $this->filterQuery(array_merge($this->query, $query));
        return $this;
    }

    /**
     * @param array $query
     * @return array
     */
    protected function filterQuery($query)
    {
        return $query;
    }
}
