<?php
    session_start();
    require_once "./connect/connect.php";
    $id = $_GET['id'];
    $role = $_POST['role'];
    $newName = $_POST['newName'];
    if ($role != null) {
        $stringSQL = "UPDATE `accounts` SET `name`='$newName' WHERE `id`='$id'";
    } else {
        $stringSQL = "UPDATE `customers` SET `name`='$newName' WHERE `customerID`='$id'";
    }
    $result = mysqli_query($connect, $stringSQL);
    
    if ($result) {
        $_SESSION['toast-success'] = "Thành công";
        $_SESSION['user']['name'] = $newName;
        header("Location: ./User_Infor.php");
    } else {
        $_SESSION['toast-error'] = "Thất bại";
        header("Location: ./User_Infor.php");
    }