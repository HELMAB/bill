<?php

namespace Asorasoft\Bill;

class Invoice
{
    public static function list($customer_id)
    {
        $billClient = new BillClient();

        $response = $billClient->post('/api/bill/v1/invoice/list', [
            'customer_id' => $customer_id
        ]);

        return json_decode($response->getBody());
    }

    public static function nextRenewal($customer_id)
    {
        $billClient = new BillClient();

        $response = $billClient->post('/api/bill/v1/invoice/next-renewal', [
            'customer_id' => $customer_id
        ]);

        return json_decode($response->getBody());
    }

    public static function download($invoice_uuid)
    {
        $billClient = new BillClient();

        return $billClient->post('/api/bill/v1/invoice/download', [
            'invoice_uuid' => $invoice_uuid
        ]);
    }
}
