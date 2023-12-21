<?php
    session_start();
    if (!isset($_SESSION['admin'])) {
        header("location: ./Login.php");
    }

    require_once './ShareAdmin/root/connect.php';
    $id = $_GET['id'];
    
    $stringSQL = "UPDATE `hoadon` SET `trangthai`= 1 WHERE `ma_hoadon` = '$id'";
    $result = mysqli_query($connect, $stringSQL);

    if ($result) {
        $_SESSION['toast-success'] = "Duyệt đơn hàng thành công!";
        header("location: ./Invoice.php");
    } else {
        $_SESSION['toast-error'] = "Duyệt đơn hàng thất bại!";
        header("location: ./Invoice.php");
    }