<?php
    session_start();
    require_once './ShareAdmin/root/connect.php';

    $id = $_GET['id'];
    $stringSQL = "DELETE FROM `thuoctinh` WHERE `ma_thuoctinh` = '$id'";
    $result = mysqli_query($connect, $stringSQL);

    $stringSQL = "DELETE FROM `thuoctinh` WHERE `ten_thuoctinhcha` = '$id'";
    $resultChild = mysqli_query($connect, $stringSQL);

    if ($result) {
        $_SESSION['toast-success'] = "Xoá thuộc tính thành công!";
    } else {
        $_SESSION['toast-error'] = "Xoá thuộc tính thất bại!";
    }
    header("Location: ProductProperties.php");