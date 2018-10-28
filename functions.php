<?php
session_start();

function getClientCredentials($url,$client_id,$client_secret){
   $curl = curl_init();

    
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "client_id=".$client_id."&client_secret=".$client_secret."&grant_type=client_credentials&scope=TPPOAuth2Security",
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/x-www-form-urlencoded"
      ),
    ));

    $response = curl_exec($curl);
    
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      $response = json_decode($response,true);
    }
    
    return $response['access_token'];
}
    
    /*$sql = "INSERT INTO information (subscription_id)
    VALUES 
    ('$response['access_token']')";
   
        if (mysqli_query($conn, $sql)) {
           
    
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    */
    
    
    function setSubId($client_id,$client_secret,$oauth_Code,$conn){
        $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/v1/subscriptions?client_id=".$client_id."&client_secret=" .$client_secret."",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\r\n \"accounts\": {\r\n    \"transactionHistory\": true,\r\n    \"balance\": true,\r\n    \"details\": true,\r\n    \"checkFundsAvailability\": true\r\n  },\r\n  \"payments\": {\r\n    \"limit\": 99999999,\r\n    \"currency\": \"EUR\",\r\n    \"amount\": 999999999\r\n  }\r\n}",
      CURLOPT_HTTPHEADER => array(
        "APIm-Debug-Trans-Id: true",
        "Authorization: Bearer ".$oauth_Code."",
        "Content-Type: application/json",
        "app_name: myapp",
        "journeyId: abc",
        "originUserId: 50520218",
        "timeStamp: {{a}}",
        "tppid: singpaymentdata"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      $response = json_decode($response,true);
    }
    
    $test =$response['subscriptionId'];
                
        $sql="UPDATE information SET subscription_id ='$test' WHERE user_id = ". $_SESSION['id']."";
        $_SESSION['subId'] = $test;
        
        if (mysqli_query($conn, $sql)) {
            //ola ok
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
}

?>
