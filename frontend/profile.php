<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
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
        $showError = false;
        $matched = true;
        $success = false;
        $changed = true;
        $invalid = false;

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $username = $_SESSION["username"];
            $cur_password = $_POST["cur_password"];
            $npassword = $_POST["npassword"];
            $cpassword = $_POST["cpassword"];
            $q = "SELECT * FROM users WHERE username = '$username';";
            $res = mysqli_query($conn, $q);
            $user = mysqli_fetch_all($res,MYSQLI_ASSOC);
            if(count($user) == 0 || !password_verify($cur_password, $user[0]["password"])){
                $showError = true;
            }
            else if(!(preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password)) || strlen( $password) < 8){
                $invalid = true;
            }                 
            else if($npassword == $cur_password){
                $changed = false;
            }
            else if($npassword != $cpassword){
                $matched = false;
            }
            else{
                $p = password_hash($npassword, PASSWORD_DEFAULT);
                $q = "UPDATE users SET `password` = '$p' WHERE `username`='$username';";
                $res = mysqli_query($conn, $q);
                if($res){
                    $success = true;
                }
            }
        }
        if($showError){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> Current Password did not match
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>';
        }
        else if($invalid){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Passwords must contain Numbers and Letters and should be of atleast 8 characters
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>';
        }
        else if(!$changed){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> Current password cant be the New password cant 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>';
        }
        else if(!$matched){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> Confirm Password did not match
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>';
        }
        else if($success){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Password changed successfully
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>';
        }
    ?>
    <div class="container my-5 d-flex justify-content-center">
        <form action="/automation_test/frontend/profile.php" method="post">
            <h3>Want to change password?</h1><br>
                <!-- Email input -->
                <div class="form-outline">
                    <label class="form-label" for="cur_password">Current Password</label>
                    <input type="text" name="cur_password" id="cur_password" class="form-control" />
                </div>

                <!-- Password input -->
                <div class="form-outline">
                    <label class="form-label" for="npassword">New Password</label>
                    <input type="password" name="npassword" id="npassword" class="form-control" />
                </div>

                <!-- Confirm Password input -->
                <div class="form-outline">
                    <label class="form-label" for="cpassword">Confirm Password</label>
                    <input type="password" name="cpassword" id="cpassword" class="form-control" />
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block my-4">Change Password</button>
                <button type="button" class="btn btn-danger btn-block my-4" id="remove">Delete Account</button>

                <!-- Register buttons -->

        </form>
    </div>
    <script>
        document.getElementById("remove").addEventListener("click", _fetch);
        function _fetch(){
            if(confirm("Are you sure, you want to delete your account permanently?")){
                fetch("/automation_test/backend/remove_profile.php", {method: 'POST'})
                url = `/automation_test/frontend/login.php`;
                // url = `/automation_test/backend/remove_profile.php`;
                window.location = url;
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
<!-- Pills content -->