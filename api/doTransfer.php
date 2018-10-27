<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once 'functions/transferMoney.php';

$clientId = "d4cdc1e7-1dfc-4467-948e-58e30d3fa811";
$clientSecret = "fC2yX7rD4hD1vY3wR7aY2lF6uG1aC0dT8pI3kD7oC4jW4bL8iU";

$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->debtorId) &&
    !empty($data->creditorId) &&
    !empty($data->amount) &&
    !empty($data->authCode) &&
    !empty($data->subId)
){
    //SET VARS
    $debtorId = $data->debtorId;
    $creditorId = $data->creditorId;
    $amount = $data->amount;
    $authCode = $data->authCode;
    $subId = $data->subId;

    $operationDone = true;
    $bankApiMessage;

    while(true){
        //STEP 1
        $signRequestResult = signRequest($debtorId,$creditorId,$amount);

        if($signRequestResult == 0 || isset($signRequestResult['fatalError'])){
            $operationDone = false;
            $bankApiMessage = $signRequestResult;
            break;
        }

        $payload = $signRequestResult['payload'];
        $protected = $signRequestResult['signatures'][0]['protected'];
        $signature = $signRequestResult['signatures'][0]['signature'];

        //STEP 2
        $createPaymentResult = createPayment($payload, $signature, $protected, $clientId, $clientSecret, $authCode, $subId);

        if($createPaymentResult == 0 || isset($createPaymentResult['fatalError'])){
            $operationDone = false;
            $bankApiMessage = $createPaymentResult;
            break;
        }

        $paymentId = $createPaymentResult['payment']['paymentId'];
        $transactionTime = $createPaymentResult['payment']['transactionTime'];

        //STEP 3
        $approvePaymentResult = approvePayment($clientId, $clientSecret, $transactionTime, $paymentId,$authCode,$subId);
        if(!isset($approvePaymentResult['code'])){
            $operationDone = false;
            $bankApiMessage = $approvePaymentResult;
            break;
        }

        break;
    }
    

    if($operationDone == true){
 
        http_response_code(201);
 
        echo json_encode(array("message" => "Transfer Completed."));
    }else{
        http_response_code(500);
 
        echo json_encode(array("message" => $bankApiMessage['error']['additionalDetails'][0]['description']));
    }
}else{
    http_response_code(400);
 
    echo json_encode(array("message" => "Unable to process transaction, wrong parameters."));
}
?>