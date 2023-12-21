<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem chi tiết đơn hàng</title>
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
        require_once './ShareAdmin/root/connect.php';
        require_once './ShareAdmin/root/funcion.php';
        $id = $_GET['id'];

        // Lấy thông tin đơn hàng
        $stringSQL = "SELECT * FROM `hoadon` WHERE `ma_hoadon` = '$id'";
        $result = mysqli_query($connect, $stringSQL);
        $each = mysqli_fetch_array($result);

        // Lấy thông tin chi tiết đơn hàng
        $sqlDetail = "SELECT * FROM `chitiet_hoadon` WHERE `ma_hoadon` = '$id'";
        $resultDetail = mysqli_query($connect, $sqlDetail);

        // Lấy thông tin địa chỉ giao hàng
        $sqlAddress = "SELECT * FROM `diachi_nhanhang` WHERE `id` = '" . $each['ma_diachi_nhanhang'] . "'";
        $resultAddress = mysqli_query($connect, $sqlAddress);
        $eachAddress = mysqli_fetch_array($resultAddress);

        // Lấy thông tin khách hàng
        $sqlCustomer = "SELECT * FROM `customers` WHERE `customerID` = '" . $each['customerID'] . "'";
        $resultCustomer = mysqli_query($connect, $sqlCustomer);
        $eachCustomer = mysqli_fetch_array($resultCustomer);

        function getThuocTinh($id, $connect) {
            $stringSQL = "SELECT * FROM `thuoctinh`";
            $resultTT = mysqli_query($connect, $stringSQL);
            $eachTT = mysqli_fetch_array($resultTT);

            $ten_thuoctinhcon = '';
            $ten_thuoctinhcha = '';
            foreach ($resultTT as $eachTT) {
                if ($eachTT['ma_thuoctinh'] == $id) {
                    $ten_thuoctinhcon = $eachTT['ten_thuoctinhcon'];

                    foreach ($resultTT as $eachV2) {
                        if ($eachV2['ma_thuoctinh'] == $eachTT['ten_thuoctinhcha']) {
                            $ten_thuoctinhcha = $eachV2['ten_thuoctinhcha'];
                            break;
                        }
                    }
                    break;
                }
            }
            return $ten_thuoctinhcha . ': ' . $ten_thuoctinhcon;
        }
    ?>
    <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                    <div class="col-xl-6">
                        <a href="Invoice.php" style="color: #7e8d9f;font-size: 15px;">&#60;&#60; <strong>Quay lại</strong></a>
                    </div>
                    <div class="col-xl-6 text-end">
                        <p style="color: #7e8d9f;font-size: 20px;">Hoá Đơn: <strong>#<?php echo $each['ma_hoadon'];?></strong></p>
                    </div>
                </div>
                <div class="container">
                    <div class="col-md-12">
                        <div class="text-center">
                            <img src="./IMG/logo.png" alt="..." srcset="">
                            <p class="fs-4 pt-2 text-uppercase">Hoàng Hà Stationery</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-9">
                            <ul class="list-unstyled">
                                <li class="text-muted">Người nhận: <span style="color:#8f8061 ;"><?php echo $eachAddress['ten_nguoinhan'];?></span></li>
                                <li class="text-muted"><?php echo $eachAddress['diachi'];?></li>
                                <li class="text-muted"><?php echo $eachAddress['xa'] . ' - ' . $eachAddress['huyen'] . ' - ' . $eachAddress['tinh'];?></li>
                                <li class="text-muted"><ion-icon name="call-outline"></ion-icon></i> <?php echo $eachAddress['sdt_nguoinhan']?></li>
                            </ul>
                        </div>
                        <div class="col-xl-3">
                            <p class="text-muted">Hoá đơn</p>
                            <ul class="list-unstyled">
                                <li class="text-muted">
                                    <i class="fas fa-circle" style="color:#8f8061 ;"></i>
                                    <span class="fw-bold">Mã hoá đơn: </span>#<?php echo $each['ma_hoadon']?>
                                </li>
                                <li class="text-muted">
                                    <i class="fas fa-circle" style="color:#8f8061 ;"></i>
                                    <span class="fw-bold">Ngày tạo: </span><?php echo date_format(date_create($each['createdDate']), "d/m/Y");?>
                                </li>
                                <li class="text-muted">
                                    <i class="fas fa-circle" style="color:#8f8061;"></i>
                                    <span class="me-1 fw-bold">Trạng thái: </span>
                                <?php if ($each['trangthai'] == 0) {?>
                                    <span class="badge bg-warning text-black fw-bold">Chưa duyệt</span>
                                <?php } else if ($each['trangthai'] == 1) {?>
                                    <span class="badge bg-success text-white fw-bold">Đã duyệt</span>
                                <?php }?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                <?php foreach($resultDetail as $itemDteail) {
                    $sqlDetailProduct = "
                        SELECT ctsp.*, sp.ten_sanpham, sp.gia_sanpham FROM `chitiet_sanpham` ctsp
                        INNER JOIN `sanpham` sp ON ctsp.ma_sanpham = sp.ma_sanpham
                        WHERE `id` = '" . $itemDteail['id_ct_sanpham'] . "'";
                    $resultDetailProduct = mysqli_query($connect, $sqlDetailProduct);
                    $eachDetailProduct = mysqli_fetch_array($resultDetailProduct);
                ?>
                    <div class="row my-2 mx-1 justify-content-center">
                        <div class="col-md-2 mb-4 mb-md-0">
                            <div class="bg-image ripple rounded-5 mb-4 overflow-hidden d-block" data-ripple-color="light">
                                <object class='img-thumbnail' style='max-width: 5rem; text-align: -webkit-center;' data='<?php echo $eachDetailProduct['anhs_sanpham'];?>' type='image/png'>
                                    <svg width='64px' height='64px' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><g id='SVGRepo_bgCarrier' stroke-width='0'></g><g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round'></g><g id='SVGRepo_iconCarrier'> <path d='M8.42229 20.6181C10.1779 21.5395 11.0557 22.0001 12 22.0001V12.0001L2.63802 7.07275C2.62423 7.09491 2.6107 7.11727 2.5974 7.13986C2 8.15436 2 9.41678 2 11.9416V12.0586C2 14.5834 2 15.8459 2.5974 16.8604C3.19479 17.8749 4.27063 18.4395 6.42229 19.5686L8.42229 20.6181Z' fill='#1C274C'></path> <path opacity='0.7' d='M17.5774 4.43152L15.5774 3.38197C13.8218 2.46066 12.944 2 11.9997 2C11.0554 2 10.1776 2.46066 8.42197 3.38197L6.42197 4.43152C4.31821 5.53552 3.24291 6.09982 2.6377 7.07264L11.9997 12L21.3617 7.07264C20.7564 6.09982 19.6811 5.53552 17.5774 4.43152Z' fill='#1C274C'></path> <path opacity='0.5' d='M21.4026 7.13986C21.3893 7.11727 21.3758 7.09491 21.362 7.07275L12 12.0001V22.0001C12.9443 22.0001 13.8221 21.5395 15.5777 20.6181L17.5777 19.5686C19.7294 18.4395 20.8052 17.8749 21.4026 16.8604C22 15.8459 22 14.5834 22 12.0586V11.9416C22 9.41678 22 8.15436 21.4026 7.13986Z' fill='#1C274C'></path> <path d='M6.32334 4.48382C6.35617 4.46658 6.38926 4.44922 6.42261 4.43172L7.91614 3.64795L17.0169 8.65338L21.0406 6.64152C21.1783 6.79745 21.298 6.96175 21.4029 7.13994C21.5525 7.39396 21.6646 7.66352 21.7487 7.96455L17.7503 9.96373V13.0002C17.7503 13.4144 17.4145 13.7502 17.0003 13.7502C16.5861 13.7502 16.2503 13.4144 16.2503 13.0002V10.7137L12.7503 12.4637V21.9042C12.4934 21.9682 12.2492 22.0002 12.0003 22.0002C11.7515 22.0002 11.5072 21.9682 11.2503 21.9042V12.4637L2.25195 7.96455C2.33601 7.66352 2.44813 7.39396 2.59771 7.13994C2.70264 6.96175 2.82232 6.79745 2.96001 6.64152L12.0003 11.1617L15.3865 9.46857L6.32334 4.48382Z' fill='#1C274C'></path> </g></svg>
                                </object>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 mb-md-0">
                            <p class="fw-bold"><?php echo $eachDetailProduct['ten_sanpham'];?></p>
                            <p class="mb-1">
                                <span class="text-muted me-2"><?php echo getThuocTinh($eachDetailProduct['ma_thuoctinh'], $connect)?></span>
                            </p>
                        </div>
                        <div class="col-md-3 mb-4 mb-md-0">
                            <p class="fw-bold">...</p>
                            <p class="mb-1">
                                <span class="text-muted me-2">Số lượng:</span><span><?php echo $itemDteail['soluong'];?></span>
                            </p>
                        </div>
                        <div class="col-md-3 mb-4 mb-md-0">
                            <p class="fw-bold">Giá bán</p>
                            <h5 class="mb-2">
                                <span class="align-middle"><?php echo product_price($eachDetailProduct['gia_sanpham'])?></span>
                            </h5>
                        </div>
                    </div>
                    <hr>
                <?php }?>
                    <div class="row">
                        <div class="col-xl-8">
                            
                        </div>
                        <div class="col-xl-3">
                            <table style="width: 100%;">
                                <tr>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr class="row mt-2 align-items-center">
                                    <td class="col-6 text-end">Thành tiền:</td>
                                    <td class="col-6"><?php echo product_price($each['tienthanhtoan'] - $each['phivc'])?></td>
                                </tr>
                                <tr class="row mt-2 align-items-center">
                                    <td class="col-6 text-end">Phí vận chuyển:</td>
                                    <td class="col-6"><?php echo product_price($each['phivc'])?></td>
                                </tr>
                                <tr class="row mt-4 align-items-center">
                                    <td class="col-6 text-black fs-4 text-end">Tổng tiền:</td>
                                    <td class="col-6"><?php echo product_price($each['tienthanhtoan'])?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php if ($each['trangthai'] == 0) {?>
    <div class="container mt-3">
        <div class="row text-end flex-row-reverse">
            <div class="col-3">
                <button type="button" class="btn btn-success text-white">
                    <a href="ApproveInvoice.php?id=<?php echo $id;?>">Duyệt đơn hàng</a>
                </button>
            </div>
        </div>
    </div>
<?php }?>

    <script src="../Admin/JS/js_edit_product.js"></script>
</body>
</html>