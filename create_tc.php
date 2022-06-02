<?php
    include 'db.php';
    function create_tc() {
        global $conn;
        $tc_name = $_GET["tc_name"];
        $tc_obj = $_GET["tc_obj"];
        $q1 = "INSERT INTO `testcases` (`tc_name`, `tc_obj`, `tc_creation_date`) VALUES ('$tc_name', '$tc_obj', current_timestamp());";
        $res = mysqli_query($conn,$q1);
        $a = mysqli_fetch_all($res,MYSQLI_ASSOC);
        echo var_dump($a);
    }
    create_tc();
    // fopen('');http://localhost/php_learn/site.php?tc_name=dashboard&tc_obj=to+test+dashboard
    header("Location: site.php");
    // return file_get_contents('http://localhost/php_learn/site.php');
?>