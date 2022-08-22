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
     * @var null|bool
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
     * @var array<string>
     */
    protected $capabilities = [];

    /**
     * @var array<array>
     */
    protected $form = [];

    /**
     * @var array<string>
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
     * @return null|bool
     */
    public function isHighlighted()
    {
        return $this->isHighlighted;
    }

    /**
     * @param null|bool $isHighlighted
     *
     * @return Bank
     */
    public function setIsHighlighted($isHighlighted)
    {
        if (true === \is_bool($isHighlighted) || null === $isHighlighted) {
            $this->isHighlighted = $isHighlighted;

            return $this;
        }

        throw new InvalidArgumentException(
            'Is highlighted must be a string or null, '.\gettype($isHighlighted).' is given.'
        );
    }

    /**
     * @return null|string
     */
    public function getPrimaryColor()
    {
        return $this->primaryColor;
    }

    /**
     * @param null|string $primaryColor
     *
     * @return Bank
     */
    public function setPrimaryColor($primaryColor)
    {
        if (true === \is_string($primaryColor) || null === $primaryColor) {
            $this->primaryColor = $primaryColor;

            return $this;
        }

        throw new InvalidArgumentException(
            'Primary color must be a string or null, '.\gettype($primaryColor).' is given.'
        );
    }

    /**
     * @return null|string
     */
    public function getSecondaryColor()
    {
        return $this->secondaryColor;
    }

    /**
     * @param null|string $secondaryColor
     *
     * @return Bank
     */
    public function setSecondaryColor($secondaryColor)
    {
        if (true === \is_string($secondaryColor) || null === $secondaryColor) {
            $this->secondaryColor = $secondaryColor;

            return $this;
        }

        throw new InvalidArgumentException(
            'Secondary color must be a string or null, '.\gettype($secondaryColor).' is given.'
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
    public function getCapabilities()
    {
        return $this->capabilities;
    }

    /**
     * @param array<string> $capabilities
     *
     * @return Bank
     */
    public function setCapabilities($capabilities)
    {
        if (true === \is_array($capabilities)) {
            $this->capabilities = $capabilities;

            return $this;
        }

        throw new InvalidArgumentException(
            'Capabilities must be an array, '.\gettype($capabilities).' is given.'
        );
    }

    /**
     * @return array<array>
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param array<array> $form
     *
     * @return Bank
     */
    public function setForm($form)
    {
        if (true === \is_array($form)) {
            $this->form = $form;

            return $this;
        }

        throw new InvalidArgumentException(
            'Form must be an array, '.\gettype($form).' is given.'
        );
    }

    /**
     * @return array<string>
     */
    public function getChannelType()
    {
        return $this->channelType;
    }

    /**
     * @param array<string> $channelType
     *
     * @return Bank
     */
    public function setChannelType($channelType)
    {
        if (true === \is_array($channelType)) {
            $this->channelType = $channelType;

            return $this;
        }

        throw new InvalidArgumentException(
            'Channel type must be an array, '.\gettype($channelType).' is given.'
        );
    }

    /**
     * @return null|int
     */
    public function getDisplayOrder()
    {
        return $this->displayOrder;
    }

    /**
     * @param null|int $displayOrder
     *
     * @return Bank
     */
    public function setDisplayOrder($displayOrder)
    {
        if (true === \is_int($displayOrder) || null === $displayOrder) {
            $this->displayOrder = $displayOrder;

            return $this;
        }

        throw new InvalidArgumentException(
            'Display order must be an int or null, '.\gettype($displayOrder).' is given.'
        );
    }
}
