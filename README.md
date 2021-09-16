# Bill for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/helmab/bill.svg?style=flat-square)](https://packagist.org/packages/asorasoft/bill)
[![Total Downloads](https://img.shields.io/packagist/dt/helmab/bill.svg?style=flat-square)](https://packagist.org/packages/asorasoft/bill)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require asorasoft/bill
```

## Usage

```php
<?php

Class YourController extends Controller 
{
    public function createOrUpdateCustomer()
    {
        # create or update customer
        Customer::updateOrCreate([
            'customer_id' => $customer_id,
            'name' => 'Name',
            'phone' => 'Phone Number', // '019000000'
            'email' => 'customer@gmail.com'
        ]);
    }
    
    public function getCustomerAndPlans() 
    {
        # get customer and plans
        $get_customer_and_plans = Subscription::getCustomerAndPlans($customer_id);
        
        return json_encode($get_customer_and_plans);
    }
    
    public function subscribe()
    {
        # subscribe plan
        Subscription::subscribe($customer_id, $plan_id);
    }
    
    public function changePlanRequest()
    {
        $this->validate($request, [
            'from_plan_id' => 'required',
            'to_plan_id' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'document' => 'required',
        ]);
        
        # change plan request
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
    
    public function renewalPlanRequest()
    {
        $this->validate($request, [
            'price' => 'required',
            'duration' => 'required',
            'document' => 'required',
        ]);
        
        # renewal plan request
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
    
    public function listInvoices()
    {
        $response = Invoice::list($customer_id);

        return json_encode($response);
    }
    
    public function downloadInvoice()
    {
        return Invoice::download($invoice_uuid);
    }
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
