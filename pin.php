<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login.php");
}

error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once "config.php";

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER['REQUEST_METHOD'] == "POST"){
    
$username = $_SESSION["username"];
$pin = $_POST["pin"];
$sql = "SELECT pin1 FROM pinc WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $fpin = $row["pin1"];
    if(password_verify($pin, $fpin)) {
        $sended = "1111";
    $_SESSION['sended'] = $sended;
        header("location: pin2.php");
}
else{
    echo '<script type="text/javascript">
                window.onload = function () { alert("Your pin does not match. Please re-enter the correct pin."); }
            </script>';
}
}
else{
    echo '<script type="text/javascript">
    window.onload = function () { alert("Something went wrong. Please wait till we resolve the issue."); }
</script>';
}

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PIN</title>
    <link rel="stylesheet" href="style5.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div class="background">
            <div class="text">
            </div>
            <div class="box">
                <form id="foam" class="form" method="post" action="">
                    <h1>PIN</h1>
                    <input type="text" name="pin" id="pin" class="pin" placeholder="PIN" autocomplete="off" required>
                    <input type="submit" class="button" value="Submit">
                </form>
            </div>
        </div>
    </main>
</body>
</html>