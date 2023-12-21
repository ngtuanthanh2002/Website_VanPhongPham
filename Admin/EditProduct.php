<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
    <link rel = "icon" href="IMG/logo.png" type="image/x-icon">
    
    <!-- CSS -->
    <link rel="stylesheet" href="./CSS/style_main.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <?php
        session_start();
        require_once './ShareAdmin/root/connect.php';
        require_once './ShareAdmin/root/funcion.php';
        $id = $_GET['id'];
        $stringSQL = "SELECT * FROM `sanpham` WHERE `ma_sanpham` = '$id'";
        $result = mysqli_query($connect, $stringSQL);
        $each = mysqli_fetch_array($result);

        $stringSQL = "SELECT * FROM `chitiet_sanpham` WHERE `ma_sanpham` = '$id'";
        $resultChiTiet = mysqli_query($connect, $stringSQL);

        function get_thuoctinh($id, $connect) {
            $stringSQL = "SELECT * FROM `thuoctinh`";
            $result = mysqli_query($connect, $stringSQL);
            $each = mysqli_fetch_array($result);

            $ten_thuoctinhcon = '';
            $ten_thuoctinhcha = '';
            foreach ($result as $each) {
                if ($each['ma_thuoctinh'] == $id) {
                    $ten_thuoctinhcon = $each['ten_thuoctinhcon'];

                    foreach ($result as $eachV2) {
                        if ($eachV2['ma_thuoctinh'] == $each['ten_thuoctinhcha']) {
                            $ten_thuoctinhcha = $eachV2['ten_thuoctinhcha'];
                            break;
                        }
                    }
                    break;
                }
            }
            return $ten_thuoctinhcha . ' - ' . $ten_thuoctinhcon;
        }
    ?>
    <div class="toast-container position-fixed p-3" style="top: 80px; right: 50px;">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <?php
                    if (isset($_SESSION['toast-success'])) {
                        echo '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" xml:space="preserve" width="24px" height="24px" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#25AE88;" cx="25" cy="25" r="25"></circle> <polyline style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points=" 38,15 22,33 12,25 "></polyline> </g></svg>';
                        echo '<strong class="ms-2 me-auto">Thông báo</strong>';
                    }
                    if (isset($_SESSION['toast-error'])) {
                        echo '<svg fill="#ff0000" width="24px" height="24px" viewBox="0 -8 528 528" xmlns="http://www.w3.org/2000/svg" stroke="#ff0000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title>fail</title><path d="M264 456Q210 456 164 429 118 402 91 356 64 310 64 256 64 202 91 156 118 110 164 83 210 56 264 56 318 56 364 83 410 110 437 156 464 202 464 256 464 310 437 356 410 402 364 429 318 456 264 456ZM264 288L328 352 360 320 296 256 360 192 328 160 264 224 200 160 168 192 232 256 168 320 200 352 264 288Z"></path></g></svg>';
                        echo '<strong class="ms-2 me-auto">Lỗi</strong>';
                    }
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?php
                    if (isset($_SESSION['toast-success'])) {
                        echo $_SESSION['toast-success'];
                        unset($_SESSION['toast-success']);
                        echo '<script>
                                var toastLive = document.getElementById("liveToast")
                                var toast = new bootstrap.Toast(toastLive)
                                toast.show()
                            </script>';
                    }
                    if (isset($_SESSION['toast-error'])) {
                        echo $_SESSION['toast-error'];
                        unset($_SESSION['toast-error']);
                        echo '<script>
                                var toastLive = document.getElementById("liveToast")
                                var toast = new bootstrap.Toast(toastLive)
                                toast.show()
                            </script>';
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="modal" id="editModal" tabindex="-1" style="display: block;">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <form action="process_update_product.php?id=<?php echo $id;?>" method="post" enctype="multipart/form-data" class="form-add" style="height: 100%; width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-2" id="addleModalLabel">Sửa sản phẩm</h1>
                        <a href="ProductCategory.php">X</a>
                    </div>

                    <div class="modal-body" style="overflow-x: hidden;">
                        <label class="fs-5 form-label required" for="nameProduct">Tên sản phẩm: </label>
                        <br>
                        <input id="nameProduct" name="name_product" value="<?php echo $each['ten_sanpham']; ?>" class="form-control form-control-lg" type="text" placeholder="Tên sản phẩm..." aria-label=".form-control-lg" required>
                        <div class="invalid name_product"></div>
                        <br>

                        <label class="fs-5 form-label" for="imgProduct">Ảnh sản phẩm: </label>
                        <br>
                        <div class="input-image row align-items-center">
                            <div class="col-6">
                                <input id="imgProduct" name="img_product_parent" class="form-control form-control-lg" type="text" placeholder="Link ảnh..." aria-label=".form-control-lg">
                            </div>
                            <div class="col-6">
                                <label class="btn btn-default btn-file border">
                                    Chọn file <input type="file" name="img_product_file_parent" accept="image/png, image/gif, image/jpeg" style="display: none;">
                                </label>
                            </div>
                        </div>
                        <br>
                        <div class="image-product-edit">
                            <div class="overflow-auto" style="max-width: 35%; max-height: 20rem;">
                                <?php
                                    echo "
                                        <div class='col'>
                                            <img class='img-thumbnail' src='" . $each['anh_sanpham'] . "' alt='image' style='max-width: 15%;'>
                                        </div>
                                    ";
                                ?>
                            </div>
                        </div>
                        <br>

                        <label class="fs-5 form-label required" for="priceProduct">Giá bán sản phẩm: </label>
                        <input id="priceProduct" name="price_product" type="number" value="<?php echo $each['gia_sanpham']; ?>" class="form-control form-control-lg" type="text" placeholder="Giá sản phẩm..." aria-label=".form-control-lg" required>
                        <br>

                        <div class="form-floating mt-2">
                            <textarea name="desc_product" class="form-control" placeholder="Mô tả sản phẩm..." id="descProduct" style="height: 100px"><?php echo $each['mota_sanpham']; ?></textarea>
                            <label for="descProduct">Mô tả sản phẩm</label>
                        </div>
                        <br>

                        <label class="fs-5 form-label " for="priceProduct">Danh mục chi tiết sản phẩm: </label>
                        <div class="col-3">
                            <button style="color: var(--white) !important;" type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addModal">Thêm mới chi tiết sản phẩm</button>
                        </div>
                        <div class="table-responsive" style="min-height: 348px;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 2%;">STT</th>
                                        <th class="text-center" style="width: 5%;">Ảnh</th>
                                        <th class="text-center" style="width: 15%;">Thuộc tính</th>
                                        <th class="text-center" style="width: 5%;">Số lượng</th>
                                        <th class="text-center" style="width: 5%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        if (mysqli_num_rows($resultChiTiet) > 0) {
                                            foreach ($resultChiTiet as $index => $eachChiTiet) {
                                                $index += 1;
                                                echo "<tr>";
                                                    echo "<td class='text-center' style='width: 5%'>
                                                            <span>$index</span>
                                                    </td>";
                                                    if ($eachChiTiet['anhs_sanpham'] != null) {
                                                        echo "<td style='width: 5%; text-align: -webkit-center;'>
                                                                <img src='". $eachChiTiet['anhs_sanpham'] . "' class='img-thumbnail' alt='...' style='max-width: 25%;'>
                                                            </td>";
                                                    } else {
                                                        echo "<td style='width: 5%; text-align: -webkit-center;'>
                                                                <svg width='64px' height='64px' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><g id='SVGRepo_bgCarrier' stroke-width='0'></g><g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g><g id='SVGRepo_iconCarrier'> <path d='M8.42229 20.6181C10.1779 21.5395 11.0557 22.0001 12 22.0001V12.0001L2.63802 7.07275C2.62423 7.09491 2.6107 7.11727 2.5974 7.13986C2 8.15436 2 9.41678 2 11.9416V12.0586C2 14.5834 2 15.8459 2.5974 16.8604C3.19479 17.8749 4.27063 18.4395 6.42229 19.5686L8.42229 20.6181Z' fill='#1C274C'></path> <path opacity='0.7' d='M17.5774 4.43152L15.5774 3.38197C13.8218 2.46066 12.944 2 11.9997 2C11.0554 2 10.1776 2.46066 8.42197 3.38197L6.42197 4.43152C4.31821 5.53552 3.24291 6.09982 2.6377 7.07264L11.9997 12L21.3617 7.07264C20.7564 6.09982 19.6811 5.53552 17.5774 4.43152Z' fill='#1C274C'></path> <path opacity='0.5' d='M21.4026 7.13986C21.3893 7.11727 21.3758 7.09491 21.362 7.07275L12 12.0001V22.0001C12.9443 22.0001 13.8221 21.5395 15.5777 20.6181L17.5777 19.5686C19.7294 18.4395 20.8052 17.8749 21.4026 16.8604C22 15.8459 22 14.5834 22 12.0586V11.9416C22 9.41678 22 8.15436 21.4026 7.13986Z' fill='#1C274C'></path> <path d='M6.32334 4.48382C6.35617 4.46658 6.38926 4.44922 6.42261 4.43172L7.91614 3.64795L17.0169 8.65338L21.0406 6.64152C21.1783 6.79745 21.298 6.96175 21.4029 7.13994C21.5525 7.39396 21.6646 7.66352 21.7487 7.96455L17.7503 9.96373V13.0002C17.7503 13.4144 17.4145 13.7502 17.0003 13.7502C16.5861 13.7502 16.2503 13.4144 16.2503 13.0002V10.7137L12.7503 12.4637V21.9042C12.4934 21.9682 12.2492 22.0002 12.0003 22.0002C11.7515 22.0002 11.5072 21.9682 11.2503 21.9042V12.4637L2.25195 7.96455C2.33601 7.66352 2.44813 7.39396 2.59771 7.13994C2.70264 6.96175 2.82232 6.79745 2.96001 6.64152L12.0003 11.1617L15.3865 9.46857L6.32334 4.48382Z' fill='#1C274C'></path> </g></svg>
                                                            </td>";
                                                    }
                                                    echo "<td class='text-start' style='width: 15%;'>
                                                            <span class='ms-4'>" . get_thuoctinh($eachChiTiet['ma_thuoctinh'], $connect) . "</span>
                                                        </td>";
                                                    echo "<td class='text-center' style='width: 5%;'>
                                                            <span class='ms-4'>" . $eachChiTiet['soluong'] . "</span>
                                                        </td>";
                                                    echo "<td class='text-center'>
                                                            <div class='dropdown'>
                                                                <a class='btn dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                                    <svg width='24px' height='24px' viewBox='0 0 1024 1024' class='icon' version='1.1' xmlns='http://www.w3.org/2000/svg' fill='#000000'><g id='SVGRepo_bgCarrier' stroke-width='0'></g><g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g><g id='SVGRepo_iconCarrier'><path d='M539.4 550.9m-164.7 0a164.7 164.7 0 1 0 329.4 0 164.7 164.7 0 1 0-329.4 0Z' fill='#FFB89A'></path><path d='M679.3 405.4c-8.9-14-27.4-18.2-41.4-9.3-14 8.9-18.2 27.4-9.3 41.4 14 22.1 21.4 47.7 21.4 74 0 16.6 13.4 30 30 30s30-13.4 30-30c0-37.7-10.6-74.4-30.7-106.1z' fill='#33CC99'></path><path d='M607.4 611.4c-25.9 24.9-60 38.6-96 38.6-76.4 0-138.5-62.1-138.5-138.5S435 373 511.4 373c22.9 0 44.7 5.4 64.8 16 14.6 7.8 32.8 2.2 40.6-12.5 7.8-14.6 2.2-32.8-12.5-40.6-28.4-15.1-60.5-23-92.9-23-109.5 0-198.5 89.1-198.5 198.5C312.9 620.9 402 710 511.5 710c51.5 0 100.4-19.7 137.5-55.4 11.9-11.5 12.3-30.5 0.8-42.4-11.4-11.9-30.4-12.3-42.4-0.8z' fill='#33CC99'></path><path d='M853.7 370.4c-17.4-42.2-14.2-90.5 7.7-138.6a448.25 448.25 0 0 0-68.7-69c-48.2 21.8-96.6 24.9-138.8 7.4-42.3-17.6-74.3-54.2-92.8-104-16.4-1.8-33-2.7-49.8-2.7-15.9 0-31.6 0.8-47.1 2.5-18.7 49.8-50.7 86.4-93.1 104-42.5 17.6-91.2 14.1-139.7-8.2-25.2 20.2-48.1 43-68.4 68.1 22.3 48.6 25.6 97.3 7.9 139.9-17.7 42.6-54.6 74.6-104.9 93.1-1.7 16-2.6 32.3-2.6 48.7 0 16.1 0.9 32 2.5 47.6 50.2 18.6 87.1 50.8 104.7 93.4 17.6 42.6 14.1 91.3-8.2 139.9 20.2 25.1 43.1 48 68.3 68.3 48.6-22.2 97.3-25.5 139.8-7.8 42.4 17.6 74.3 54.3 92.9 104.2 15.8 1.7 31.9 2.6 48.2 2.6 16.5 0 32.7-0.9 48.7-2.6 18.7-49.8 50.7-86.3 93.1-103.8 42.2-17.4 90.6-14.2 138.8 7.7 25.4-20.4 48.5-43.5 68.9-68.9-21.8-48.2-24.9-96.5-7.3-138.7 17.5-42.1 53.9-74 103.3-92.5 1.8-16.2 2.7-32.7 2.7-49.3 0-16.3-0.9-32.4-2.6-48.2-49.8-19-86-50.9-103.5-93.1zM798 630.3c-21.8 52.5-21 110.8 0.6 168.3-57.5-21.7-115.8-22.7-168.3-1-52.6 21.7-93.2 63.5-118.6 119.4-25.3-56-65.8-97.9-118.3-119.7-25.8-10.7-53.1-16-80.9-16-28.8 0-58.2 5.6-87.4 16.6 21.7-57.5 22.7-115.8 1-168.3-21.7-52.6-63.5-93.2-119.4-118.6 56-25.3 97.9-65.8 119.7-118.3 21.8-52.5 21-110.8-0.6-168.3 29.4 11.1 59 16.8 87.9 16.8 27.7 0 54.7-5.2 80.4-15.8 52.6-21.7 93.2-63.5 118.6-119.4 25.3 56 65.8 97.9 118.3 119.7 52.5 21.8 110.8 21 168.3-0.6-21.7 57.5-22.7 115.8-1 168.3C820 446 861.8 486.6 917.7 512c-56 25.2-97.9 65.7-119.7 118.3z' fill='#45484C'></path></g></svg>
                                                                </a>
                                                                <ul class='dropdown-menu'>
                                                                    <li class='d-flex align-items-center'>
                                                                        <a style='cursor: pointer;' class='dropdown-item d-flex align-items-center fs-5' href='EditDetailProduct.php?idProduct=" . $id . "&id=" . $eachChiTiet['id'] ."'>
                                                                            <ion-icon name='create-outline'></ion-icon>
                                                                            <span class='ms-4'>Sửa</spam>
                                                                        </a>
                                                                    </li>
                                                                    <li class='d-flex align-items-center'>
                                                                        <a style='cursor: pointer;' class='dropdown-item d-flex align-items-center fs-5' href='DeleteDetailProduct.php?idProduct=" . $id . "&id=" . $eachChiTiet['id'] . "'>
                                                                            <ion-icon name='trash-outline'></ion-icon>
                                                                            <span class='ms-4'>Xoá</spam>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>";
                                            }
                                        } else {
                                            echo "<tr>";
                                                echo "<td class='text-center' colspan='4'>Chưa có sản phẩm chi tiết</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Modal Add -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true" style="background: rgb(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <form action="process_insert_product_detail.php?id=<?php echo $id;?>" method="post" enctype="multipart/form-data" class="form-add" style="height: 100%; width: 100%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-2" id="addleModalLabel">Thêm mới chi tiết sản phẩm</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body" style="overflow-x: hidden;">
                            <input hidden name="linkParent" type="text" value="EditProduct.php?id=<?php echo $id;?>">
                            <label class="fs-5 form-label" for="imgProduct">1. Nhập link ảnh sản phẩm (hoặc tải file): </label>
                            <br>
                            <div class="input-image row align-items-center">
                                <div class="col-6">
                                    <input id="imgProduct" name="img_product" class="form-control form-control-lg" type="text" placeholder="Link ảnh..." aria-label=".form-control-lg">
                                </div>
                                <div class="col-6">
                                    <label class="btn btn-default btn-file border">
                                        Chọn file <input type="file" name="img_product_file" accept="image/png, image/gif, image/jpeg" style="display: none;">
                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="image-product">
                                <div class="row row-cols-4 overflow-auto" style="max-width: 35%; max-height: 20rem;">
                                    <div class="col">
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="col-6">
                                <label class="fs-5 form-label required" for="priceProduct">2. Chọn thuộc tính: </label>
                                <div class="dropdown">
                                    <button class="btn btn-success dropdown-toggle"
                                        style="max-width: 11rem; min-width: 11rem;"
                                        type="button"
                                        id="multiSelectDropdown"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Lựa chọn
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="multiSelectDropdown">
                                        <!-- get properties -->
                                        <?php
                                            $stringSQL = "SELECT * FROM `thuoctinh`";
                                            $result = mysqli_query($connect, $stringSQL);
                                            if (mysqli_num_rows($result) > 0) {
                                                // get parent properties
                                                $lstthuoctinhcha = array();
                                                foreach ($result as $index => $each) {
                                                    if ($each['ten_thuoctinhcon'] == null){
                                                        array_push($lstthuoctinhcha, $each);
                                                    }
                                                }
                                                foreach ($lstthuoctinhcha as $index => $each) {
                                                    echo "
                                                        <label class='ms-2'>
                                                            " . $index + 1 . '. ' . $each['ten_thuoctinhcha'] . "
                                                        </label>";
                                                    // get child properties
                                                    foreach ($result as $eachChild) {
                                                        if ($eachChild['ten_thuoctinhcha'] == $each['ma_thuoctinh']){
                                                            $check = false;
                                                            // check property product
                                                            foreach ($resultChiTiet as $eachProduct) {
                                                                if ($eachProduct['ma_thuoctinh'] == $eachChild['ma_thuoctinh']) {
                                                                    $check = true;
                                                                }
                                                            }
                                                            if ($check) {
                                                                echo "<li class='ms-4'>
                                                                        <label>
                                                                            <span class='ms-2'>
                                                                                " . $eachChild['ten_thuoctinhcon'] . "
                                                                            </span>
                                                                        </label>
                                                                    </li>";
                                                            } else {
                                                                echo "<li class='ms-4'>
                                                                        <label>
                                                                            <input type='radio' name='property' value='" . $eachChild['ma_thuoctinh'] . "'>
                                                                            <span class='ms-2'>
                                                                                " . $eachChild['ten_thuoctinhcon'] . "
                                                                            </span>
                                                                        </label>
                                                                    </li>";
                                                            }
                                                        }
                                                    }
                                                }
                                            } else {
                                                echo "<li>
                                                        <label>
                                                            Không có thuộc tính nào
                                                        </label>
                                                    </li>";
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="fs-5 form-label required" for="quantityProduct">3. Nhập số lượng nhập: </label>
                                <br>
                                <input id="quantityProduct" name="quantity_product" class="form-control form-control-lg" type="number" placeholder="Số lượng..." aria-label=".form-control-lg" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../Admin/JS/js_edit_product.js"></script>
</body>
</html>