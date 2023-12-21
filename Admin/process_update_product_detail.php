<?php
    session_start();
    require_once './ShareAdmin/root/connect.php';
    $linkParent = $_POST['linkParent'];

    $id = $_GET['id'];
    $image_product = $_POST['img_product'];
    $image_product = str_replace(', ', ',', $image_product); // remove space
    $image_product = str_replace(' ,', ',', $image_product); // remove space
    $image_product = str_replace(' , ', ',', $image_product); // remove space
    if (str_contains($image_product, ',')) {
        $one_img_product = substr($image_product, 0, strpos($image_product, ','));
    }
    else {
        $one_img_product = $image_product;
    }

    $img_product_file = $_FILES['img_product_file'];
    // handle upload image
    $folderUpload = "IMG/PhotosProduct/";
    if ($img_product_file["name"] != "") {
        $fileExtension = explode(".", $img_product_file["name"])[1];
        $target_file = $folderUpload . time() . '.' . $fileExtension;
        move_uploaded_file($img_product_file["tmp_name"], $target_file);
    }


    // property
    $property = $_POST['property'];

    // quantity
    $quantity = $_POST['quantity_product'];

    if ($one_img_product == "") {
        $one_img_product = $target_file;
    }
    // insert chitiet_sanpham
    if ($one_img_product == "") {
        $stringSQL = "UPDATE `chitiet_sanpham` SET `ma_thuoctinh`='$property',`soluong`='$quantity' WHERE `id` = '$id'";
    } else {
        $stringSQL = "UPDATE `chitiet_sanpham` SET `anhs_sanpham`='$one_img_product',`ma_thuoctinh`='$property',`soluong`='$quantity' WHERE `id` = '$id'";
    }
    $result = mysqli_query($connect, $stringSQL);

    if ($result) {
        $_SESSION['toast-success'] = "Sửa thành công";
    } else {
        $_SESSION['toast-error'] = "Sửa thất bại";
    }
    header("Location: " . $linkParent);
