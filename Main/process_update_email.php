<?php
    session_start();
    require_once "./connect/connect.php";
    $id = $_GET['id'];
    $newEmail = $_POST['newEmail'];
    $stringSQL = "UPDATE `customers` SET `email`='$newEmail' WHERE `customerID`='$id'";
    $result = mysqli_query($connect, $stringSQL);
    
    if ($result) {
        $_SESSION['toast-success'] = "Thành công";
        $_SESSION['user']['email'] = $newEmail;
        header("Location: ./User_Infor.php");
    } else {
        $_SESSION['toast-error'] = "Thất bại";
        header("Location: ./User_Infor.php");
    }