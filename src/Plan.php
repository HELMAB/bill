<?php

namespace Asorasoft\Bill;

class Plan
{
    public static function all()
    {
        $billClient = new BillClient();

        $response = $billClient->post('/api/v1/plan');

        return json_decode($response->getBody());
    }
}
