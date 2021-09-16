<?php

namespace Asorasoft\Bill;

class Customer
{
    public static function updateOrCreate(array $customer)
    {
        $billClient = new BillClient();

        $response = $billClient->post('/api/bill/v1/customer/update-or-create', $customer);

        return json_decode($response->getBody());
    }

    public static function find($customer_id)
    {
        $billClient = new BillClient();

        $response = $billClient->post('/api/bill/v1/customer/show', [
            'customer_id' => $customer_id
        ]);

        return json_decode($response->getBody());
    }

    public function renew()
    {
        $billClient = new BillClient();

        $response = $billClient->post('/api/bill/v1/subscription/renew', [
            'customer_id' => $this->id
        ]);

        return json_decode($response->getBody());
    }

    public function currentPlan()
    {
        $billClient = new BillClient();

        $response = $billClient->post('/api/bill/v1/plan/current', [
            'customer_id' => $this->id
        ]);

        return json_decode($response->getBody());
    }

    public function invoices()
    {
        $billClient = new BillClient();

        $response = $billClient->post('/api/bill/v1/invoice', [
            'customer_id' => $this->id
        ]);

        return json_decode($response->getBody());
    }
}
