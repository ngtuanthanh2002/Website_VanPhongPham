<?php
    session_start();
    require_once "./connect/connect.php";
    $id = $_GET['id'];
    $role = $_POST['role'];
    $newPhone = $_POST['newPhone'];
    if ($role != null) {
        $stringSQL = "UPDATE `accounts` SET `phone`='$newPhone' WHERE `id`='$id'";
    } else {
        $stringSQL = "UPDATE `customers` SET `phone`='$newPhone' WHERE `customerID`='$id'";
    }
    $result = mysqli_query($connect, $stringSQL);
    
    if ($result) {
        $_SESSION['toast-success'] = "Thành công";
        header("Location: ./User_Infor.php");
    } else {
        $_SESSION['toast-error'] = "Thất bại";
        header("Location: ./User_Infor.php");
    }