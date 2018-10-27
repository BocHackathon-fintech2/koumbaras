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


if($authCode != null && $subId != null){
    
    $accounts = getAccounts($clientId,$clientSecret,$authCode,$subId);

    if(isset($accounts['fatalError']) || $accounts == 0){
        http_response_code(500);
    
        echo json_encode(array("message" => $accounts['error']['additionalDetails'][0]['description']));
        die();
    }

    $accountsData = array();

    for($i = 0; $i < count($accounts); $i++){

        $accountBalances = accountDetails($clientId, $clientSecret,$accounts[$i]['accountId'], $authCode, $subId);

        array_push($accountsData,array(
            "accountId" => $accounts[$i]['accountId'],
            "accountName" => $accounts[$i]['accountName'],
            "currency" => $accounts[$i]['currency'],
            "balances" => $accountBalances[0]['balances'],
            )
        );
    }

    
    
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($accountsData);
}else{
    http_response_code(400);

    echo json_encode(array("message" => "Provide Authentication Code and Subscrider Id"));
}
?>