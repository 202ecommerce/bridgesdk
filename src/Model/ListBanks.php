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

class ListBanks extends AbstractModel
{
    protected $banks = [];

    private $after = '';

    public function hydrate(array $content)
    {
        if (empty($content['pagination']) === false && empty($content['pagination']['next_uri']) === false) {
            $this->after = $this->getAfterParam($content['pagination']['next_uri']);
        }

        if (!empty($content['resources']) && is_array($content['resources'])) {
            foreach ($content['resources'] as $resource) {
                $bank = (new Bank())->hydrate($resource);
                if (empty($bank)) {
                    continue;
                }
                $this->banks[] = $bank;
            }
        }

        return $this;
    }

    protected function getAfterParam($url)
    {
        $paramsString = explode('?', $url);
        $allParams = explode('&', $paramsString[1]);
        foreach ($allParams as $aParam) {
            if (strpos($aParam, 'after=') !== false) {
                return str_replace('after=', '', $aParam);
            }
        }

        return '';
    }

    /**
     * @return array
     */
    public function getBanks()
    {
        return $this->banks;
    }

    /**
     * @param array $banks
     * @return ListBanks
     */
    public function setBanks($banks)
    {
        $this->banks = $banks;
        return $this;
    }

    /**
     * @return string
     */
    public function getAfter()
    {
        return $this->after;
    }
}
