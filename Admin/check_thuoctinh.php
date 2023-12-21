<?php
    require_once './ShareAdmin/root/connect.php';
    $ten_thuoctinh = $_GET['ten_thuoctinh'];

    $stringSQL = "SELECT COUNT(*) FROM `chitiet_sanpham` ctsp INNER JOIN `thuoctinh` tt ON ctsp.`ma_thuoctinh` = tt.`ma_thuoctinh` WHERE `ten_thuoctinhcon` = '$ten_thuoctinh'";
    $result = mysqli_query($connect, $stringSQL);
    $number_of_rows = mysqli_fetch_array($result)['COUNT(*)'];

    if ($number_of_rows > 0) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
