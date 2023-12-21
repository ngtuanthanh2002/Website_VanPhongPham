<?php
    session_start();
    require_once "./connect/connect.php";
    $id = $_GET['id'];
    $role = $_POST['role'];
    $newAddress = $_POST['newAddress'];
    if ($role != null) {
        $stringSQL = "UPDATE `accounts` SET `address`='$newAddress' WHERE `id`='$id'";
    } else {
        $stringSQL = "UPDATE `customers` SET `address`='$newAddress' WHERE `customerID`='$id'";
    }
    $result = mysqli_query($connect, $stringSQL);
    
    if ($result) {
        $_SESSION['toast-success'] = "Thành công";
        header("Location: ./User_Infor.php");
    } else {
        $_SESSION['toast-error'] = "Thất bại";
        header("Location: ./User_Infor.php");
    }