<?php
    session_start();
    require_once "./connect/connect.php";
    $id = $_GET['id'];
    $role = $_POST['role'];
    if ($role != null && isset($_SESSION['user'])) {
        header("Location: ./Login.php");
        die();
    }

    $sqlDiaChi = "SELECT * FROM `diachi_nhanhang` WHERE `id`='$id'";
    $resultDiaChi = mysqli_query($connect, $sqlDiaChi);
    $each = mysqli_fetch_array($resultDiaChi);

    if ($each['macdinh'] == 1) {
        $_SESSION["toast-error-info"] = "Không thể xóa địa chỉ mặc định";
        header("Location: ./User_Infor.php");
        die();
    }

    $sqlString = "DELETE FROM `diachi_nhanhang` WHERE `id`='$id'";
    $result = mysqli_query($connect, $sqlString);

    if ($result) {
        $_SESSION["toast-success-info"] = "Xóa địa chỉ nhận hàng thành công";
        header("Location: ./User_Infor.php");
        die();
    } else {
        $_SESSION["toast-error-info"] = "Xóa địa chỉ nhận hàng thất bại";
        header("Location: ./User_Infor.php");
        die();
    }