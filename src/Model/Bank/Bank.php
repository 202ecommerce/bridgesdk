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

namespace BridgeSDK\Model\Bank;

use BridgeSDK\Model\AbstractModel;
use InvalidArgumentException;

class Bank extends AbstractModel
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $countryCode;

    /**
     * @var string
     */
    protected $logoUrl;

    /**
     * @var ?string
     */
    protected $parentName;

    /**
     * @var array<string>
     */
    protected $environments = [];

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Bank
     */
    public function setId($id)
    {
        if (true === \is_int($id)) {
            $this->id = $id;

            return $this;
        }

        throw new InvalidArgumentException(
            'Id must be an int, '.\gettype($id).' is given.'
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Bank
     */
    public function setName($name)
    {
        if (true === \is_string($name)) {
            $this->name = $name;

            return $this;
        }

        throw new InvalidArgumentException(
            'Name must be a string, '.\gettype($name).' is given.'
        );
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     *
     * @return Bank
     */
    public function setCountryCode($countryCode)
    {
        if (true === \is_string($countryCode)) {
            $this->countryCode = $countryCode;

            return $this;
        }

        throw new InvalidArgumentException(
            'Country code must be a string, '.\gettype($countryCode).' is given.'
        );
    }

    /**
     * @return string
     */
    public function getLogoUrl()
    {
        return $this->logoUrl;
    }

    /**
     * @param string $logoUrl
     *
     * @return Bank
     */
    public function setLogoUrl($logoUrl)
    {
        if (true === \is_string($logoUrl)) {
            $this->logoUrl = $logoUrl;

            return $this;
        }

        throw new InvalidArgumentException(
            'Logo url must be a string, '.\gettype($logoUrl).' is given.'
        );
    }

    /**
     * @return null|string
     */
    public function getParentName()
    {
        return $this->parentName;
    }

    /**
     * @param null|string $parentName
     *
     * @return Bank
     */
    public function setParentName($parentName)
    {
        if (true === \is_string($parentName) || null === $parentName) {
            $this->parentName = $parentName;

            return $this;
        }

        throw new InvalidArgumentException(
            'Parent name must be a string or null, '.\gettype($parentName).' is given.'
        );
    }

    /**
     * @return array<string>
     */
    public function getEnvironments()
    {
        return $this->environments;
    }

    /**
     * @param array<string> $environments
     *
     * @return Bank
     */
    public function setEnvironments($environments)
    {
        if (true === \is_array($environments)) {
            $this->environments = $environments;

            return $this;
        }

        throw new InvalidArgumentException(
            'Environments must be an array, '.\gettype($environments).' is given.'
        );
    }
}
