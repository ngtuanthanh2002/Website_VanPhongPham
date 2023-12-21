<?php
    session_start();
    if ($_SESSION['user']['role'] != 0) {
        $_SESSION['toast-error'] = "Bạn không có quyền truy cập";
        header("Location: ./StaffCategory.php");
        die();
    }
    require_once './ShareAdmin/root/connect.php';

    $id = $_GET['id'];
    if ($id == $_SESSION['user']['id']) {
        $_SESSION['toast-error'] = "Bạn không thể xoá chính mình";
        header("Location: ./StaffCategory.php");
        die();
    }
    $sql = "SELECT * FROM `accounts` WHERE `id` = '$id'";
    $resultStaff = mysqli_query($connect, $sql);
    $each = mysqli_fetch_array($resultStaff);
    if ($each['role'] == 0) {
        $_SESSION['toast-error'] = "Bạn không thể xoá quản trị viên";
        header("Location: ./StaffCategory.php");
        die();
    }

    $stringSQL = "DELETE FROM `accounts` WHERE `id` = '$id'";
    $result = mysqli_query($connect, $stringSQL);

    if ($result) {
        $_SESSION['toast-success'] = "Xoá nhân viên thành công!";
    } else {
        $_SESSION['toast-error'] = "Xoá nhân viên thất bại!";
    }
    header("Location: StaffCategory.php");