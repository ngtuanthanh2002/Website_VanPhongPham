<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem chi tiết sản phẩm</title>
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
    <div class="modal" id="" tabindex="-1" style="display: block;">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen">
            <form action="ProductCategory.php" class="form-add" style="height: 100%; width: 100%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-2" id="addleModalLabel">Chi tiết sản phẩm</h1>
                        <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body" style="overflow-x: hidden;">
                        <label class="fs-5 form-label" for="nameProduct">Tên sản phẩm: </label>
                        <span class="ms-2 fs-3"> <?php echo $each['ten_sanpham']; ?></span>
                        <br>

                        <label class="fs-5 form-label" for="imgProduct">Ảnh sản phẩm: </label>
                        <br>
                        <div class="image-product">
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

                        <label class="fs-5 form-label " for="priceProduct">Giá bán sản phẩm: </label>
                        <span class="ms-2 fs-4"> <?php echo product_price($each['gia_sanpham']); ?></span>
                        <br>

                        <label class="fs-5 form-label " for="priceProduct">Mô tả sản phẩm: </label>
                        <br>
                        <span class="ms-2 fs-4"> <?php
                            if ($each['mota_sanpham'] != '') {
                                echo $each['mota_sanpham'];
                            } else {
                                echo 'Chưa có mô tả';
                            }
                        ?></span>
                        <br>

                        <label class="fs-5 form-label " for="priceProduct">Danh mục chi tiết sản phẩm: </label>
                        <br>
                        <div class="table-responsive" style="min-height: 348px;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 2%;">STT</th>
                                        <th class="text-center" style="width: 15%;">Ảnh</th>
                                        <th class="text-center">Thuộc tính</th>
                                        <th class="text-center" style="width: 10%;">Số lượng</th>
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
                                                        echo "<td style='width: 15%; text-align: -webkit-center;'>
                                                        <svg width='64px' height='64px' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><g id='SVGRepo_bgCarrier' stroke-width='0'></g><g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g><g id='SVGRepo_iconCarrier'> <path d='M8.42229 20.6181C10.1779 21.5395 11.0557 22.0001 12 22.0001V12.0001L2.63802 7.07275C2.62423 7.09491 2.6107 7.11727 2.5974 7.13986C2 8.15436 2 9.41678 2 11.9416V12.0586C2 14.5834 2 15.8459 2.5974 16.8604C3.19479 17.8749 4.27063 18.4395 6.42229 19.5686L8.42229 20.6181Z' fill='#1C274C'></path> <path opacity='0.7' d='M17.5774 4.43152L15.5774 3.38197C13.8218 2.46066 12.944 2 11.9997 2C11.0554 2 10.1776 2.46066 8.42197 3.38197L6.42197 4.43152C4.31821 5.53552 3.24291 6.09982 2.6377 7.07264L11.9997 12L21.3617 7.07264C20.7564 6.09982 19.6811 5.53552 17.5774 4.43152Z' fill='#1C274C'></path> <path opacity='0.5' d='M21.4026 7.13986C21.3893 7.11727 21.3758 7.09491 21.362 7.07275L12 12.0001V22.0001C12.9443 22.0001 13.8221 21.5395 15.5777 20.6181L17.5777 19.5686C19.7294 18.4395 20.8052 17.8749 21.4026 16.8604C22 15.8459 22 14.5834 22 12.0586V11.9416C22 9.41678 22 8.15436 21.4026 7.13986Z' fill='#1C274C'></path> <path d='M6.32334 4.48382C6.35617 4.46658 6.38926 4.44922 6.42261 4.43172L7.91614 3.64795L17.0169 8.65338L21.0406 6.64152C21.1783 6.79745 21.298 6.96175 21.4029 7.13994C21.5525 7.39396 21.6646 7.66352 21.7487 7.96455L17.7503 9.96373V13.0002C17.7503 13.4144 17.4145 13.7502 17.0003 13.7502C16.5861 13.7502 16.2503 13.4144 16.2503 13.0002V10.7137L12.7503 12.4637V21.9042C12.4934 21.9682 12.2492 22.0002 12.0003 22.0002C11.7515 22.0002 11.5072 21.9682 11.2503 21.9042V12.4637L2.25195 7.96455C2.33601 7.66352 2.44813 7.39396 2.59771 7.13994C2.70264 6.96175 2.82232 6.79745 2.96001 6.64152L12.0003 11.1617L15.3865 9.46857L6.32334 4.48382Z' fill='#1C274C'></path> </g></svg>
                                                            </td>";
                                                    }
                                                    echo "<td class='text-start'>
                                                            <span class='ms-4'>" . get_thuoctinh($eachChiTiet['ma_thuoctinh'], $connect) . "</span>
                                                        </td>";
                                                    echo "<td class='text-start' style='width: 10%;'>
                                                            <span class='ms-4'>" . $eachChiTiet['soluong'] . "</span>
                                                        </td>";
                                                    echo "</tr>";
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
                        <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Modal Add -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true" style="background: rgb(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <form action="process_insert_product.php" method="post" class="form-add" style="height: 100%; width: 100%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-2" id="addleModalLabel">Thêm mới chi tiết sản phẩm</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body" style="overflow-x: hidden;">
                            <label class="fs-5 form-label" for="imgProduct">2. Nhập link ảnh sản phẩm (hoặc tải file): </label>
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
                                                            echo "
                                                            <li class='ms-4'>
                                                                <label>
                                                                    <input type='radio' name='properties' value='" . $eachChild['ma_thuoctinh'] . "'>
                                                                    <span class='ms-2'>
                                                                        " . $eachChild['ten_thuoctinhcon'] . "
                                                                    </span>
                                                                </label>
                                                            </li>";
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