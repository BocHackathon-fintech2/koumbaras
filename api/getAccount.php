<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include required files
include_once 'functions/accountFunctions.php';

$clientId = "d4cdc1e7-1dfc-4467-948e-58e30d3fa811";
$clientSecret = "fC2yX7rD4hD1vY3wR7aY2lF6uG1aC0dT8pI3kD7oC4jW4bL8iU";
 
$authCode = isset($_GET['authCode']) ? $_GET['authCode'] : null;
$subId = isset($_GET['subId']) ? $_GET['subId'] : null;
$accountId = isset($_GET['accountId']) ? $_GET['accountId'] : null;


if($authCode != null && $subId != null && $accountId != null){
    
    $accountDetailsResult = accountDetails($clientId, $clientSecret,$accountId, $authCode, $subId);

    if(isset($accountDetailsResult['fatalError']) || $accountDetailsResult == 0){
        http_response_code(500);
    
        echo json_encode(array("message" => $accountDetailsResult['error']['additionalDetails'][0]['description']));
        die();
    }

    $accountDetails = array(
            "accountId" => $accountDetailsResult[0]['accountId'],
            "accountName" => $accountDetailsResult[0]['accountName'],
            "currency" => $accountDetailsResult[0]['currency'],
            "balances" => $accountDetailsResult[0]['balances'],
        );

    http_response_code(200);
 
    // make it json format
    echo json_encode($accountDetails);
}else{
    http_response_code(400);

    echo json_encode(array("message" => "Provide Authentication Code, Account Id and Subscrider Id"));
}