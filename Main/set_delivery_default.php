<?php
    session_start();
    require_once "./connect/connect.php";
    $idCustomer = $_GET['idCustomer'];
    $id = $_GET['id'];
    $role = $_POST['role'];
    if ($role != null && isset($_SESSION['user'])) {
        header("Location: ./Login.php");
        die();
    }

    $sqlString = "UPDATE `diachi_nhanhang` SET `macdinh`= 0 WHERE `customerID`='$idCustomer'";
    $result = mysqli_query($connect, $sqlString);

    $sqlString = "UPDATE `diachi_nhanhang` SET `macdinh`= 1 WHERE `customerID`='$idCustomer' AND `id`='$id'";
    $result = mysqli_query($connect, $sqlString);

    if ($result) {
        $_SESSION["toast-success-info"] = "Đặt địa chỉ nhận hàng mặc định thành công";
        header("Location: ./User_Infor.php");
        die();
    } else {
        $_SESSION["toast-error-info"] = "Đặt địa chỉ nhận hàng mặc định thất bại";
        header("Location: ./User_Infor.php");
        die();
    }