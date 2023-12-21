<?php
    session_start();
    require_once './ShareAdmin/root/connect.php';
    $id = $_GET['id'];
    
    $stringSQL = "DELETE FROM `sanpham` WHERE `ma_sanpham` = '$id'";
    $result = mysqli_query($connect, $stringSQL);

    $stringSQL = "DELETE FROM `chitiet_sanpham` WHERE `ma_sanpham` = '$id'";
    $result = mysqli_query($connect, $stringSQL);

    if ($result) {
        $_SESSION['toast-success'] = "Xoá thành công";
    } else {
        $_SESSION['toast-error'] = "Xoá thất bại";
    }
    header("Location: ProductCategory.php");