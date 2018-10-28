<?php
session_start();
//session_unset();
//session_destroy();

include 'api/functions/createSubscription.php';

$clientId = "d4cdc1e7-1dfc-4467-948e-58e30d3fa811";
$clientSecret = "fC2yX7rD4hD1vY3wR7aY2lF6uG1aC0dT8pI3kD7oC4jW4bL8iU";

if(!isset($_SESSION['initialToken']) || !isset($_SESSION['initialSubId'])){
    //STEP ONE
    $authCodeResult = getAuthCode($clientId, $clientSecret);

    $_SESSION['initialToken'] = $authCodeResult['access_token'];

    //STEP TWO
    $createSubscriptionResult = createSubscription($_SESSION['initialToken'],$clientId, $clientSecret);

    $_SESSION['initialSubId'] = $createSubscriptionResult['subscriptionId'];

    //STEP THREE
    echo '<a href="'.createRedirection('http://koumbaras.knowledgedesire.com',$clientId,$_SESSION['initialSubId']).'">Go to 1 Bank</a>';


}else if(!isset($_SESSION['didSecondAuth'])){
    //Enter code from url here //use get here
    $urlCode = 'AALV7A7_D11UjN8YFujoNQMycRLphBD8mYO1C9DoGTv-O_KdrmfdEfsgePePPgO4KjNTIwLD0v13dhLQtDET5Z7LV9TV3ujOL6xQkfEEOojupQ';

    $authenticateUrlResult = authenticateUrlCode($clientId,$clientSecret,$urlCode);

    $secondAccessToken = $authenticateUrlResult['access_token'];
    $_SESSION['didSecondAuth']  = $secondAccessToken;
}

if(isset($_SESSION['didSecondAuth'])){

    $retrievedSubscription = retrieveSubscription($_SESSION['initialSubId'],$clientId,$clientSecret,$_SESSION['initialToken']);
    
    $selectedAccounts = $retrievedSubscription[0]['selectedAccounts'];
    $payments = $retrievedSubscription[0]['payments'];
    $accounts = $retrievedSubscription[0]['accounts'];
    
    $postBody = json_encode(array("selectedAccounts"=>$selectedAccounts,"payments"=>$payments,"accounts"=>$accounts));
    
    $patchResult =  patchSubscription($_SESSION['initialSubId'],$clientId,$clientSecret,$_SESSION['didSecondAuth'],$postBody);

    if(isset($patchResult['status']) && $patchResult['status']  == 'ACTV'){
        echo 'Activated';
        echo $_SESSION['initialToken'] . '<br>';
        echo $_SESSION['initialSubId'];
    }else{
        echo $_SESSION['initialToken'] . '<br>';
        echo $_SESSION['initialSubId'];
    }
}

