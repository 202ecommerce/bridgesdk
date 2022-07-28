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
     * @var ?string
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
        $this->id = $id;
        return $this;
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
        $this->name = $name;
        return $this;
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
        $this->countryCode = $countryCode;
        return $this;
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
        $this->logoUrl = $logoUrl;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHighlighted()
    {
        return $this->isHighlighted;
    }

    /**
     * @param bool $isHighlighted
     * @return Bank
     */
    public function setIsHighlighted($isHighlighted)
    {
        $this->isHighlighted = $isHighlighted;
        return $this;
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
        $this->primaryColor = $primaryColor;
        return $this;
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
        $this->secondaryColor = $secondaryColor;
        return $this;
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
        $this->parentName = $parentName;
        return $this;
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
        $this->capabilities = $capabilities;
        return $this;
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
        $this->form = $form;
        return $this;
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
        $this->channelType = $channelType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDisplayOrder()
    {
        return $this->displayOrder;
    }

    /**
     * @param string|null $displayOrder
     * @return Bank
     */
    public function setDisplayOrder($displayOrder)
    {
        $this->displayOrder = $displayOrder;
        return $this;
    }
}
