<?php 
    include 'db.php';
    if($conn->connect_error){
        die("DB Connection Failed " . $conn->connect_error);
    }
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        exit;
    }
    $username = $_SESSION["username"]; 
    
    $update_q = "DELETE FROM users WHERE username = '$username';";
    $res = mysqli_query($conn, $update_q);
    session_unset();
?>