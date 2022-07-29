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

use JsonSerializable;

abstract class AbstractModel implements JsonSerializable
{
    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $getterName = get_class_methods(get_class($this));
        $gettableAttributes = [];
        foreach ($getterName as $value) {
            if (substr($value, 0, 3) === 'get') {
                $key = lcfirst(substr($value, 3, strlen($value)));
                $gettableAttributes[$this->transformToPascalCase($key)] = $this->$value();
            }
        }

        return $gettableAttributes;
    }

    /**
     * hydrate from array
     *
     * @param array<mixed> $content
     *
     * @return self
     */
    public function hydrate(array $content)
    {
        $setterName = get_class_methods(get_class($this));
        foreach ($setterName as $value) {
            if (substr($value, 0, 3) === 'set') {
                $key = lcfirst(substr($value, 3, strlen($value)));
                $apiKey = $this->transformToPascalCase($key);
                if (isset($content[$apiKey])) {
                    $this->$value($content[$apiKey]);
                }
            }
        }

        return $this;
    }

    protected function transformToPascalCase($key)
    {
        return ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $key)), '_');
    }
}
