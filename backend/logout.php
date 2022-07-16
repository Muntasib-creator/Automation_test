<?php
  include 'db.php';
  if($conn->connect_error){
      die("DB Connection Failed " . $conn->connect_error);
  }
  session_start();
  $username = $_SESSION["username"];
  session_unset();
  $sql = "UPDATE users SET loggedin = 'false' WHERE username = '$username';";
  $result = mysqli_query($conn, $sql);
  if ($result){
    header("Location: /automation_test/frontend/login.php");
  }
?>