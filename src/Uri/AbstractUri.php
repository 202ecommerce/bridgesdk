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

namespace BridgeSDK\Uri;

use Psr\Http\Message\UriInterface;

/**
 * Uri.
 */
abstract class AbstractUri implements UriInterface
{
    /** @var string Uri scheme. */
    protected $scheme = 'https';

    /** @var string Uri user info. */
    protected $userInfo = '';

    /** @var string Uri host. */
    protected $host = '';

    /** @var null|int Uri port. */
    protected $port;

    /** @var string Uri path. */
    protected $path = '';

    /** @var string Uri query string. */
    protected $query = '';

    /** @var string Uri fragment. */
    protected $fragment = '';

    /**
     * @var string
     */
    protected $version = '';

    /** @var array<string,int> SCHEMES. */
    private static $SCHEMES = ['http' => 80, 'https' => 443];

    /** @var string CHAR_UNRESERVED. */
    private static $CHAR_UNRESERVED = 'a-zA-Z0-9_\-\.~';

    /** @var string CHAR_SUB_DELIMS. */
    private static $CHAR_SUB_DELIMS = '!\$&\'\(\)\*\+,;=';

    /**
     * Constructor.
     *
     * @param string $uri uri
     */
    public function __construct($uri = '')
    {
        if ('' !== $uri) {
            if (false === $parts = parse_url($uri)) {
                throw new \InvalidArgumentException(sprintf('Unable to parse URI: "%s"', $uri));
            }

            // Apply parse_url parts to a URI.
            $this->scheme = isset($parts['scheme']) ? strtr($parts['scheme'], 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz') : '';
            $this->userInfo = empty($parts['user']) ? '' : $parts['user'];
            $this->host = isset($parts['host']) ? strtr($parts['host'], 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz') : '';
            $this->port = isset($parts['port']) ? $this->filterPort($parts['port']) : null;
            $this->path = isset($parts['path']) ? $this->filterPath($parts['path']) : '';
            $this->query = isset($parts['query']) ? $this->filterQueryAndFragment($parts['query']) : '';
            $this->fragment = isset($parts['fragment']) ? $this->filterQueryAndFragment($parts['fragment']) : '';
            if (isset($parts['pass'])) {
                $this->userInfo .= ':'.$parts['pass'];
            }
        }
    }

    /**
     * __toString.
     *
     * @return string
     */
    public function __toString()
    {
        return self::createUriString($this->scheme, $this->getAuthority(), $this->path, $this->query, $this->fragment);
    }

    /**
     * Get Scheme.
     *
     * @return string
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * @inherit
     */
    public function getAuthority()
    {
        if ('' === $this->host) {
            return '';
        }

        $authority = $this->host;
        if ('' !== $this->userInfo) {
            $authority = $this->userInfo.'@'.$authority;
        }

        if (null !== $this->port) {
            $authority .= ':'.$this->port;
        }

        return $authority;
    }

    /**
     * @inherit
     */
    public function getUserInfo()
    {
        return $this->userInfo;
    }

    /**
     * @inherit
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @inherit
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @inherit
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @inherit
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @inherit
     */
    public function getFragment()
    {
        return $this->fragment;
    }

    /**
     * @inherit
     *
     * @param mixed $scheme
     */
    public function withScheme($scheme)
    {
        if (!\is_string($scheme)) {
            throw new \InvalidArgumentException('Scheme must be a string');
        }

        if ($this->scheme === $scheme = strtr($scheme, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz')) {
            return $this;
        }

        $new = clone $this;
        $new->scheme = $scheme;
        $new->port = $new->filterPort($new->port);

        return $new;
    }

    /**
     * @inherit
     *
     * @param mixed      $user
     * @param null|mixed $password
     */
    public function withUserInfo($user, $password = null)
    {
        $info = $user;
        if (null !== $password && '' !== $password) {
            $info .= ':'.$password;
        }

        if ($this->userInfo === $info) {
            return $this;
        }

        $new = clone $this;
        $new->userInfo = $info;

        return $new;
    }

    /**
     * @inherit
     *
     * @param mixed $host
     */
    public function withHost($host)
    {
        if (!\is_string($host)) {
            throw new \InvalidArgumentException('Host must be a string');
        }

        if ($this->host === $host = strtr($host, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ', 'abcdefghijklmnopqrstuvwxyz')) {
            return $this;
        }

        $new = clone $this;
        $new->host = $host;

        return $new;
    }

    /**
     * @inherit
     *
     * @param mixed $port
     */
    public function withPort($port)
    {
        if ($this->port === $port = $this->filterPort($port)) {
            return $this;
        }

        $new = clone $this;
        $new->port = $port;

        return $new;
    }

    /**
     * @inherit
     *
     * @param mixed $path
     */
    public function withPath($path)
    {
        if ($this->path === $path = $this->filterPath($path)) {
            return $this;
        }

        $new = clone $this;
        $new->path = $path;

        return $new;
    }

    /**
     * @inherit
     *
     * @param mixed $query
     */
    public function withQuery($query)
    {
        if ($this->query === $query = $this->filterQueryAndFragment($query)) {
            return $this;
        }

        $new = clone $this;
        $new->query = $query;

        return $new;
    }

    /**
     * @inherit
     *
     * @param mixed $fragment
     */
    public function withFragment($fragment)
    {
        if ($this->fragment === $fragment = $this->filterQueryAndFragment($fragment)) {
            return $this;
        }

        $new = clone $this;
        $new->fragment = $fragment;

        return $new;
    }

    /**
     * create Uri String.
     *
     * @param string $scheme
     * @param string $authority
     * @param string $path
     * @param string $query
     * @param string $fragment
     *
     * @return string
     */
    protected static function createUriString($scheme, $authority, $path, $query, $fragment)
    {
        $uri = '';
        if ('' !== $scheme) {
            $uri .= $scheme.':';
        }

        if ('' !== $authority) {
            $uri .= '//'.$authority;
        }

        if ('' !== $path) {
            if (!empty($path[0]) && '/' !== $path[0]) {
                if ('' !== $authority) {
                    // If the path is rootless and an authority is present, the path MUST be prefixed by "/"
                    $path = '/'.$path;
                }
            } elseif (isset($path[1]) && '/' === $path[1]) {
                if ('' === $authority) {
                    // If the path is starting with more than one "/" and no authority is present, the
                    // starting slashes MUST be reduced to one.
                    $path = '/'.ltrim($path, '/');
                }
            }

            $uri .= $path;
        }

        if ('' !== $query) {
            $uri .= '?'.$query;
        }

        if ('' !== $fragment) {
            $uri .= '#'.$fragment;
        }

        return $uri;
    }

    /**
     * Validate port.
     *
     * @param string   $scheme
     * @param null|int $port
     *
     * @return bool
     */
    protected static function isNonStandardPort($scheme, $port)
    {
        return !isset(self::$SCHEMES[$scheme]) || $port !== self::$SCHEMES[$scheme];
    }

    /**
     * Validate port.
     *
     * @param null|int $port
     *
     * @return null|int
     *
     * @throws \InvalidArgumentException
     */
    protected function filterPort($port)
    {
        if (null === $port) {
            return null;
        }

        $port = (int) $port;
        if (0 > $port || 0xFFFF < $port) {
            throw new \InvalidArgumentException(sprintf('Invalid port: %d. Must be between 0 and 65535', $port));
        }

        return self::isNonStandardPort($this->scheme, $port) ? $port : null;
    }

    /**
     * Validate QueryAndFragment.
     *
     * @param string $path
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function filterPath($path)
    {
        if (!\is_string($path)) {
            throw new \InvalidArgumentException('Path must be a string');
        }

        return (string) preg_replace_callback('/(?:[^'.self::$CHAR_UNRESERVED.self::$CHAR_SUB_DELIMS.'%:@\/]++|%(?![A-Fa-f0-9]{2}))/', [__CLASS__, 'rawurlencodeMatchZero'], $path);
    }

    /**
     * Validate QueryAndFragment.
     *
     * @param string $str
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function filterQueryAndFragment($str)
    {
        if (!\is_string($str)) {
            throw new \InvalidArgumentException('Query and fragment must be a string');
        }

        return (string) preg_replace_callback('/(?:[^'.self::$CHAR_UNRESERVED.self::$CHAR_SUB_DELIMS.'%:@\/\?]++|%(?![A-Fa-f0-9]{2}))/', [__CLASS__, 'rawurlencodeMatchZero'], $str);
    }

    /**
     * Raw urlencode Match Zero.
     *
     * @param array<int,string> $match
     *
     * @return string
     */
    protected static function rawurlencodeMatchZero(array $match)
    {
        return rawurlencode($match[0]);
    }
}
