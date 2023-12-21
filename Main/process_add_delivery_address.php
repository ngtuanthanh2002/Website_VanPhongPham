<?php
    session_start();
    require_once "./connect/connect.php";
    $id = $_GET['id'];
    $role = $_POST['role'];
    if ($role != null && isset($_SESSION['user'])) {
        header("Location: ./Login.php");
        die();
    }

    if (!isset($_POST["deliveryName"]) || !isset($_POST["deliveryPhone"]) || !isset($_POST["deliveryAddress"]) || !isset($_POST["conscious"]) || !isset($_POST["district"]) || !isset($_POST["wards"])) {
        $_SESSION["toast-error-info"] = "Vui lòng nhập đầy đủ thông tin";
        header("Location: ./User_Infor.php");
        die();
    }

    if (empty($_POST["deliveryName"]) || empty($_POST["deliveryPhone"]) || empty($_POST["deliveryAddress"]) || empty($_POST["conscious"]) || empty($_POST["district"]) || empty($_POST["wards"])) {
        $_SESSION["toast-error-info"] = "Vui lòng nhập đầy đủ thông tin";
        header("Location: ./User_Infor.php");
        die();
    }

    $deliveryName = $_POST["deliveryName"];
    $deliveryPhone = $_POST["deliveryPhone"];
    $deliveryAddress = $_POST["deliveryAddress"];
    $conscious = $_POST["conscious"];
    $district = $_POST["district"];
    $wards = $_POST["wards"];
    $setDefault = 0;
    
    $stringSQL = "SELECT COUNT(*) FROM `diachi_nhanhang` WHERE `customerID`='$id' AND `macdinh`=1";
    $resultCountDiaChi = mysqli_query($connect, $stringSQL);
    $number_of_rows_DiaChi = mysqli_fetch_array($resultCountDiaChi)['COUNT(*)'];
    if ($number_of_rows_DiaChi == 0) {
        $setDefault = 1;
    }

    if (isset($_POST["setDefault"])) {
        $sqlDefault = "UPDATE `diachi_nhanhang` SET `macdinh`= 0 WHERE `customerID`='$id'";
        $result = mysqli_query($connect, $sqlDefault);

        $setDefault = 1;
    }
    $create_date = date("Y-m-d H:i:s");

    $stringSQL = "INSERT INTO `diachi_nhanhang`(`customerID`, `ten_nguoinhan`, `sdt_nguoinhan`, `diachi`, `tinh`, `huyen`, `xa`, `macdinh`, `ngaytao`) VALUES ('$id','$deliveryName','$deliveryPhone','$deliveryAddress','$conscious','$district','$wards',$setDefault, '$create_date')";
    $result = mysqli_query($connect, $stringSQL);
    if ($result) {
        $_SESSION["toast-success-info"] = "Thêm địa chỉ nhận hàng thành công";
        header("Location: ./User_Infor.php");
        die();
    } else {
        $_SESSION["toast-error-info"] = "Thêm địa chỉ nhận hàng thất bại";
        header("Location: ./User_Infor.php");
        die();
    }