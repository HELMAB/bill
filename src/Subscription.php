<?php

namespace Asorasoft\Bill;

class Subscription
{
    public static function subscribe($customer_id, $plan_id)
    {
        $billClient = new BillClient();

        $response = $billClient->post('/api/bill/v1/subscription/subscribe', [
            'customer_id' => $customer_id,
            'plan_id' => $plan_id,
        ]);

        return json_decode($response->getBody());
    }

    public static function firstSubscribe($data)
    {
        $billClient = new BillClient();

        return $billClient->postWithFile('/api/bill/v1/subscription/first-subscribe', $data);
    }

    public static function getCustomerAndPlans($customer_id)
    {
        $billClient = new BillClient();

        $response = $billClient->post('/api/bill/v1/subscription/get-customer-and-plans', [
            'customer_id' => $customer_id
        ]);

        return json_decode($response->getBody());
    }
}
