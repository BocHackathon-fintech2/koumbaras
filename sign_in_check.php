<?php
    include("functions.php"); 
    include("dblogin.php"); 
    include("api/functions/createSubscription.php");

    $url = "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/token";
    $client_id = "d4cdc1e7-1dfc-4467-948e-58e30d3fa811";
    $client_secret = "fC2yX7rD4hD1vY3wR7aY2lF6uG1aC0dT8pI3kD7oC4jW4bL8iU";


    if(isset($_POST['submit-btn'])){ 
        
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
        $sql="SELECT * FROM information";
        
        $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
        
        while($row = mysqli_fetch_array($result)){
        
            if($username==$row['user_name'] && $password==$row['user_password']){
            
                $_SESSION['id'] = $row['user_id'];
                $_SESSION['name'] = $row['user_name'];
                $_SESSION['subId'] = $row['subscription_id'];
                $_SESSION['client_id'] = "d4cdc1e7-1dfc-4467-948e-58e30d3fa811";
                $_SESSION['client_secret'] = "fC2yX7rD4hD1vY3wR7aY2lF6uG1aC0dT8pI3kD7oC4jW4bL8iU";
         
                    //An den exei sub id o user pare ton na kami auth stin 1bank
                if($row['subscription_id']=='null'){
                    
                    
                    //save initial tocken
                    $authCodeResult = getAuthCode($client_id, $client_secret);
                    $_SESSION['initialToken'] = $authCodeResult['access_token'];

                    //Get subId
                    $createSubscriptionResult = createSubscription($_SESSION['initialToken'],$client_id, $client_secret);
                    $_SESSION['subId'] = $createSubscriptionResult['subscriptionId'];
                    
                   
                    header ('Location: after-login.php');
                    
                    
                }
                else{
                     //save initial tocken
                     $authCodeResult = getAuthCode($client_id, $client_secret);
                     $_SESSION['initialToken'] = $authCodeResult['access_token'];

                    //O user exi sub id
                    header ('Location: after.php');
 
                }
                
        
            }
        }
           
      echo "<script>alert('Incorrect Username or Password');
        window.location.href='index.php';
      </script>";
   
}
else{
echo'Unable to log in.';
}
           
?>
