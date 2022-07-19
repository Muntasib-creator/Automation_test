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
            echo '{"res":"login fail"}';
            exit;
        }
        else if($users[0]["loggedin"]== "false"){
            echo '{"res":"You are not logged into the server"}';
            exit;
        }
    }
    else{
        exit;
    }
    $report =  json_decode($_POST["report"]);
    $response = ["res"=>"ok"];
    for($i=0;$i<count($report);$i++){
        $r = $report[$i][1];
        $d = $report[$i][2];
        $id = $report[$i][0];
        $update_q = "UPDATE testcases SET tc_result = '$r', tc_duration = '$d' WHERE id = '$id';";
        $res = mysqli_query($conn, $update_q);
        if($res!=1){
            $response["res"] = "error";
        }
    }
    echo json_encode($response);

?>