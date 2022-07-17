<?php
  include '../backend/db.php';
  session_start();
  $username = $_SESSION["username"];
  $q = "SELECT * FROM users WHERE username = '$username';";
  $res = mysqli_query($conn, $q);
  $user = mysqli_fetch_all($res,MYSQLI_ASSOC);
  $api_key = $user[0]["api-key"];
  function p_generate($username, $conn){
    $new_api_key = generateRandomString(30);
    $update_q = "UPDATE users SET `api-key` = '$new_api_key' WHERE username = '$username';";
    $res = mysqli_query($conn, $update_q);
    return $new_api_key;
}
?>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/automation_test/frontend/home.php">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <button class="btn btn-outline-success" id="generate">Generate API-key</button>
                </li>
                <li class="nav-item">
                    <p class="my-2 mx-2">api-key:</p>
                </li>
                <li class="nav-item">
                    <p class="my-2" id="api-key"><?php echo $api_key;?></p>
                </li>
            </ul>
            <a class="btn btn-outline-danger" href="/automation_test/backend/logout.php">Logout</a>

        </div>
    </div>
</nav>
<script>
el = document.getElementById("generate");
el.addEventListener("click", display_api_key);

function display_api_key(e) {
    if (e.target.tagName == "BUTTON" && e.target.getAttribute("id") == "generate") {
        console.log("dhukse");
        document.getElementById("api-key").innerText =
            '<?php echo p_generate($username, $conn); ?>' //JSON.parse('"hello"');
    }
}
</script>