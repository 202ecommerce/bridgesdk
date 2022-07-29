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

namespace BridgeSDK\Constant;

class PaymentStatuses
{
    /**
     * Status created : CREA, ACTC, ACCP
     * @var array
     */
    const CREATED_PAYMENTS = [
        'CREA',
        'ACTC',
        'ACCP',
    ];

    /**
     * Status success : PDNG, ACSP, PART or ACSC
     * @var array
     */
    const SUCCESS_PAYMENTS = [
        'PDNG',
        'ACSP',
        'PART',
        'ACSC',
    ];

    /**
     * Status done : PART or ACSC
     * @var array
     */
    const DONE_PAYMENTS = [
        'PART',
        'ACSC',
    ];

    /**
     * Status rejected : CANC, RJCT
     * @var array
     */
    const REJECTED_PAYMENTS = [
        'CANC',
        'RJCT',
    ];

    public static function getAllStatuses()
    {
        return array_merge(
            self::CREATED_PAYMENTS,
            self::SUCCESS_PAYMENTS,
            self::DONE_PAYMENTS,
            self::REJECTED_PAYMENTS
        );
    }

    /**
     * Status not found (error response)
     * @var string
     */
    const ERROR_NOT_FOUND = 'errorstatus';

    const PROCESS_IN_PROGRESS = 'inprogress';
}
