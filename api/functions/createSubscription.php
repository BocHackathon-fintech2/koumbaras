<?php

function getAuthCode($clientId, $clientSecret){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/token",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "client_id=".$clientId."&client_secret=".$clientSecret."&grant_type=client_credentials&scope=TPPOAuth2Security",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/x-www-form-urlencoded"
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

function createSubscription($authCode,$clientId, $clientSecret){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/v1/subscriptions?client_id=".$clientId."&client_secret=".$clientSecret,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\r\n \"accounts\": {\r\n    \"transactionHistory\": true,\r\n    \"balance\": true,\r\n    \"details\": true,\r\n    \"checkFundsAvailability\": true\r\n  },\r\n  \"payments\": {\r\n    \"limit\": 99999999,\r\n    \"currency\": \"EUR\",\r\n    \"amount\": 999999999\r\n  }\r\n}",
    CURLOPT_HTTPHEADER => array(
        "APIm-Debug-Trans-Id: true",
        "Authorization: Bearer " . $authCode,
        "Content-Type: application/json",
        "app_name: myapp",
        "journeyId: abc",
        "originUserId: 50520218",
        "timeStamp: a",
        "tppid: singpaymentdata"
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

function createRedirection($redirectionUrl,$clientId, $subid){
    return '
    https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/authorize?response_type=code&redirect_uri='.$redirectionUrl.'&scope=UserOAuth2Security&client_id='.$clientId.'&subscriptionid='.$subid;
}

function authenticateUrlCode($clientId,$clientSecret,$urlCode){
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/token",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "client_id=".$clientId."&client_secret=".$clientSecret."&grant_type=authorization_code&scope=UserOAuth2Security&code=".$urlCode,
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/x-www-form-urlencoded"
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

function retrieveSubscription($subId,$clientId,$clientSecret,$authCode){
    
$curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/v1/subscriptions/".$subId."?client_id=".$clientId."&client_secret=".$clientSecret,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "APIm-Debug-Trans-Id: true",
        "Authorization: Bearer ".$authCode,
        "Content-Type: application/json",
        "journeyId: abc",
        "originUserId: 50520218",
        "timestamp: a",
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

function patchSubscription($subId,$clientId,$clientSecret,$authCodeTwo,$postBody){
    
$curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/v1/subscriptions/".$subId."?client_id=".$clientId."&client_secret=".$clientSecret,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PATCH",
    CURLOPT_POSTFIELDS => $postBody,
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer ".$authCodeTwo,
        "Content-Type: application/json",
        "app_name: BOCtest",
        "journeyId: abc",
        "originUserId: 50520218",
        "timeStamp: a",
        "tppid: singpaymentdata"
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