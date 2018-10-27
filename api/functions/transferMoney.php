<?php

function signRequest($deptorId, $creditorId, $amount){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/jwssignverifyapi/sign",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\r\n  \"debtor\": {\r\n    \"bankId\": \"\",\r\n    \"accountId\": \"$deptorId\"\r\n  },\r\n  \"creditor\": {\r\n    \"bankId\": \"\",\r\n    \"accountId\": \"$creditorId\"\r\n  },\r\n  \"transactionAmount\": {\r\n    \"amount\": $amount,\r\n    \"currency\": \"EUR\",\r\n    \"currencyRate\": \"string\"\r\n  },\r\n  \"endToEndId\": \"string\",\r\n  \"paymentDetails\": \"test sandbox \",\r\n  \"terminalId\": \"string\",\r\n  \"branch\": \"\",\r\n   \"executionDate\": \"\",\r\n  \"valueDate\": \"\"\r\n}\r\n",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "tppId: singpaymentdata"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return 0;
    } else {
        return json_decode($response,true);
    }
}

function createPayment($payload, $signature, $protected, $clientId, $clientSecret, $authCode, $subscriptionId){
    $curl = curl_init();

    $curl_data = array(
        CURLOPT_URL => "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/v1/payments?client_id=".$clientId."&client_secret=".$clientSecret."",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n    \"payload\": \"$payload\",\n    \"signatures\": [\n        {\n            \"protected\": \"$protected\",\n            \"signature\": \"$signature\"\n        }\n    ]\n}",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ".$authCode,
            "Content-Type: application/json",
            "correlationId: xyz",
            "journeyId: abc",
            "lang: en",
            "originUserId: 50520218",
            "subscriptionId: ".$subscriptionId,
            "timeStamp: a",
            "tppId: singpaymentdata"
        ),
    );

    curl_setopt_array($curl, $curl_data);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return 0;
    } else {
        return json_decode($response,true);
    }
}

function approvePayment($clientId, $clientSecret, $transactionTime, $paymentId,$authCode,$subscriptionId){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/v1/payments/".$paymentId."/authorize?client_id=".$clientId."&client_secret=".$clientSecret,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\r\n  \"transactionTime\": \"$transactionTime\",\r\n  \"authCode\": \"123456\"\r\n}\r\n",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer ".$authCode,
        "Content-Type: application/json",
        "journeyId: abc",
        "originUserId: 50520218",
        "subscriptionId: ".$subscriptionId,
        "timeStamp: a",
        "tppId: singpaymentdata"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return 0;
    } else {
        return json_decode($response,true);
    }
}