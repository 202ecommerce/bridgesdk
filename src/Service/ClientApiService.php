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

namespace BridgeSDK\Service;

use Psr\Http\Message\ResponseInterface;
use BridgeSDK\Model\Basket;
use BridgeSDK\Model\BestPrice;
use BridgeSDK\Model\CancelContract;
use BridgeSDK\Model\ConfirmContract;
use BridgeSDK\Model\InitializeContract;
use BridgeSDK\Model\LoadContract;
use BridgeSDK\Model\MerchantOrderContext;
use BridgeSDK\Model\MerchantUrls;
use BridgeSDK\Model\PersonalInformation;
use BridgeSDK\Model\WithdrawContract;
use BridgeSDK\Request\AvailableMaturitiesRequest;
use BridgeSDK\Request\BestPriceRequest;
use BridgeSDK\Request\CancelContractRequest;
use BridgeSDK\Request\ConfirmContractRequest;
use BridgeSDK\Request\InitializeContractRequest;
use BridgeSDK\Request\LoadContractRequest;
use BridgeSDK\Request\WithdrawContractRequest;

/**
 * Client Api Service Class
 */
class ClientApiService extends AbstractClientApiService
{
    /**
     * @param float $borrowedAmount
     *
     * @return ResponseInterface
     */
    public function getBestPrice($borrowedAmount)
    {
        $model = (new BestPrice())
            ->setBorrowedAmount($borrowedAmount);

        $request = new BestPriceRequest();

        return $this->call($model, $request);
    }

    /**
     * @param int $requestMaturity
     * @param PersonalInformation $personalInformation
     * @param Basket $basket
     * @param MerchantUrls $merchantUrls
     * @param MerchantOrderContext $merchantOrderContext
     *
     * @return ResponseInterface
     */
    public function initializeContract($requestMaturity, PersonalInformation $personalInformation, Basket $basket, MerchantUrls $merchantUrls, MerchantOrderContext $merchantOrderContext)
    {
        $model = (new InitializeContract())
            ->setRequestedMaturity($requestMaturity)
            ->setPersonalInformation($personalInformation)
            ->setBasket($basket)
            ->setMerchantUrls($merchantUrls)
            ->setMerchantOrderContext($merchantOrderContext);

        $request = new InitializeContractRequest();

        return $this->call($model, $request);
    }

    /**
     * @param string $contractReference
     * @param string|null $merchantOrderId
     *
     * @return ResponseInterface
     */
    public function confirmContract($contractReference, $merchantOrderId = null)
    {
        $model = (new ConfirmContract())
            ->setContractReference($contractReference)
            ->setMerchantOrderId($merchantOrderId);

        $request = new ConfirmContractRequest();

        return $this->call($model, $request);
    }

    /**
     * @param string $contractReference
     *
     * @return ResponseInterface
     */
    public function cancelContract($contractReference)
    {
        $model = (new CancelContract())
            ->setContractReference($contractReference);

        $request = new CancelContractRequest();

        return $this->call($model, $request);
    }

    /**
     * Set amount to null for a complete withdraw or set a value for a partial withdraw.
     *
     * @param string $contractReference
     * @param float|null $amount
     *
     * @return ResponseInterface
     */
    public function withdrawContract($contractReference, $amount = null)
    {
        $model = (new WithdrawContract())
            ->setContractReference($contractReference)
            ->setAmount($amount);

        $request = new WithdrawContractRequest();

        return $this->call($model, $request);
    }

    /**
     * @param string $contractReference
     *
     * @return ResponseInterface
     */
    public function loadContract($contractReference)
    {
        $model = (new LoadContract())
            ->setContractReference($contractReference);

        $request = new LoadContractRequest();

        return $this->call($model, $request);
    }

    /**
     * @return ResponseInterface
     */
    public function getAvailableMaturities()
    {
        $model = null;

        $request = new AvailableMaturitiesRequest();

        return $this->call($model, $request);
    }
}
