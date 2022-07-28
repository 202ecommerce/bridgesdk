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

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;

class IntegrationTestCase extends TestCase
{
    protected $clientId;

    protected $clientSecret;

    protected $version;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->clientId = getenv('BRIDGE_CLIENT_ID');
        $this->clientSecret = getenv('BRIDGE_CLIENT_SECRET');
        $this->version = '2021-06-01';
    }

    protected function setUp(): void
    {
        $integrationTest = getenv('BRIDGE_INTEGRATION_TEST');
        if (!$integrationTest) {
            $this->markTestSkipped('Skipping integration test: ' . $this->getName());
        }
    }
}
