<?php
  include 'db.php';
  session_start();
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    $username = $_SESSION["username"];
      
    $new_api_key = generateRandomString(30);
    $update_q = "UPDATE users SET `api-key` = '$new_api_key' WHERE username = '$username';";
    $res = mysqli_query($conn, $update_q);
    echo $new_api_key;
  
  }
?>