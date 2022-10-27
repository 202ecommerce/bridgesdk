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

namespace BridgeSDK\Model;

use JsonSerializable;

abstract class AbstractModel implements JsonSerializable
{
    /**
     * {@inheritdoc}
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        $getterName = get_class_methods(static::class);
        $gettableAttributes = [];
        foreach ($getterName as $value) {
            if ('get' === substr($value, 0, 3) && 'getAfterParam' !== $value) {
                $key = lcfirst(substr($value, 3, \strlen($value)));
                $gettableAttributes[$this->transformToPascalCase($key)] = $this->{$value}();
            }
        }

        return $gettableAttributes;
    }

    /**
     * hydrate from array.
     *
     * @param array<mixed> $content
     *
     * @return null|static
     */
    public function hydrate(array $content)
    {
        $setterName = get_class_methods(static::class);
        foreach ($setterName as $value) {
            if ('set' === substr($value, 0, 3)) {
                $key = lcfirst(substr($value, 3, \strlen($value)));
                $apiKey = $this->transformToPascalCase($key);
                if (isset($content[$apiKey])) {
                    $this->{$value}($content[$apiKey]);
                }
            }
        }

        return $this;
    }

    /**
     * @param string $key
     *
     * @return string
     */
    protected function transformToPascalCase($key)
    {
        $modifiedKey = (string) preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $key);

        return ltrim(strtolower($modifiedKey), '_');
    }
}
