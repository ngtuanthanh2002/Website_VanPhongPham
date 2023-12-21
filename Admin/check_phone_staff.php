<?php
    require_once './ShareAdmin/root/connect.php';
    $phone = $_GET['phone'];

    $stringSQL = "";
    $stringSQL = "SELECT COUNT(*) FROM `accounts` WHERE `phone` = '$phone'";

    $result = mysqli_query($connect, $stringSQL);
    $number_of_rows = mysqli_fetch_array($result)['COUNT(*)'];

    if ($number_of_rows > 0) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
