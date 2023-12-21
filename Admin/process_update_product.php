<?php
    session_start();
    require_once './ShareAdmin/root/connect.php';
    $id = $_GET['id'];

    $name_product = $_POST['name_product'];
    $image_product = $_POST['img_product_parent'];
    $image_product = str_replace(', ', ',', $image_product); // remove space
    $image_product = str_replace(' ,', ',', $image_product); // remove space
    $image_product = str_replace(' , ', ',', $image_product); // remove space
    if (str_contains($image_product, ',')) {
        $one_img_product = substr($image_product, 0, strpos($image_product, ','));
    }
    else {
        $one_img_product = $image_product;
    }

    $img_product_file = $_FILES['img_product_file_parent'];
    // handle upload image
    $folderUpload = "IMG/PhotosProduct/";
    if ($img_product_file["name"] != "") {
        $fileExtension = explode(".", $img_product_file["name"])[1];
        $target_file = $folderUpload . time() . '.' . $fileExtension;
        move_uploaded_file($img_product_file["tmp_name"], $target_file);
    }


    if ($one_img_product == "") {
        $one_img_product = $target_file;
    }

    // price
    $price_product = $_POST['price_product'];

    // description
    $description_product = $_POST['desc_product'];
    if (str_contains($description_product, "'")) {
        $description_product = str_replace("'", "\'", $description_product);
    }
    if (str_contains($price_product, '"')) {
        $description_product = str_replace('"', '\"', $description_product);
    }

    $update_date = date('Y-m-d H:i:s'); // Get current date

    if ($one_img_product == "") {
        $stringSQL = "UPDATE `sanpham` SET `ten_sanpham`='$name_product',`gia_sanpham`=$price_product,`mota_sanpham`='$description_product',`ngaycapnhat`='$update_date' WHERE `ma_sanpham` = '$id'";
    } else {
        
        $stringSQL = "UPDATE `sanpham` SET `ten_sanpham`='$name_product',`anh_sanpham`='$one_img_product',`gia_sanpham`=$price_product,`mota_sanpham`='$description_product',`ngaycapnhat`='$update_date' WHERE `ma_sanpham` = '$id'";
    }
    $result = mysqli_query($connect, $stringSQL);
    
    if ($result) {
        $_SESSION['toast-success'] = "Sửa thành công";
    } else {
        $_SESSION['toast-error'] = "Sửa thất bại";
    }
    header("Location: ProductCategory.php");