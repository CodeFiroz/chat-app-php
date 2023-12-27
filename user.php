<?php

session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "msg";

$con = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['type'])) {
    $name = $_POST['name'];
    setcookie("user", $name, time() + 3600 * 24, "/");
    echo 200;
}

if (isset($_POST['action'])) {

    if (isset($_COOKIE['user'])) {
        $user = $_COOKIE['user'];
        $msg = $_POST['msg'];

        $sql = "INSERT INTO `msg`(`user`, `msg`) VALUES ('$user','$msg')";
        $query = mysqli_query($con, $sql);

        if ($query) {
            echo 200;
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "User cookie not set.";
    }
}


?>
