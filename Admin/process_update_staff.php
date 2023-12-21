<?php
    session_start();
    require_once './ShareAdmin/root/connect.php';
    $id = $_GET['id'];

    $sql = "SELECT * FROM `accounts` WHERE `id` = '$id'";
    $result = mysqli_query($connect, $sql);
    
    if (mysqli_num_rows($result) < 1) {
        $_SESSION['toast-error'] = "Không tìm thấy nhân viên";
        header("Location: ./StaffCategory.php");
        die();
    }

    $phone_staff = $_POST['phone_staff'];
    $stringSQL = "SELECT * FROM `accounts` WHERE `phone` = '$phone_staff' AND `id` != '$id'";
    $result = mysqli_query($connect, $stringSQL);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['toast-error'] = "Số điện thoại đã được sử dụng";
        header("Location: ./StaffCategory.php");
        die();
    }
    $name_staff = $_POST['name_staff'];
    $dob_staff = $_POST['dob_staff'];
    $address_staff = $_POST['address_staff'];
    $role = $_POST['role_staff'];

    $today = date("Y-m-d");
    $age = date_diff(date_create($dob_staff), date_create($today))->format('%y');
    if ($age < 18) {
        $_SESSION['toast-error'] = "Nhân viên phải trên 18 tuổi";
        header("Location: ./StaffCategory.php");
        die();
    }

    // add parent properties
    if (isset($_POST['pwd_staff'])) {
        $pwd_staff = $_POST['pwd_staff'];
    } else {
        $pwd_staff = "9876543210";
    }
    $stringSQL = "UPDATE `accounts` SET `name` = '$name_staff', `phone` = '$phone_staff', `dob` = '$dob_staff', `address` = '$address_staff', `role` = '$role', `password` = '$pwd_staff' WHERE `id` = '$id'";
    $result = mysqli_query($connect, $stringSQL);

    if ($result) {
        $_SESSION['toast-success'] = "Sửa thành công";
    } else {
        $_SESSION['toast-error'] = "Sửa thất bại";
    }
    header("Location: ./StaffCategory.php");
