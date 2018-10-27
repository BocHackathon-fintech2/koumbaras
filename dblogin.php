<?php
   
$host="localhost"; // Host name
$username="knowlez7_koumb"; // Mysql username
$password="spacecompilers135"; // Mysql password
$db_name="knowlez7_koumbaras"; // Database name
    // Connection to database with the required information   
$conn = mysqli_connect("$host", "$username", "$password", "$db_name");

if (!$conn) {
    die ("Connection failed: " . mysqli_connect_error());
}
    
?>
