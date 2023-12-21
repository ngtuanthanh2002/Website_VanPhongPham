<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: login.php');
        exit();
    }
    require_once "./connect/connect.php";

    $deliveryAddress = $_POST['delivery-address'];
    $feeShip = $_POST['fee-ship'];
    $total = $_POST['totalPrice'];
    $idProductDetail = $_POST['idProductDetail'];
    $quantity = $_POST['quantity'];

    // Tạo mã hóa đơn
    $sqlCountInvoice = "SELECT COUNT(*) FROM hoadon";
    $resultCountInvoice = mysqli_query($connect, $sqlCountInvoice);
    $row = mysqli_fetch_array($resultCountInvoice);
    $count_invoice = $row[0];
    $mahoadon = "HD".($count_invoice + 1);

    $total += $feeShip;
    $created_date = date('Y-m-d H:i:s'); // Get current date

    $sqlInsertInvoice = "INSERT INTO hoadon (`ma_hoadon`, `customerID`, `ma_diachi_nhanhang`, `tienthanhtoan`, `phivc`, `trangthai`, `createdDate`) VALUES ('$mahoadon', '".$_SESSION['user']['customerID']."', $deliveryAddress, $total, '$feeShip', 0, '$created_date')";
    $resultInsertInvoice = mysqli_query($connect, $sqlInsertInvoice);

    if ($resultInsertInvoice){
        $sqlInsertInvoiceDetail = "INSERT INTO chitiet_hoadon (`ma_hoadon`, `id_ct_sanpham`, `soluong`) VALUES ('$mahoadon', '".$idProductDetail."', '".$quantity."')";
        $resultInsertInvoiceDetail = mysqli_query($connect, $sqlInsertInvoiceDetail);
        
        $_SESSION["toast-success"] = "Đặt hàng thành công";
        header("Location: ./index.php");
        exit();
    }
    else{
        $_SESSION["toast-error"] = "Đặt hàng thất bại";
        header("Location: ./index.php");
        exit();
    }
