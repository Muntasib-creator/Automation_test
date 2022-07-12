<?php 
    include 'db.php';
    if($conn->connect_error){
        die("DB Connection Failed " . $conn->connect_error);
    }
    echo "DB connected";
    $tc_id =  $_GET["tc_id"];
    echo $_GET["query"];
    $query = $_GET["query"];
    $query = json_decode($query);
    $del_q = "DELETE FROM actions WHERE tc_id = '$tc_id';";
    $res = mysqli_query($conn, $del_q);
    echo $res;
    $save_q = "INSERT INTO actions (`id`, `tc_id`, `action_seq`, `action_name`, `action_disable`, `row_seq`, `field`, `sub_field`, `value`) VALUES";
    for($i=0;$i<count($query);$i++){
        $row_q = " (NULL, ";
        for($j=1;$j<count($query[$i]);$j++){
            $row_q = $row_q . "'" . $query[$i][$j] . "',";
        }
        $row_q = substr($row_q, 0, -1) . "),";
        $save_q = $save_q . $row_q;
    }
    $save_q = substr($save_q, 0, -1) . " ;";
    echo "<br>" . $save_q;
    $res = mysqli_query($conn, $save_q);
    echo $res;

    // header("Location: http://localhost/automation_test/fetch_actions.php?id=$tc_id");  

?>