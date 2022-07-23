<?php 
    include 'db.php';
    if($conn->connect_error){
        die("DB Connection Failed " . $conn->connect_error);
    }
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["api-key"]) && isset($_POST["username"])){
        $username =  $_POST["username"];
        $api_key =  $_POST["api-key"];
        $q = "SELECT * FROM `users` WHERE username = '$username' AND `api-key` = '$api_key';";
        $res = mysqli_query($conn, $q);
        $users = mysqli_fetch_all($res,MYSQLI_ASSOC);
        if(count($users) == 0){
            echo '{"res":"User and api-key did not match"}';
        }
        else if($users[0]["loggedin"]== "false"){
            echo '{"res":"You are not logged into the server"}';
        }
        else{
            echo '{"res":"Loggin Successful"}';
        }
    }
?>