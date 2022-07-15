<?php 
    include 'db.php';
    if($conn->connect_error){
        die("DB Connection Failed " . $conn->connect_error);
    }
    echo "DB connected";
    $tc_id = $_GET["id"];
    $q1 = "SELECT * FROM actions WHERE tc_id = '$tc_id' ORDER BY `actions`.`action_seq` ASC";
    $res = mysqli_query($conn, $q1);
    $list_of_actions = mysqli_fetch_all($res,MYSQLI_ASSOC);
    var_dump($list_of_actions);
    $list_of_actions = json_encode($list_of_actions);
    header("Location: /automation_test/frontend/view_testcase.html?data=$list_of_actions&tc_id=$tc_id");  
?>