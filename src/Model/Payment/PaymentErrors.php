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
use BridgeSDK\Model\ArrayCollection;
use InvalidArgumentException;

class PaymentErrors extends AbstractModel
{
    /**
     * @var ArrayCollection<PaymentErrors>
     */
    private $errors;

    public function __construct()
    {
        $this->errors = new ArrayCollection();
    }

    /**
     * @return ArrayCollection<PaymentErrors>
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param ArrayCollection<PaymentErrors> $errors
     *
     * @return PaymentErrors
     */
    public function setErrors($errors)
    {
        if ($errors instanceof ArrayCollection) {
            $this->errors = $errors;

            return $this;
        }

        throw new InvalidArgumentException(
            'Errors must be an Array collection '.\gettype($errors).' is given.'
        );
    }

    public function hydrate(array $content)
    {
        if (empty($content['errors'])) {
            return null;
        }

        $collection = new ArrayCollection();
        foreach ($content['errors'] as $error) {
            $collection->append((new PaymentError())->hydrate($error));
        }
        $this->errors = $collection;

        return $this;
    }
}
