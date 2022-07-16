<?php 
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: login.php");
        exit;
    }
    include 'db.php';
    if($conn->connect_error){
        die("DB Connection Failed " . $conn->connect_error);
    }
    $report =  json_decode($_GET["report"]);
    $response = ["res"=>"ok"];
    for($i=0;$i<count($report);$i++){
        $r = $report[$i][1];
        $d = $report[$i][2];
        $id = $report[$i][0];
        $update_q = "UPDATE testcases SET tc_result = '$r', tc_duration = '$d' WHERE id = '$id';";
        // print_r($update_q);
        $res = mysqli_query($conn, $update_q);
        // print_r($res);
        if($res!=1){
            $response["res"] = "error";
            // $p = password_hash("admin", PASSWORD_DEFAULT);
            // $p = md5("admin");
            // echo '<br>'.$p.'<br>';
            // var_dump($p);
            // echo password_verify("admin", $p);
        }
    }
    echo json_encode($response);

?>