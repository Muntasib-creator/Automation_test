<?php 
    include 'db.php';
    if($conn->connect_error){
        die("DB Connection Failed " . $conn->connect_error);
    }
    $username =  $_GET["username"];
    $status_q = "SELECT * FROM users WHERE username = '$username';";
    $res = mysqli_query($conn, $status_q);
    $user = mysqli_fetch_all($res,MYSQLI_ASSOC)[0];
    if($user["run_status"]!="no"){
        $tc_id = explode("_", $user["run_status"])[1];
        $fetch_q = "SELECT * FROM actions WHERE tc_id = '$tc_id' ORDER BY `actions`.`action_seq` ASC";
        $res = mysqli_query($conn, $fetch_q);
        $res = mysqli_fetch_all($res,MYSQLI_ASSOC);
        $response = [
            "run_status" => $user["run_status"],
            "data" => $res,
        ];
        echo json_encode($response);
        $update_q = "UPDATE users SET run_status = 'no' WHERE username = '$username';";
        $res = mysqli_query($conn, $update_q);
    }
    else{
        $response = [
            "run_status" => "no",
        ];
        echo json_encode($response);

    }




?>