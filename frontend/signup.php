<?php
$showError = false;
$exists = false;
$invalid = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '../backend/db.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $q = "SELECT * FROM users WHERE username = '$username';";
    $res = mysqli_query($conn, $q);
    $user = mysqli_fetch_all($res,MYSQLI_ASSOC);
    if(count($user) > 0){
      $exists = true;
    }
    else if(!(preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password)) || strlen( $password) < 8){
      $invalid = true;
    }
    else if(($password == $cpassword) && !$exists){
        $p = password_hash($password, PASSWORD_DEFAULT);
        $apikey = generateRandomString(30);

        $sql = "INSERT INTO `users` ( `username`, `password`, `api-key`) VALUES ('$username', '$p', '$apikey')";
        $result = mysqli_query($conn, $sql);
        if ($result){
          header("Location: /automation_test/frontend/login.php?signup=success");  
        }
    }
    else{
        $showError = true;
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script> -->
    <?php
      if($exists){
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> This Username already exists
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
      else if($showError){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Passwords do not match
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>';
      }
    ?>
    <div class="container my-5 d-flex justify-content-center">
        <form action="/automation_test/frontend/signup.php" method="post">
            <h3>Sign up to Test Automation</h1><br>
                <!-- Email input -->
                <div class="form-outline">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" />
                </div>

                <!-- Password input -->
                <div class="form-outline">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" />
                </div>

                <!-- Confirm Password input -->
                <div class="form-outline">
                    <label class="form-label" for="cpassword">Confirm Password</label>
                    <input type="password" name="cpassword" id="cpassword" class="form-control" />
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="">
                    <p>Already signed up? <a href="/automation_test/frontend/login.php">Login</a></p>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Sign up</button>

                <!-- Register buttons -->

        </form>
    </div>
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