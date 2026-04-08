# Bridge SDK for PHP

[![Coding Standart](https://github.com/202ecommerce/bridgesdk/actions/workflows/main.yml/badge.svg)](https://github.com/202ecommerce/bridgesdk/actions/workflows/main.yml) [![Unit test](https://github.com/202ecommerce/bridgesdk/actions/workflows/phpunit.yml/badge.svg)](https://github.com/202ecommerce/bridgesdk/actions/workflows/phpunit.yml)

This package is a Bridge PHP SDK. It let you manage exchange between your shop and Bridge.

This package is a dependency for Bridge PrestaShop module or Magento plugin.

## Versions scope

This package is compatible with PHP 5.6+.

## How to install it ?

composer require 202ecommerce/bridge-sdk

To use this package with php 5.6 or in production mode, please install this dependency with :

```
composer update --ignore-platform-reqs --no-dev
```

in a development environment

```
composer update
```

## How to try this SDK ?

### Get List of Banks

[List of banks documentation][list-banks-doc]

You can easily get list of banks by creating a request

```php
require 'vendor/autoload.php';

use BridgeSDK\Client;
use BridgeSDK\Model\Bank\ListBanks;
use BridgeSDK\Request\ListBanksRequest;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';

$request = new ListBanksRequest();
$client = new Client();
$model = $response->getModel();

try {
    $response = $client->setCredential($clientId, $clientSecret)
        ->sendRequest($request);
    echo '<pre>';
    var_dump($response->getModel());
    echo '</pre>';
} catch (Exception $e) {
    echo ($e->getMessage() . $e->getFile() . ':' . $e->getLine() . $e->getTraceAsString());
}
```

You can also use the client api service to get list of offer

```php
require 'vendor/autoload.php';

use BridgeSDK\Client;
use BridgeSDK\Service\ClientApiService;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';
 
$client = (new Client())
    ->setCredential($clientId, $clientSecret);
    
$response = (new ClientApiService($client))
    ->getListBanks();
```

### Get Bank by ID

[Get bank by ID documentation][bank-doc]

You can easily get a bank by ID by creating a request

```php
require 'vendor/autoload.php';

use BridgeSDK\Client;
use BridgeSDK\Model\Bank\Bank;
use BridgeSDK\Request\BankRequest;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';
$id = 'bank-id';

$request = (new BankRequest())
            ->setModel((new Bank())
                ->setId($id)
            );
$client = new Client();
$model = $response->getModel();

try {
    $response = $client->setCredential($clientId, $clientSecret)
        ->sendRequest($request);
    echo '<pre>';
    var_dump($response->getModel());
    echo '</pre>';
} catch (Exception $e) {
    echo ($e->getMessage() . $e->getFile() . ':' . $e->getLine() . $e->getTraceAsString());
}
```

You can also use the client api service to get list of offer

```php
require 'vendor/autoload.php';

use BridgeSDK\Client;
use BridgeSDK\Service\ClientApiService;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';
$id = 'bank-id';

$client = (new Client())
    ->setCredential($clientId, $clientSecret);
    
$response = (new ClientApiService($client))
    ->getBankById($id);
```

### Get Payment by ID

[Get payment by ID documentation][payment-doc]

You can easily get a payment by ID by creating a request

```php
require 'vendor/autoload.php';

use BridgeSDK\Client;
use BridgeSDK\Model\Payment\Payment;
use BridgeSDK\Request\PaymentRequest;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';
$id = 'payment-id';

$request = (new PaymentRequest())
            ->setModel((new Payment())
                ->setId($id)
            );
$client = new Client();
$model = $response->getModel();

try {
    $response = $client->setCredential($clientId, $clientSecret)
        ->sendRequest($request);
    echo '<pre>';
    var_dump($response->getModel());
    echo '</pre>';
} catch (Exception $e) {
    echo ($e->getMessage() . $e->getFile() . ':' . $e->getLine() . $e->getTraceAsString());
}
```

You can also use the client api service to get list of offer

```php
require 'vendor/autoload.php';

use BridgeSDK\Client;
use BridgeSDK\Service\ClientApiService;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';
$id = 'payment-id';

$client = (new Client())
    ->setCredential($clientId, $clientSecret);
    
$response = (new ClientApiService($client))
    ->getPayment($id);
```

### Create Payment

[Create payment documentation][create-payment-doc]

You can easily get create a payment by creating a request

```php
require 'vendor/autoload.php';

use BridgeSDK\Client;
use BridgeSDK\Model\Payment\CreatePayment;
use BridgeSDK\Model\Payment\CreatePaymentTransaction;
use BridgeSDK\Model\Payment\PaymentUser;
use BridgeSDK\Request\CreatePaymentRequest;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';

$body = (new CreatePayment())
            ->setBankId(6)
            ->setSuccessfulCallbackUrl('http://test.tot/?success')
            ->setUnsuccessfulCallbackUrl('http://test.tot/?error')
            ->setTransactions([
                (new CreatePaymentTransaction())
                    ->setCurrency('EUR')
                    ->setLabel('Label Unit test')
                    ->setAmount(10.50)
                    ->setClientReference('unit_test')
                    ->setEndToEndId('unit_test')
            ])
            ->setUser(
                (new PaymentUser())
                    ->setFirstName('Unit')
                    ->setLastName('Test')
                    ->setExternalReference('unit_test')
                    ->setIpAddress('192.168.1.1')
            );

$request = (new CreatePaymentRequest())
            ->setModel($body);
$client = new Client();
$model = $response->getModel();

try {
    $response = $client->setCredential($clientId, $clientSecret)
        ->sendRequest($request);
    echo '<pre>';
    var_dump($response->getModel());
    echo '</pre>';
} catch (Exception $e) {
    echo ($e->getMessage() . $e->getFile() . ':' . $e->getLine() . $e->getTraceAsString());
}
```

You can also use the client api service to get list of offer

```php
require 'vendor/autoload.php';

use BridgeSDK\Client;
use BridgeSDK\Model\Payment\CreatePayment;
use BridgeSDK\Model\Payment\CreatePaymentTransaction;
use BridgeSDK\Model\Payment\PaymentUser;
use BridgeSDK\Service\ClientApiService;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';
$body = (new CreatePayment())
            ->setBankId(6)
            ->setSuccessfulCallbackUrl('http://test.tot/?success')
            ->setUnsuccessfulCallbackUrl('http://test.tot/?error')
            ->setTransactions([
                (new CreatePaymentTransaction())
                    ->setCurrency('EUR')
                    ->setLabel('Label Unit test')
                    ->setAmount(10.50)
                    ->setClientReference('unit_test')
                    ->setEndToEndId('unit_test')
            ])
            ->setUser(
                (new PaymentUser())
                    ->setFirstName('Unit')
                    ->setLastName('Test')
                    ->setExternalReference('unit_test')
                    ->setIpAddress('192.168.1.1')
            );

$client = (new Client())
    ->setCredential($clientId, $clientSecret);
    
$response = (new ClientApiService($client))
    ->createPayment($body);
```

### Get Webhook Response

[Get webhook documentation][webhooks]

You can easily subscribe to the webhook using this code. Webhook can come from next IPs: \BridgeSDK\Constant\WebhookIP.

```php
require 'vendor/autoload.php';
    
try {
    $client = new \BridgeSDK\Client();
    $response = $client->retrieveWebhookResponse();
    
    $model = $response->getModel();
} catch (Exception $e) {
    // handle exception
}

// Do webhook process
```

[bank-doc]: https://docs.bridgeapi.io/reference/show-a-bank

[list-banks-doc]: https://docs.bridgeapi.io/reference/list-banks

[create-payment-doc]: https://docs.bridgeapi.io/reference/create-payment-request

[payment-doc]: https://docs.bridgeapi.io/reference/get-payment-request

[webhooks]: https://docs.bridgeapi.io/docs/webhooks-events
