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
        $action_q = "SELECT * FROM actions WHERE tc_id = '$tc_id' ORDER BY `actions`.`action_seq` ASC";
        $res = mysqli_query($conn, $action_q);
        $action_res = mysqli_fetch_all($res,MYSQLI_ASSOC);
        $tc_q = "SELECT * FROM testcases WHERE id = '$tc_id'";
        $tc_res = mysqli_query($conn, $tc_q);
        $tc_res = mysqli_fetch_all($tc_res,MYSQLI_ASSOC)[0];


        $response = [
            "run_status" => $user["run_status"],
            "action_data" => $action_res,
            "tc_data" => $tc_res,
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