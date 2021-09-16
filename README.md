# Bill for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/helmab/bill.svg?style=flat-square)](https://packagist.org/packages/asorasoft/bill)
[![Total Downloads](https://img.shields.io/packagist/dt/helmab/bill.svg?style=flat-square)](https://packagist.org/packages/asorasoft/bill)

The subscription plan billing for Laravel

## Installation

You can install the package via composer:

```bash
composer require asorasoft/bill
```

Register `BillServiceProvider` class in `config/app.php`

```php
<?php
    ...
    'providers' => [
        ...
        /*
         * Package Service Providers...
         */
        Asorasoft\Bill\BillServiceProvider:class
    ]
```

You need to publish the configuration file, it will create `bill.php` file

```bash
php artisan vendor:publish --provider="Asorasoft\Bill\BillServiceProvider"
```

Copy bill key configuration to `.env` file

```dotenv
BILL_SECRET_KEY=
BILL_API_URL=
BILL_VERIFY_SSL=
```

## Usage

### Update or create customer

```php
public function createOrUpdateCustomer()
{
    Customer::updateOrCreate([
        'customer_id' => $customer_id,
        'name' => 'Name',
        'phone' => '019000000',
        'email' => 'customer@gmail.com'
    ]);
}
```

### Get customer and plans

```php
public function getCustomerAndPlans() 
{
    $get_customer_and_plans = Subscription::getCustomerAndPlans($customer_id);
    
    return json_encode($get_customer_and_plans);
}
```

### Subscribe a plan

```php
public function subscribe()
{
    Subscription::subscribe($customer_id, $plan_id);
}
```

### Change plan request

```php
public function changePlanRequest()
{
    $this->validate($request, [
        'from_plan_id' => 'required',
        'to_plan_id' => 'required',
        'price' => 'required',
        'duration' => 'required',
        'document' => 'required',
    ]);
    
    $response = ChangePlanRequest::create([
        ['name' => 'customer_id', 'contents' => $customer_id],
        ['name' => 'from_plan_id', 'contents' => $request->from_plan_id],
        ['name' => 'to_plan_id', 'contents' => $request->to_plan_id],
        ['name' => 'duration', 'contents' => $request->duration],
        ['name' => 'price', 'contents' => $request->price],
        [
            'name' => 'document',
            'contents' => fopen($request->document->path(), 'r'),
            'filename' => $request->document->getClientOriginalName(),
            'Mime-Type' => $request->document->getClientMimeType()
        ],
    ]);

    return json_encode($response);
}
```

### Renewal Plan Request

```php
public function renewalPlanRequest()
{
    $this->validate($request, [
        'price' => 'required',
        'duration' => 'required',
        'document' => 'required',
    ]);
    
    $response = RenewalPlanRequest::create([
        ['name' => 'customer_id', 'contents' => $customer_id],
        ['name' => 'duration', 'contents' => $request->duration],
        ['name' => 'price', 'contents' => $request->price],
        [
            'name' => 'document',
            'contents' => fopen($request->document->path(), 'r'),
            'filename' => $request->document->getClientOriginalName(),
            'Mime-Type' => $request->document->getClientMimeType()
        ],
    ]);
    
    return json_encode($response);
}
```

### Get invoices list

```php
public function invoices()
{
    $response = Invoice::list($customer_id);

    return json_encode($response);
}
```

### Downloading an invoice

```php
public function download()
{
    return Invoice::download($invoice_uuid);
}
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email mab@asorasoft.com instead of using the issue tracker.

## Credits

-   [Mab Hel](https://github.com/helmab)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
