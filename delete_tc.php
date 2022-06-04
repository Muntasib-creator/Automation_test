<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
    // $(document).ready(function() {
    //     console.log("ready!");
    // });
    console.log("test")
    c = confirm("Press a button!");
    console.log(c)
    if (c == false) {
        console.log("dhukse")
        window.location.replace("site.php");
    }
    </script>
</head>

<body>


</body>

</html>
<?php
    include 'db.php';
    function delete_tc() {
        global $conn;
        $del = array_keys($_GET)[0];
        echo var_dump($del);
        echo('<script>c = confirm("Press a button!");if(c == false){window.location.replace("site.php");}</script>');
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
<script>
window.location.replace("site.php");
</script>