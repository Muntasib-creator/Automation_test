<?php
    include 'db.php';
    // include 'create_tc.php';

// $conn = mysqli_connect($host,$user,$password,$db);
if($conn->connect_error){
    die("DB Connection Failed " . $conn->connect_error);
}
// echo "DB connected";
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
</head>

<body>

    <form action="create_tc.php" method="GET">
        <input name="tc_name" type="text" placeholder="Enter Testcase name"><br>
        <input name="tc_obj" type="text" placeholder="Write testcase objective"><br>
        <input type="submit" value="Save">
    </form>
    <button style="float:right" id="run">Run</button>
    <table>
        <thead>
            <th></th>
            <th>ID</th>
            <th>Title</th>
            <th>Objective</th>
            <th>Result</th>
            <th>Duration</th>
            <th><input type="checkbox" id="select_all"></th>
        </thead>
        <?php foreach($list_of_tc as $each): ?>
        <tr>
            <td>
                <div>
                    <form action="delete_tc.php" name="delete_form"
                        onsubmit="return confirm('Do you want to delete testcase?')" method="GET">
                        <input type="submit" value="Delete" name="<?php echo $each["id"];?>"
                            tc_id="<?php echo $each["id"];?>">
                    </form>
                </div>
            </td>
            <!-- <td><a href="view_testcase.php?id=<?php echo "".$each["id"];?>"><?php echo "TEST-".$each["id"];?></a></td> -->
            <td><a
                    href="http://localhost/automation_test/fetch_actions.php?id=<?php echo "".$each["id"];?>"><?php echo "TEST-".$each["id"];?></a>
            </td>
            <td><?php echo $each["tc_name"];?><br></td>
            <td><?php echo $each["tc_obj"];?><br></td>
            <td><?php echo $each["tc_result"];?><br></td>
            <td><?php echo $each["tc_duration"];?><br></td>
            <td><input type="checkbox" id="select" tc_id="<?php echo $each['id'];?>"><br></td>
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
<script>
    action_container = document.getElementsByTagName("body")[0];
    action_container.addEventListener("click", task);
    function task(e) {
        if(e.target.tagName == "BUTTON" && e.target.getAttribute("id") == "run"){
            inputs = document.getElementsByTagName("input");
            checkboxes = []
            for(i=0;i<inputs.length;i++){
                if(inputs[i].getAttribute("id") == "select" && inputs[i].checked){
                    checkboxes.push(parseInt(inputs[i].getAttribute("tc_id")));
                }
            }
            url = `http://localhost/automation_test/debug_run.php?tc_id=${JSON.stringify(checkboxes)}&run_status=run`;
            window.location = url;
        }
        else if(e.target.tagName == "INPUT" && e.target.getAttribute("id") == "select_all"){
            inputs = document.getElementsByTagName("input");
            // console.log(inputs)
            for(i=0;i<inputs.length;i++){
                if(inputs[i].getAttribute("id") == "select"){
                    inputs[i].checked = e.target.checked;
                }
            }
        }
    }
</script>