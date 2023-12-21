<?php
    require_once './ShareAdmin/root/connect.php';
    $ten_thuoctinh = $_GET['ten_thuoctinh'];

    $stringSQL = "";
    if (isset($_GET['id'])) {
        $stringSQL = "SELECT COUNT(*) FROM `thuoctinh` WHERE `ten_thuoctinhcha` = '$ten_thuoctinh' AND `id` != '". $_GET['id'] . "'";
    } else {
        $stringSQL = "SELECT COUNT(*) FROM `thuoctinh` WHERE `ten_thuoctinhcha` = '$ten_thuoctinh'";
    }

    $result = mysqli_query($connect, $stringSQL);
    $number_of_rows = mysqli_fetch_array($result)['COUNT(*)'];

    if ($number_of_rows > 0) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
