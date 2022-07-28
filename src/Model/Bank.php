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
     * @var bool
     */
    protected $isHighlighted;

    /**
     * @var ?string
     */
    protected $primaryColor;

    /**
     * @var ?string
     */
    protected $secondaryColor;

    /**
     * @var ?string
     */
    protected $parentName;

    /**
     * @var array
     */
    protected $capabilities = [];

    /**
     * @var array
     */
    protected $form = [];

    /**
     * @var array
     */
    protected $channelType = [];

    /**
     * @var ?int
     */
    protected $displayOrder;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Bank
     */
    public function setId($id)
    {
        if (is_int($id) === true) {
            $this->id = $id;
            return $this;
        }

        throw new InvalidArgumentException(
            'Id must be an int, ' . gettype($id) . ' is given.'
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
     * @return Bank
     */
    public function setName($name)
    {
        if (is_string($name) === true) {
            $this->name = $name;
            return $this;
        }

        throw new InvalidArgumentException(
            'Name must be a string, ' . gettype($name) . ' is given.'
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
     * @return Bank
     */
    public function setCountryCode($countryCode)
    {
        if (is_string($countryCode) === true) {
            $this->countryCode = $countryCode;
            return $this;
        }

        throw new InvalidArgumentException(
            'Country code must be a string, ' . gettype($countryCode) . ' is given.'
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
     * @return Bank
     */
    public function setLogoUrl($logoUrl)
    {
        if (is_string($logoUrl) === true) {
            $this->logoUrl = $logoUrl;
            return $this;
        }

        throw new InvalidArgumentException(
            'Logo url must be a string, ' . gettype($logoUrl) . ' is given.'
        );
    }

    /**
     * @return bool
     */
    public function isHighlighted()
    {
        return $this->isHighlighted;
    }

    /**
     * @param bool|null $isHighlighted
     * @return Bank
     */
    public function setIsHighlighted($isHighlighted)
    {
        if (is_bool($isHighlighted) === true || is_null($isHighlighted)) {
            $this->isHighlighted = $isHighlighted;
            return $this;
        }

        throw new InvalidArgumentException(
            'Is highlighted must be a string or null, ' . gettype($isHighlighted) . ' is given.'
        );
    }

    /**
     * @return string|null
     */
    public function getPrimaryColor()
    {
        return $this->primaryColor;
    }

    /**
     * @param string|null $primaryColor
     * @return Bank
     */
    public function setPrimaryColor($primaryColor)
    {
        if (is_string($primaryColor) === true || is_null($primaryColor)) {
            $this->primaryColor = $primaryColor;
            return $this;
        }

        throw new InvalidArgumentException(
            'Primary color must be a string or null, ' . gettype($primaryColor) . ' is given.'
        );
    }

    /**
     * @return string|null
     */
    public function getSecondaryColor()
    {
        return $this->secondaryColor;
    }

    /**
     * @param string|null $secondaryColor
     * @return Bank
     */
    public function setSecondaryColor($secondaryColor)
    {
        if (is_string($secondaryColor) === true || is_null($secondaryColor)) {
            $this->secondaryColor = $secondaryColor;
            return $this;
        }

        throw new InvalidArgumentException(
            'Secondary color must be a string or null, ' . gettype($secondaryColor) . ' is given.'
        );
    }

    /**
     * @return string|null
     */
    public function getParentName()
    {
        return $this->parentName;
    }

    /**
     * @param string|null $parentName
     * @return Bank
     */
    public function setParentName($parentName)
    {
        if (is_string($parentName) === true || is_null($parentName)) {
            $this->parentName = $parentName;
            return $this;
        }

        throw new InvalidArgumentException(
            'Parent name must be a string or null, ' . gettype($parentName) . ' is given.'
        );
    }

    /**
     * @return array
     */
    public function getCapabilities()
    {
        return $this->capabilities;
    }

    /**
     * @param array $capabilities
     * @return Bank
     */
    public function setCapabilities($capabilities)
    {
        if (is_array($capabilities) === true) {
            $this->capabilities = $capabilities;
            return $this;
        }

        throw new InvalidArgumentException(
            'Capabilities must be an array, ' . gettype($capabilities) . ' is given.'
        );
    }

    /**
     * @return array
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param array $form
     * @return Bank
     */
    public function setForm($form)
    {
        if (is_array($form) === true) {
            $this->form = $form;
            return $this;
        }

        throw new InvalidArgumentException(
            'Form must be an array, ' . gettype($form) . ' is given.'
        );
    }

    /**
     * @return array
     */
    public function getChannelType()
    {
        return $this->channelType;
    }

    /**
     * @param array $channelType
     * @return Bank
     */
    public function setChannelType($channelType)
    {
        if (is_array($channelType) === true) {
            $this->channelType = $channelType;
            return $this;
        }

        throw new InvalidArgumentException(
            'Channel type must be an array, ' . gettype($channelType) . ' is given.'
        );
    }

    /**
     * @return int|null
     */
    public function getDisplayOrder()
    {
        return $this->displayOrder;
    }

    /**
     * @param int|null $displayOrder
     * @return Bank
     */
    public function setDisplayOrder($displayOrder)
    {
        if (is_int($displayOrder) === true || is_null($displayOrder)) {
            $this->displayOrder = $displayOrder;
            return $this;
        }

        throw new InvalidArgumentException(
            'Display order must be an int or null, ' . gettype($displayOrder) . ' is given.'
        );
    }
}
