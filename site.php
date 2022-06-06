<?php
    include 'db.php';
    // include 'create_tc.php';

// $conn = mysqli_connect($host,$user,$password,$db);
if($conn->connect_error){
    die("DB Connection Failed " . $conn->connect_error);
}
echo "DB connected";
// $q = "insert into table(Name,Gender) values ('$name','$gender')";
// mysqli_query($conn,$q);
$q1 = "select * from testcases";
$q2 = "SELECT `id`, `tc_name`, `tc_obj`, `tc_creation_date`, `table_link` FROM `test_automation`.`testcases`";
$res = mysqli_query($conn, $q1);
$list_of_tc = mysqli_fetch_all($res,MYSQLI_ASSOC);

// echo var_dump($list_of_tc);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Automation</title>
    <script>
    function confirmBox() {
        // let x = document.forms["delete_form"]["del_button"].tc_id;
        // console.log(x)
        a = confirm("Do you want to delete testcase?")
        if (a == true) {
            console.log("test case will be deleted");
        } else {
            console.log("test case wont be deleted");
        }
        return a;
    }
    </script>
</head>

<body>

    <form action="create_tc.php" method="GET">
        <input name="tc_name" type="text" placeholder="Enter Testcase name"><br>
        <input name="tc_obj" type="text" placeholder="Write testcase bjective"><br>
        <input type="submit" value="Save">
    </form>
    <table>
        <?php foreach($list_of_tc as $each): ?>
        <tr>
            <td>
                <div>
                    <form action="delete_tc.php" name="delete_form" onsubmit="return confirmBox()" method="GET">
                        <input type="submit" value="Delete" name="<?php echo $each["id"];?>"
                            tc_id="<?php echo $each["id"];?>">
                    </form>
                </div>
            </td>
            <td><a href=""><?php echo "TEST-".$each["id"];?></a></td>
            <td><a href=""><?php echo $each["tc_name"];?></a><br></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h3>
        <?php 
        // echo create_tc();
        ?>
    </h3>


</body>

</html>
<?php  ?>