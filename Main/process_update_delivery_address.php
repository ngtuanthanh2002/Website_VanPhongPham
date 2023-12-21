<?php
    session_start();
    require_once "./connect/connect.php";
    $id = $_GET['id'];
    $idCustomer = $_GET['idCustomer'];
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
    $create_date = date("Y-m-d H:i:s");

    if (isset($_POST["setDefault"])) {
        $sqlDefault = "UPDATE `diachi_nhanhang` SET `macdinh`= 0 WHERE `customerID`='$idCustomer'";
        $result = mysqli_query($connect, $sqlDefault);

        $setDefault = 1;
        $stringSQL = "UPDATE `diachi_nhanhang` SET `ten_nguoinhan`='$deliveryName', `sdt_nguoinhan`='$deliveryPhone', `diachi`='$deliveryAddress', `tinh`='$conscious', `huyen`='$district', `xa`='$wards', `macdinh`=$setDefault, `ngaytao`='$create_date' WHERE `customerID`='$idCustomer' AND `id`='$id'";
    } else {
        $stringSQL = "UPDATE `diachi_nhanhang` SET `ten_nguoinhan`='$deliveryName', `sdt_nguoinhan`='$deliveryPhone', `diachi`='$deliveryAddress', `tinh`='$conscious', `huyen`='$district', `xa`='$wards', `ngaytao`='$create_date' WHERE `customerID`='$idCustomer' AND `id`='$id'";
    }

    $result = mysqli_query($connect, $stringSQL);
    if ($result) {
        $_SESSION["toast-success-info"] = "Cập nhật địa chỉ nhận hàng thành công";
        header("Location: ./User_Infor.php");
        die();
    } else {
        $_SESSION["toast-error-info"] = "Cập nhật địa chỉ nhận hàng thất bại";
        header("Location: ./User_Infor.php");
        die();
    }