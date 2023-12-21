<?php
    session_start();
    if (empty($_SESSION['user'])) {
        $_SESSION['toast-error'] = "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng";
        header('location: ./index.php');
    } else {
        $idProduct = $_GET['id'];
        $idproperty = $_GET['property'];
        $quantity = $_GET['quantity'];
        require_once './connect/connect.php';
        $sql = "
            SELECT sp.*, spct.anhs_sanpham, spct.id as idDetail, tt.ten_thuoctinhcon, tt.ma_thuoctinh FROM sanpham sp
            INNER JOIN chitiet_sanpham spct ON sp.ma_sanpham = spct.ma_sanpham
            INNER JOIN thuoctinh tt ON spct.ma_thuoctinh = tt.ma_thuoctinh
            WHERE sp.ma_sanpham = '$idProduct' AND tt.ma_thuoctinh = '$idproperty'
        ";
        $result = mysqli_query($connect, $sql);
        $product = mysqli_fetch_array($result);
    
        if (empty($_SESSION['cart'][$product['idDetail']])) {
            
            $_SESSION['cart'][$product['idDetail']] = array(
                'id' => $product['ma_sanpham'],
                'idDetail' => $product['idDetail'],
                'name' => $product['ten_sanpham'],
                'price' => $product['gia_sanpham'],
                'property' => $product['ten_thuoctinhcon'],
                'image' => $product['anhs_sanpham'],
                'idproperty' => $product['ma_thuoctinh'],
                'quantity' => $quantity
            );
        } else {
            $_SESSION['cart'][$product['idDetail']]['quantity'] += 1;
        }
    
        $_SESSION['toast-success-add-to-cart'] = 'Đã thêm sản phẩm vào giỏ hàng';
        header('location: product.php?id=' . $idProduct . '');
    }