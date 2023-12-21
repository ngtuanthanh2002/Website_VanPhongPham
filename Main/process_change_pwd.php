<?php
    session_start();
    require_once "./connect/connect.php";
    $id = $_GET['id'];
    $role = $_POST['role'];
    $oldPwd = $_POST['oldPwd'];
    if ($role != null) {
        $stringSQL = "SELECT * FROM `accounts` WHERE `id`='$id' AND `password`='$oldPwd'";
    } else {
        $stringSQL = "SELECT * FROM `customers` WHERE `customerID`='$id' AND `password`='$oldPwd'";
    }
    $result = mysqli_query($connect, $stringSQL);
    if (mysqli_num_rows($result) == 0) {
        $_SESSION['toast-error'] = "Mật khẩu cũ không đúng";
        header("Location: ./User_Infor.php");
        exit();
    } elseif ($result->num_rows > 0) {
        $newPwd = $_POST['newPwd'];
        if ($role != null) {
            $stringSQL = "UPDATE `accounts` SET `password`='$newPwd' WHERE `id`='$id'";
        } else {
            $stringSQL = "UPDATE `customers` SET `password`='$newPwd' WHERE `customerID`='$id'";
        }
        $resultUpdate = mysqli_query($connect, $stringSQL);
    }
    
    if ($resultUpdate) {
        $_SESSION['toast-success'] = "Thành công";
        header("Location: ./User_Infor.php");
    } else {
        $_SESSION['toast-error'] = "Thất bại";
        header("Location: ./User_Infor.php");
    }