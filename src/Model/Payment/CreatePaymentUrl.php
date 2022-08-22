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

namespace BridgeSDK\Model\Payment;

use BridgeSDK\Model\AbstractModel;
use InvalidArgumentException;

class CreatePaymentUrl extends AbstractModel
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $consentUrl;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return CreatePaymentUrl
     */
    public function setId($id)
    {
        if (true === \is_string($id)) {
            $this->id = $id;

            return $this;
        }

        throw new InvalidArgumentException(
            'Id must be a string '.\gettype($id).' is given.'
        );
    }

    /**
     * @return string
     */
    public function getConsentUrl()
    {
        return $this->consentUrl;
    }

    /**
     * @param string $consentUrl
     *
     * @return CreatePaymentUrl
     */
    public function setConsentUrl($consentUrl)
    {
        if (true === \is_string($consentUrl)) {
            $this->consentUrl = $consentUrl;

            return $this;
        }

        throw new InvalidArgumentException(
            'Consent url must be a string '.\gettype($consentUrl).' is given.'
        );
    }
}
