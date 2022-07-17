<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <?php
        include 'nav.php';
        if($conn->connect_error){
            die("DB Connection Failed " . $conn->connect_error);
        }
        if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
            header("location: login.php");
            exit;
        }
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if($_POST["task"] == "delete"){
                $del = $_POST["tc_id"];
                $q1 = "DELETE FROM testcases WHERE `testcases`.`id` = $del";
                $res = mysqli_query($conn,$q1);
            }
            else if($_POST["task"] == "create"){
                $tc_name = $_POST["tc_name"];
                $tc_obj = $_POST["tc_obj"];
                $q1 = "INSERT INTO `testcases` (`tc_name`, `tc_obj`, `tc_creation_date`) VALUES ('$tc_name', '$tc_obj', current_timestamp());";
                $res = mysqli_query($conn,$q1);
            }
        }
        $q1 = "select * from testcases";
        $q2 = "SELECT `id`, `tc_name`, `tc_obj`, `tc_screation_date`, `table_link` FROM `test_automation`.`testcases`";
        $res = mysqli_query($conn, $q1);
        $list_of_tc = mysqli_fetch_all($res,MYSQLI_ASSOC);
    ?>
    <div class="container my-5 d-flex justify-content-center">
        <form action="/automation_test/backend/create_tc.php" method="GET">
            <input class="form-control my-1" name="tc_name" type="text" placeholder="Enter Testcase name">
            <input class="form-control my-1" name="tc_obj" type="text" placeholder="Write testcase objective">
            <input type="hidden" name="task" value="create">
            <input class="btn btn-outline-primary" type="submit" value="Save" class="d-flex justify-content-center">
        </form>
    </div>
    <!-- <button  class="btn btn-outline-success" style="float:right" id="run">Run</button> -->
    <table class="table table-striped" style="table-layout:fixed">
        <thead class="table-light">
            <th><button  class="btn btn-outline-success" id="run">Run</button></th>
            <th>ID</th>
            <th>Title</th>
            <th width="30%">Objective</th>
            <th>Result</th>
            <th>Duration</th>
            <th><input class="form-check-input" type="checkbox" id="select_all"></th>
        </thead>
        <tbody>
            <?php foreach($list_of_tc as $each): ?>
            <tr>
                <td>
                    <div>
                        <form action="/automation_test/frontend/home.php" name="delete_form"
                            onsubmit="return confirm('Do you want to delete testcase?')" method="POST">
                            <input type="hidden" name="tc_id" value="<?php echo $each["id"];?>">
                            <input type="hidden" name="task" value="delete">
                            <input class="btn btn-outline-danger" type="submit" value="Delete" name="any">
                        </form>
                    </div>
                </td>
                <td><a
                        href="http://localhost/automation_test/frontend/view_testcase.php?id=<?php echo "".$each["id"];?>"><?php echo "TEST-".$each["id"];?></a>
                </td>
                <td><?php echo $each["tc_name"];?><br></td>
                <td><?php echo $each["tc_obj"];?><br></td>
                <td><?php echo $each["tc_result"];?><br></td>
                <td><?php echo $each["tc_duration"];?><br></td>
                <td><input class="form-check-input" type="checkbox" id="select" tc_id="<?php echo $each['id'];?>"><br></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        
    </table>
</body>

</html>
<script>
action_container = document.getElementsByTagName("body")[0];
action_container.addEventListener("click", task);

function task(e) {
    // console.log(e.target);
    if (e.target.tagName == "BUTTON" && e.target.getAttribute("id") == "run") {
        inputs = document.getElementsByTagName("input");
        checkboxes = []
        for (i = 0; i < inputs.length; i++) {
            if (inputs[i].getAttribute("id") == "select" && inputs[i].checked) {
                checkboxes.push(parseInt(inputs[i].getAttribute("tc_id")));
            }
        }
        url =
            `http://localhost/automation_test/backend/debug_run.php?tc_id=${JSON.stringify(checkboxes)}&run_status=run`;
        // window.location = url;
        fetch(url);

    } else if (e.target.tagName == "INPUT" && e.target.getAttribute("id") == "select_all") {
        inputs = document.getElementsByTagName("input");
        // console.log(inputs)
        for (i = 0; i < inputs.length; i++) {
            if (inputs[i].getAttribute("id") == "select") {
                inputs[i].checked = e.target.checked;
            }
        }
    }
}
</script>