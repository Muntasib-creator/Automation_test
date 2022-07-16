<?php 
    include 'db.php';
    if($conn->connect_error){
        die("DB Connection Failed " . $conn->connect_error);
    }

    $list_id = json_decode($_GET["tc_id"]);
    $run_status = $_GET["run_status"];
    $run_status = $run_status . '_' . json_encode($list_id);
    $user = "admin";
    $update_q = "UPDATE users SET run_status = '$run_status' WHERE username = '$user';";
    $res = mysqli_query($conn, $update_q);
?>