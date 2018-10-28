<?php
     session_start(); 

    include("dblogin.php"); 

    
    if(isset($_POST['submit'])){ 
        
        $chooseGoal=mysqli_real_escape_string($conn, $_POST['choose-goal']);
        $userId = $_SESSION['id'];
        $savingGoal= mysqli_real_escape_string($conn, $_POST['saving-goal']);
        $endDatee= mysqli_real_escape_string($conn, $_POST['end-date']);
        $sourceAccount= mysqli_real_escape_string($conn, $_POST['source-acount']);
        $destinationAccount= mysqli_real_escape_string($conn, $_POST['destination-acount']);
        $dailySavings= mysqli_real_escape_string($conn, $_POST['daily-savings']); 
        
        
        $query = "INSERT INTO saving_plans (user_id, price_goal, goal_name, end_date, source_accountId, destination_accountId,daily_saving)
                VALUES ('$userId','$savingGoal','$chooseGoal','$endDatee','$sourceAccount','$destinationAccount','$dailySavings')";

        if (mysqli_query($conn, $query)) {
            header ('Location: dashboard.php');
       
        } 
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
        exit();
    } 
    else {
        echo 'form not submited!';
    }
?>