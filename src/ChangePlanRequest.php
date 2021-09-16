<?php

namespace Asorasoft\Bill;

class ChangePlanRequest
{
    public static function create(array $data)
    {
        $billClient = new BillClient();

        $response = $billClient->postWithFile('/api/bill/v1/change-plan-request/store', $data);

        return json_decode($response->getBody());
    }

    public static function status($customer_id)
    {
        $billClient = new BillClient();

        $response = $billClient->post('/api/bill/v1/change-plan-request/status', [
            'customer_id' => $customer_id
        ]);

        return json_decode($response->getBody());
    }
}
