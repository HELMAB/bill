<?php

namespace Asorasoft\Bill;

class RenewalPlanRequest
{
    public static function create(array $data)
    {
        $billClient = new BillClient();

        $response = $billClient->postWithFile('/api/bill/v1/renewal-plan-request/store', $data);

        return json_decode($response->getBody());
    }

    public static function status($customer_id)
    {
        $billClient = new BillClient();

        $response = $billClient->post('/api/bill/v1/renewal-plan-request/status', [
            'customer_id' => $customer_id
        ]);

        return json_decode($response->getBody());
    }
}
