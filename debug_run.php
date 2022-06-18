<?php 
    include 'db.php';
    if($conn->connect_error){
        die("DB Connection Failed " . $conn->connect_error);
    }
    echo "DB connected";
    $tc_id =  $_GET["tc_id"];
    $run_status = $_GET["run_status"];
    $run_status = $run_status . '_' . $tc_id;
    $user = "admin";
    $update_q = "UPDATE users SET run_status = '$run_status' WHERE username = '$user';";
    echo $update_q;
    $res = mysqli_query($conn, $update_q);
    echo $res;

    header("Location: http://localhost/automation_test/fetch_actions.php?id=$tc_id");  

?>