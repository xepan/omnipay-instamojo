# Omnipay: [Instamojo](https://www.instamojo.com/)

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply run:

```json
composer require gentor/omnipay-instamojo
```

## Purchase

```
use Omnipay\Omnipay;

// Setup payment gateway
$gateway = Omnipay::create('Instamojo');
$gateway->setApiKey('abc123');
$gateway->setAuthToken('abc123');

// Send purchase request
$response = $gateway->purchase(
    [
        'amount' => '10.00',
        'purpose' => 'Instamojo Payment'
    ]
)->send();

// Process response
if ($response->isSuccessful() && $response->isRedirect()) {

    // Redirect to offsite payment gateway
    $response->redirect();

} else {

    // Request failed
    echo $response->getMessage();
}
```

## Complete Purchase

```
// Send complete purchase request
$response = $gateway->completePurchase(
    [
        'transactionReference' => $_GET['payment_id'],
    ]
)->send();

// Process response
if ($response->isSuccessful()) {

    // Request was successful
    print_r($response);

} else {

    // Request failed
    echo $response->getMessage();
}
```

## Refund

```
// Send refund request
$response = $gateway->refund(
    [
        'transactionReference' => $payment_id,
    ]
)->send();

// Process response
if ($response->isSuccessful()) {

    // Request was successful
    print_r($response);

} else {

    // Request failed
    echo $response->getMessage();
}
```

## Fetch Payment Request

```
// Send fetch payment request
$response = $gateway->fetchPaymentRequest(
    [
        'transactionReference' => $payment_request_id,
    ]
)->send();

// Process response
if ($response->isSuccessful()) {

    // Request was successful
    print_r($response);

} else {

    // Request failed
    echo $response->getMessage();
}
```
