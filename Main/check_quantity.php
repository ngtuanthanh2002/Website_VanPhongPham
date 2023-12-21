<?php
    require_once './connect/connect.php';
    $id = $_GET['id'];

    $stringSQL = "SELECT * FROM `chitiet_sanpham` WHERE `ma_thuoctinh` = '$id'";
    $result = mysqli_query($connect, $stringSQL);
    $each = mysqli_fetch_array($result);
    die($each['soluong']);

    if ($each['soluong'] > 0) {
        echo json_encode($each['soluong']);
    } else {
        echo json_encode(0);
    }
