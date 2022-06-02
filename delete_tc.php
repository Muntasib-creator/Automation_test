<?php
    include 'db.php';
    function delete_tc() {
        global $conn;
        $del = array_keys($_GET)[0];
        echo var_dump($del);
        $q1 = "DELETE FROM testcases WHERE `testcases`.`id` = $del";
        $res = mysqli_query($conn,$q1);
        // $a = mysqli_fetch_all($res,MYSQLI_ASSOC);
        // echo var_dump($a);
    }
    delete_tc();
    // fopen('');http://localhost/php_learn/site.php?tc_name=dashboard&tc_obj=to+test+dashboard
    // header("Location: site.php");
    // return file_get_contents('http://localhost/php_learn/site.php');
?>