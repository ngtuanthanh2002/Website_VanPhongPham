<?php
    session_start();
    require_once './ShareAdmin/root/connect.php';
    $id = $_GET['id'];
    $idProduct = $_GET['idProduct'];
    
    $stringSQL = "DELETE FROM `chitiet_sanpham` WHERE `id` = '$id'";
    $result = mysqli_query($connect, $stringSQL);

    if ($result) {
        $_SESSION['toast-success'] = "Xoá thành công";
    } else {
        $_SESSION['toast-error'] = "Xoá thất bại";
    }
    header("Location: EditProduct.php?id=$idProduct");