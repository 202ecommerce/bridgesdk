# Younited Pay SDK for PHP


[![Coding Standart](https://github.com/202ecommerce/younitedpaysdk/actions/workflows/main.yml/badge.svg)](https://github.com/202ecommerce/younitedpaysdk/actions/workflows/main.yml) [![Unit test](https://github.com/202ecommerce/younitedpaysdk/actions/workflows/phpunit.yml/badge.svg)](https://github.com/202ecommerce/younitedpaysdk/actions/workflows/phpunit.yml)

This package is a Younited Pay PHP SDK. It let you mange exchange between your shop and Younited Pay.

This package is a dependancy of Younited Credit PrestaShop or Magento plugin.


## Versions scope

This package is compatible with PHP 5.6+.

## How to install it ?

Todo: Composer via packagist


To use this package with php 5.6 or in production mode, please install this dependancy with :
```
composer update --ignore-platform-reqs --no-dev
```

in a eveloppement environment
```
composer update
```

## How to try this SDK ?

### Get Younited Pay eligible offers, per maturities

[Best Price documentation][bestprice-doc] 

You can easily get list of offer by creating a request

```php
require 'vendor/autoload.php';

use YounitedPaySDK\Client;
use YounitedPaySDK\Request\BestPriceRequest;
use YounitedPaySDK\Model\BestPrice;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';

$body = (new BestPrice())
    ->setBorrowedAmount(149.0);

$request = (new BestPriceRequest())
    ->enableSandbox()
    ->setModel($body);

$client = new Client();
try {
    $response = $client->setCredential($clientId, $clientSecret)
        ->sendRequest($request);
    echo '<pre>';
    var_dump($response->getModel());
    echo '</pre>';
} catch (Exception $e) {
    echo ($e->getMessage() . $e->getFile() . ':' . $e->getLine(). $e->getTraceAsString());
}
```

You can also use the client api service to get list of offer

```php
require 'vendor/autoload.php';

use YounitedPaySDK\Client;
use YounitedPaySDK\Service\ClientApiService;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';

$borrowedAmount = 149.0;
    
$client = (new Client())
    ->setCredential($clientId, $clientSecret);
    
$response = (new ClientApiService($client))
    ->enableTest()
    ->getBestPrice($borrowedAmount);
```

### Get Available Maturities

[Get available maturities documentation][maturities-doc]

You can easily get available maturities by creating a request

```php
require 'vendor/autoload.php';

use YounitedPaySDK\Client;
use YounitedPaySDK\Request\LoadContractRequest;
use YounitedPaySDK\Model\LoadContract;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';

$request = (new LoadContractRequest())
    ->enableSandbox()

$client = new Client();
try {
    $response = $client->setCredential($clientId, $clientSecret)
        ->sendRequest($request);
    echo '<pre>';
    var_dump($response->getModel());
    echo '</pre>';
} catch (Exception $e) {
    echo ($e->getMessage() . $e->getFile() . ':' . $e->getLine(). $e->getTraceAsString());
}
```

You can also use the client api service to get available maturities

```php
require 'vendor/autoload.php';

use YounitedPaySDK\Client;
use YounitedPaySDK\Service\ClientApiService;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';

$contractReference = 'contract-reference';
    
$client = (new Client())
    ->setCredential($clientId, $clientSecret);
    
$response = (new ClientApiService($client))
    ->enableTest()
    ->getAvailableMaturities();
```

### Load Contract

[Load a contract documentation][contract-doc]

You can easily load a contract by creating a request

```php
require 'vendor/autoload.php';

use YounitedPaySDK\Client;
use YounitedPaySDK\Request\LoadContractRequest;
use YounitedPaySDK\Model\LoadContract;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';

$body = (new LoadContract())
    ->setContractReference('contract-ref');

$request = (new LoadContractRequest())
    ->enableSandbox()
    ->setModel($body);

$client = new Client();
try {
    $response = $client->setCredential($clientId, $clientSecret)
        ->sendRequest($request);
    echo '<pre>';
    var_dump($response->getModel());
    echo '</pre>';
} catch (Exception $e) {
    echo ($e->getMessage() . $e->getFile() . ':' . $e->getLine(). $e->getTraceAsString());
}
```

You can also use the client api service to load a contract

```php
require 'vendor/autoload.php';

use YounitedPaySDK\Client;
use YounitedPaySDK\Service\ClientApiService;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';

$contractReference = 'contract-reference';
    
$client = (new Client())
    ->setCredential($clientId, $clientSecret);
    
$response = (new ClientApiService($client))
    ->enableTest()
    ->loadContract($contractReference);
```

### Initialize a contract

[Initialize a contract documentation][initialize-doc] 

You can easily initialize a contract by creating a request

```php
require 'vendor/autoload.php';

use YounitedPaySDK\Client;
use YounitedPaySDK\Request\InitializeContractRequest;
use YounitedPaySDK\Model\Address;
use YounitedPaySDK\Model\PersonalInformation;
use YounitedPaySDK\Model\BasketItem;
use YounitedPaySDK\Model\Basket;
use YounitedPaySDK\Model\MerchantUrls;
use YounitedPaySDK\Model\MerchantOrderContext;
use YounitedPaySDK\Model\InitializeContract;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';

$datetime = new \DateTime('1970-01-01T00:00:00');

$address = (new Address())
    ->setStreetNumber('123')
    ->setStreetName('StreetName')
    ->setAdditionalAddress('')
    ->setCity('Country')
    ->setPostalCode('12345')
    ->setCountryCode('FR');

$personalInformation = (new PersonalInformation())
    ->setFirstName('FirstName')
    ->setLastName('LastName')
    ->setGenderCode('MALE')
    ->setEmailAddress('firstname.lastname@mail.com')
    ->setCellPhoneNumber('33611223344')
    ->setBirthDate($datetime)
    ->setAddress($address);
     
$basketItem1 = (new BasketItem())
    ->setItemName('Item basket 1')
    ->setQuantity(2)
    ->setUnitPrice(45.0);

$basketItem2 = (new BasketItem())
    ->setItemName('Item basket 2')
    ->setQuantity(1)
    ->setUnitPrice(33.0);

$basket = (new Basket())
    ->setBasketAmount(123.0)
    ->setItems([$basketItem1, $basketItem2]);
    
$merchantUrls = (new MerchantUrls())
    ->setOnApplicationFailedRedirectUrl('on-application-failed-redirect-url.com')
    ->setOnApplicationSucceededRedirectUrl('on-application-succeeded-redirect-url.com')
    ->setOnCanceledWebhookUrl('on-canceled-webhook-url.com')
    ->setOnWithdrawnWebhookUrl('on-withdrawn-webhook-url.com');
    
$merchantOrderContext = (new MerchantOrderContext())
    ->setChannel('test')
    ->setShopCode('TEST')
    ->setMerchantReference('MerchantReference')
    ->setAgentEmailAddress('merchant@mail.com');
    
$body = (new InitializeContract())
    ->setRequestedMaturity(10)
    ->setPersonalInformation($personalInformation)
    ->setBasket($basket)
    ->setMerchantUrls($merchantUrls)
    ->setMerchantOrderContext($merchantOrderContext);

$request = (new InitializeContractRequest())
    ->enableSandbox()
    ->setModel($body);

$client = new Client();
try {
    $response = $client->setCredential($clientId, $clientSecret)
        ->sendRequest($request);
    echo '<pre>';
    var_dump($response->getModel());
    echo '</pre>';
} catch (Exception $e) {
    echo ($e->getMessage() . $e->getFile() . ':' . $e->getLine(). $e->getTraceAsString());
}
```

You can also use the client api service to initialize a contract

```php
require 'vendor/autoload.php';

use YounitedPaySDK\Client;
use YounitedPaySDK\Model\Address;
use YounitedPaySDK\Model\PersonalInformation;
use YounitedPaySDK\Model\BasketItem;
use YounitedPaySDK\Model\Basket;
use YounitedPaySDK\Model\MerchantUrls;
use YounitedPaySDK\Model\MerchantOrderContext;
use YounitedPaySDK\Service\ClientApiService;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';

$requestedMaturity = 10;

$datetime = new \DateTime('1970-01-01T00:00:00');

$address = (new Address())
    ->setStreetNumber('123')
    ->setStreetName('StreetName')
    ->setAdditionalAddress('')
    ->setCity('Country')
    ->setPostalCode('12345')
    ->setCountryCode('FR');

$personalInformation = (new PersonalInformation())
    ->setFirstName('FirstName')
    ->setLastName('LastName')
    ->setGenderCode('MALE')
    ->setEmailAddress('firstname.lastname@mail.com')
    ->setCellPhoneNumber('33611223344')
    ->setBirthDate($datetime)
    ->setAddress($address);
     
$basketItem1 = (new BasketItem())
    ->setItemName('Item basket 1')
    ->setQuantity(2)
    ->setUnitPrice(45.0);

$basketItem2 = (new BasketItem())
    ->setItemName('Item basket 2')
    ->setQuantity(1)
    ->setUnitPrice(33.0);

$basket = (new Basket())
    ->setBasketAmount(123.0)
    ->setItems([$basketItem1, $basketItem2]);
    
$merchantUrls = (new MerchantUrls())
    ->setOnApplicationFailedRedirectUrl('on-application-failed-redirect-url.com')
    ->setOnApplicationSucceededRedirectUrl('on-application-succeeded-redirect-url.com')
    ->setOnCanceledWebhookUrl('on-canceled-webhook-url.com')
    ->setOnWithdrawnWebhookUrl('on-withdrawn-webhook-url.com');
    
$merchantOrderContext = (new MerchantOrderContext())
    ->setChannel('test')
    ->setShopCode('TEST')
    ->setMerchantReference('MerchantReference')
    ->setAgentEmailAddress('merchant@mail.com');
    
$client = (new Client())
    ->setCredential($clientId, $clientSecret);
    
$response = (new ClientApiService($client))
    ->enableTest()
    ->initializeContract($requestMaturity, $personalInformation, $basket, $merchantUrls, $merchantOrderContext);
```

### Confirm Contract

[Confirm a contract documentation][confirm-doc]

You can easily confirm a contract by creating a request

```php
require 'vendor/autoload.php';

use YounitedPaySDK\Client;
use YounitedPaySDK\Request\ConfirmContractRequest;
use YounitedPaySDK\Model\ConfirmContract;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';

$body = (new ConfirmContract())
    ->setContractReference('contract-ref')
    ->setMerchantOrderId('order-id');

$request = (new ConfirmContractRequest())
    ->enableSandbox()
    ->setModel($body);

$client = new Client();
try {
    $response = $client->setCredential($clientId, $clientSecret)
        ->sendRequest($request);
    echo '<pre>';
    var_dump($response->getModel());
    echo '</pre>';
} catch (Exception $e) {
    echo ($e->getMessage() . $e->getFile() . ':' . $e->getLine(). $e->getTraceAsString());
}
```

You can also use the client api service to confirm a contract

```php
require 'vendor/autoload.php';

use YounitedPaySDK\Client;
use YounitedPaySDK\Service\ClientApiService;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';

$contractReference = 'contract-reference';
$merchantOrderId = 'merchant-order_id';
    
$client = (new Client())
    ->setCredential($clientId, $clientSecret);
    
$response = (new ClientApiService($client))
    ->enableTest()
    ->confirmContract($contractReference, $merchantOrderId = null);
```

### Activate Contract

[Activate a contract documentation][activate-doc]

You can easily activate a contract by creating a request

```php
require 'vendor/autoload.php';

use YounitedPaySDK\Client;
use YounitedPaySDK\Request\ActivateContractRequest;
use YounitedPaySDK\Model\ActivateContract;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';

$body = (new ActivateContract())
    ->setContractReference('contract-ref');

$request = (new ActivateContractRequest())
    ->enableSandbox()
    ->setModel($body);

$client = new Client();
try {
    $response = $client->setCredential($clientId, $clientSecret)
        ->sendRequest($request);
    echo '<pre>';
    var_dump($response->getModel());
    echo '</pre>';
} catch (Exception $e) {
    echo ($e->getMessage() . $e->getFile() . ':' . $e->getLine(). $e->getTraceAsString());
}
```

You can also use the client api service to activate a contract

```php
require 'vendor/autoload.php';

use YounitedPaySDK\Client;
use YounitedPaySDK\Service\ClientApiService;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';

$contractReference = 'contract-reference';
    
$client = (new Client())
    ->setCredential($clientId, $clientSecret);
    
$response = (new ClientApiService($client))
    ->enableTest()
    ->activateContract($contractReference);
```

### Withdraw Contract

[Withdraw a contract documentation][withdraw-doc]

You can easily withdraw a contract by creating a request

```php
require 'vendor/autoload.php';

use YounitedPaySDK\Client;
use YounitedPaySDK\Request\WithdrawContractRequest;
use YounitedPaySDK\Model\WithdrawContract;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';

$body = (new WithdrawContract())
    ->setContractReference('contract-ref')
    ->setAmount(149.0);

$request = (new WithdrawContractRequest())
    ->enableSandbox()
    ->setModel($body);

$client = new Client();
try {
    $response = $client->setCredential($clientId, $clientSecret)
        ->sendRequest($request);
    echo '<pre>';
    var_dump($response->getModel());
    echo '</pre>';
} catch (Exception $e) {
    echo ($e->getMessage() . $e->getFile() . ':' . $e->getLine(). $e->getTraceAsString());
}
```

You can also use the client api service to withdraw a contract

```php
require 'vendor/autoload.php';

use YounitedPaySDK\Client;
use YounitedPaySDK\Service\ClientApiService;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';

$contractReference = 'contract-reference';
$amount = '149.0';
    
$client = (new Client())
    ->setCredential($clientId, $clientSecret);
    
$response = (new ClientApiService($client))
    ->enableTest()
    ->withdrawContract($contractReference, $amount);
```

### Cancel Contract

[Cancel a contract documentation][cancel-doc]

You can easily cancel a contract by creating a request

```php
require 'vendor/autoload.php';

use YounitedPaySDK\Client;
use YounitedPaySDK\Request\CancelContractRequest;
use YounitedPaySDK\Model\CancelContract;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';

$body = (new CancelContract())
    ->setContractReference('contract-ref');

$request = (new CancelContractRequest())
    ->enableSandbox()
    ->setModel($body);

$client = new Client();
try {
    $response = $client->setCredential($clientId, $clientSecret)
        ->sendRequest($request);
    echo '<pre>';
    var_dump($response->getModel());
    echo '</pre>';
} catch (Exception $e) {
    echo ($e->getMessage() . $e->getFile() . ':' . $e->getLine(). $e->getTraceAsString());
}
```

You can also use the client api service to cancel a contract

```php
require 'vendor/autoload.php';

use YounitedPaySDK\Client;
use YounitedPaySDK\Service\ClientApiService;

$clientId = 'your-client-id';
$clientSecret = 'your-secret-idtoken';

$contractReference = 'contract-reference';
    
$client = (new Client())
    ->setCredential($clientId, $clientSecret);
    
$response = (new ClientApiService($client))
    ->enableTest()
    ->cancelContract($contractReference);
```

### Get Callback Response to configure Webhook

[Get callback response documentation][callback-doc]

You can easily get available maturities by creating a request

```php
require 'vendor/autoload.php';

use YounitedPaySDK\Client;
use YounitedPaySDK\Service\ClientApiService;
    
$response = (new Client())->retrieveCallbackResponse();

// Do webhook process
```

[bestprice-doc]: https://api.younited-pay.com/#tag/BestPrice/paths/~1api~11.0~1BestPrice/post
[maturities-doc]: https://api.younited-pay.com/#tag/Maturities/paths/~1api~11.0~1Maturities/get
[contract-doc]: https://api.younited-pay.com/#tag/Contract/paths/~1api~11.0~1Contract~1{contractReference}/get
[initialize-doc]: https://api.younited-pay.com/#tag/Contract/paths/~1api~11.0~1Contract/post
[confirm-doc]: https://api.younited-pay.com/#tag/Contract/paths/~1api~11.0~1Contract~1{contractReference}~1confirm/patch
[activate-doc]: https://api.younited-pay.com/#tag/Contract/paths/~1api~11.0~1Contract~1{contractReference}~1activate/patch
[withdraw-doc]: https://api.younited-pay.com/#tag/Contract/paths/~1api~11.0~1Contract~1{contractReference}~1withdraw/patch
[cancel-doc]: https://api.younited-pay.com/#tag/Contract/paths/~1api~11.0~1Contract~1{contractReference}/delete
[callback-doc]: https://api.younited-pay.com/#tag/Contract/paths/~1api~11.0~1Contract/post