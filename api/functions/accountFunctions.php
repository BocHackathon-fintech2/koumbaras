<?php

function accountDetails($clientId, $clientSecret,$accountNumber, $authCode, $subscriptionId){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/v1/accounts/".$accountNumber."?client_id=".$clientId."&client_secret=".$clientSecret,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
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

function getAccounts($clientId, $clientSecret, $authCode, $subscriptionId){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/v1/accounts?client_id=".$clientId."&client_secret=".$clientSecret,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
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