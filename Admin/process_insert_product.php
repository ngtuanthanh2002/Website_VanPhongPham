<?php
    session_start();
    require_once './ShareAdmin/root/connect.php';

    $name_product = $_POST['name_product'];
    $img_product = $_POST['img_product'];
    $img_product = str_replace(', ', ',', $img_product); // remove space
    $img_product = str_replace(' ,', ',', $img_product); // remove space
    $img_product = str_replace(' , ', ',', $img_product); // remove space
    if (str_contains($img_product, ',')) {
        $one_img_product = substr($img_product, 0, strpos($img_product, ','));
    }
    else {
        $one_img_product = $img_product;
    }

    $img_product_file = $_FILES['img_product_file'];
    // handle upload image
    $folderUpload = "IMG/PhotosProduct/";
    $fileExtension = explode(".", $img_product_file["name"])[1];

    $target_file = $folderUpload . time() . '.' . $fileExtension;
    move_uploaded_file($img_product_file["tmp_name"], $target_file);

    $price_product = $_POST['price_product'];
    $description_product = $_POST['desc_product'];

    // ---------------- handle properties ----------------
    $lstProperties = $_POST['properties'];
    $lstProperties = str_replace(' ', '', $lstProperties); // remove space
    $id_properties = array();
    // Get id properties
    foreach ($lstProperties as $key => $value) {
        $check = array_search($value, $id_properties);
        if (!$check) {
            array_push($id_properties, $value);
        }
    }
    // ----------------------------------------------------

    // ---------------- Get count of product to create id ----------------
    $stringSQL = "SELECT COUNT(*) FROM `sanpham`";
    $result = mysqli_query($connect, $stringSQL);
    $row = mysqli_fetch_array($result);
    $count_product = $row[0];
    $id_product = "SP" . $count_product + 1;
    // -------------------------------------------------------------------

    $create_date = date('Y-m-d H:i:s'); // Get current date

    // Insert into table sanpham
    if ($one_img_product == "") {
        $one_img_product = $target_file;
    }
    $stringSQLProduct = "INSERT INTO `sanpham`(`ma_sanpham`, `ten_sanpham`, `anh_sanpham`, `gia_sanpham`, `mota_sanpham`, `ngaytao`) VALUES ('$id_product', '$name_product','$one_img_product','$price_product', '$description_product', '$create_date')";
    $resultProduct = mysqli_query($connect, $stringSQLProduct);

    // Insert into table chitiet_sanpham
    foreach ($id_properties as $key => $value) {
        $stringSQLDetailProduct = "INSERT INTO `chitiet_sanpham`(`ma_sanpham`, `anhs_sanpham`, `ma_thuoctinh`, `soluong`) VALUES ('$id_product',null,'$value',0)";
        $resultDetailProduct = mysqli_query($connect, $stringSQLDetailProduct);
    }

    if ($resultProduct && $resultDetailProduct) {
        $_SESSION['toast-success'] = "Thêm thành công";
    } elseif ($resultProduct && !$resultDetailProduct) {
        $_SESSION['toast-error'] = "Thêm chi tiết thất bại";
    } elseif (!$resultProduct &&$resultDetailProduct) {
        $_SESSION['toast-error'] = "Thêm sản phẩm thất bại";
    } else {
        $_SESSION['toast-error'] = "Thêm thất bại";
    }
    header("Location: ./ProductCategory.php");
