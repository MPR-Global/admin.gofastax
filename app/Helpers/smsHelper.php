<?php

namespace App\Helpers;

class smsHelper
{

    public static function send_sms($to_number, $sms)
    {
        $post_data = array();
        $post_data['customer_phone_number'] = '+1' . str_replace("-", "", $to_number);
        $post_data['tracking_number'] = env('SMS_TRACKING_NO');
        $post_data['content'] = $sms;
        $post_data['company_id'] = env('SMS_COMPANY_ID');

        // echo $to_number;
        // print_r($post_data);
        // exit;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.callrail.com/v3/a/' . env('SMS_ACCOUNT_ID') . '/text-messages.json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = 'Authorization: Token token=' . env('SMS_API_TOKEN');
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
//    echo '<pre>';
        //    print_r($result);
        //    exit;
        return ['success' => true];
        if (curl_errno($ch)) {
            //echo 'Error:' . curl_error($ch);
            return ['success' => false, 'message' => curl_error($ch)];
        }
        curl_close($ch);
    }
}
