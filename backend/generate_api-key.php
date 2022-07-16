<?php
  session_start();
  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
      header("location: login.php");
      exit;
  }
  session_start();
  $_SESSION['loggedin'] = false;
  header("Location: /automation_test/frontend/login.php?signup=success");
?>