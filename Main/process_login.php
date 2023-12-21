<?php
    session_start();
    require_once './connect/connect.php';
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stringSQL = "SELECT * FROM `customers` WHERE (`email` = '$email' OR `phone` = '$email') AND `password` = '$password'";
    $result = mysqli_query($connect, $stringSQL);
    if (mysqli_num_rows($result) < 1) {
        $stringSQL = "SELECT * FROM `accounts` WHERE `phone` = '$email'";
        $resultAdmin = mysqli_query($connect, $stringSQL);
        if (mysqli_num_rows($resultAdmin) > 0) {
            $row = mysqli_fetch_array($resultAdmin);
            $_SESSION['admin'] = true;
            $_SESSION['user'] = $row;
            $_SESSION['toast-success'] = "Đăng nhập thành công";
            if (isset($_POST['remember'])) {
                $token = md5($row['id'] . $row['phone'] . $row['password']);
                setcookie("token", $token, time() + 3600);
                $sqlToken = "UPDATE `accounts` SET `token` = '$token' WHERE `id` = " . $row['id'];
                mysqli_query($connect, $sqlToken);
            }
            header("Location: ../Admin/index.php");
        } else {
            $_SESSION['toast-error'] = "Đăng nhập thất bại! Kiểm tra lại thông tin";
            header("Location: ./Login.php");
        }
    } else {
        $stringSQL = "SELECT * FROM `accounts` WHERE `phone` = '$email'";
        $resultAdmin = mysqli_query($connect, $stringSQL);
        if (mysqli_num_rows($resultAdmin) > 0) {
            $_SESSION['admin'] = true;
        }
        $row = mysqli_fetch_array($result);
        $_SESSION['user'] = $row;
        $_SESSION['toast-success'] = "Đăng nhập thành công";
        if (isset($_POST['remember'])) {
            $token = md5($row['customerID'] . $row['phone'] . $row['password']);
            setcookie("token", $token, time() + 3600);
            $sqlToken = "UPDATE `customers` SET `token` = '$token' WHERE `customerID` = " . $row['customerID'];
            mysqli_query($connect, $sqlToken);
        }
        header("Location: ./index.php");
    }
