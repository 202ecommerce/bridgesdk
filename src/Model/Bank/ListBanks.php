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

class ListBanks extends AbstractModel
{
    /**
     * @var array<Bank>
     */
    protected $banks = [];

    /**
     * @var string
     */
    private $after = '';

    public function hydrate(array $content)
    {
        if (false === empty($content['pagination']) && false === empty($content['pagination']['next_uri'])) {
            $this->after = $this->getAfterParam($content['pagination']['next_uri']);
        }

        if (!empty($content['resources']) && \is_array($content['resources'])) {
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

    /**
     * @return array<Bank>
     */
    public function getBanks()
    {
        return $this->banks;
    }

    /**
     * @param array<Bank> $banks
     *
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

    /**
     * @param string $url
     *
     * @return array|mixed|string|string[]
     */
    protected function getAfterParam($url)
    {
        if (true === empty($url)) {
            return '';
        }
        $paramsString = explode('?', $url);
        $allParams = explode('&', $paramsString[1]);
        foreach ($allParams as $aParam) {
            if (str_contains($aParam, 'after=')) {
                return str_replace('after=', '', $aParam);
            }
        }

        return '';
    }
}
