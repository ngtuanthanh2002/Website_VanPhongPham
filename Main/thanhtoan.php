<?php
    session_start();
    if (!isset($_SESSION['user'])){
        header('Location: Login.php');
        die();
    }
                
    if (isset($_POST['productFromCart'])) {
        $ids = $_POST['ids'];
        $productFromCart = $_POST['productFromCart'];
        $images = $_POST['images'];
        $name = $_POST['names'];
        $properties = $_POST['properties'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $totalPrice = $_POST['totalPrice'];
    } else {
        $_SESSION['toast-error'] = "Bạn chưa chọn sản phẩm nào!";
        header('Location: view_cart.php');
        exit();
    }

    require_once './connect/connect.php';
    require_once './connect/funcion.php';
    $stringSQL = "SELECT * FROM `diachi_nhanhang` WHERE `customerID` = '" . $_SESSION['user']['customerID'] . "'";
    $address = mysqli_query($connect, $stringSQL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" href="picture/logo-web.png" type="image/x-icon">
    <title>
        Hoàng Hà Stationery - Mua bán đồ dùng văn phòng phẩm
    </title>
    
    <style>
        <?php
            include 'CSS/Login.css';
            include 'CSS/cart.css';
            include 'CSS/Hotro.css';
            include 'CSS/header.css';
            include 'CSS/Product.css';
            include 'CSS/thanhToan.css';
        ?>
    </style>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <div class="sticky-top">
        <div class="_header1">
            <nav class="container-header">
                <div class="flex v-center">
                    <div style="margin-top: 2px; margin-bottom: 2px">
                        <a class="text-color-white-ha hover">Hotline: 0999.999.999 </a>
                        <span class="_span-space text-color-white-ga">|</span>
                        <a class="text-color-white-ha hover">
                            Address: 123 Lĩnh Nam - Hoàng Mai - Hà Nội
                        </a>
                        <span class="_span-space text-color-white-ga">|</span>
                        <a class="text-color-white-ha">Kết nối: </a>
                        <a href="https://www.facebook.com" target="_blank" class="linked">
                            <i class="fab fa-facebook text-color-white-ha"></i>
                        </a>
                        <a href="https://www.instagram.com" target="_blank" class="linked">
                            <i class ="fab fa-instagram text-color-white-ha"></i>
                        </a>
                    </div>

                </div>
                <div class="navbar__spacer">
                </div>
                <ul class="flex v-center">
                    <a class="text-color-white-ha hover" style="cursor: pointer" onclick="chuyenHuong3()">
                        <span>
                            <i class="fas fa-question-circle"></i>
                        </span>
                        Liên hệ
                    </a>
                </ul>
                <?php
                if (isset($_SESSION['user'])) {
                    ?>
                    <div class="dropdown">
                        <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="color: white; cursor: pointer;">
                            <?php echo $_SESSION['user']["name"]; ?>
                        </div>
                        <ul class="dropdown-menu">
                            <?php if (isset($_SESSION['admin'])) {?>
                                <li><a class="dropdown-item" href="../Admin/index.php">Trang Admin</a></li>
                            <?php } ?>
                            <li><a class="dropdown-item" href="User_Infor.php">Thông tin cá nhân</a></li>
                            <li><a class="dropdown-item" href="logout.php">Đăng xuất</a></li>
                        </ul>
                    </div>
                    <?php
                } else {
                    ?>
                    <ul class=" flex v-center" style="margin-bottom: 0;">
                        <a class="text-color-white-ha hover" href="#register" onclick="chuyenHuong()">Đăng ký</a>
                        <span class="_span-space text-color-white-ga">|</span>
                        <a class="text-color-white-ha hover" href="#login" onclick="chuyenHuong2()">Đăng nhập</a>
                    </ul>
                <?php }?>
            </nav>
        </div>

    </div>

    <div class="login-war1" >
        <div class="logo-icon">
            <a href="index.php" class="logo-click">
                <div class="size-logo-icon">
                    <img class="image-logo-login" src="picture/logoHH-do.png">
                </div>
            </a>
            <div class="x0102"></div>
            <div class="x0101">Thanh toán</div>
        </div>
    </div >


    <form action="approve_order.php" method="post">
        <div style="background-color: #F7F7F7">
            <div class="container-thanhtoan">
                <div class="diachi-thanhtoan">
                <?php foreach($address as $item_default) {
                    if ($item_default['macdinh'] == 1) {?>
                    
                    <input id="delivery-address" type="text" hidden name="delivery-address" value="<?php echo $item_default['id'];?>">
                    <div style="color: #cc0621; font-size: 18px;">
                        <i class="fa-solid fa-location-dot"></i>
                        Địa Chỉ Nhận Hàng
                    </div>
                    <div class="flex justify-content-evenly">
                        <div class="name-thanhtoan">
                            <div id="name-default"><?php echo $item_default['ten_nguoinhan'];?></div>
                            <div id="phone-default"><?php echo $item_default['sdt_nguoinhan'];?></div>
                        </div>
                        <div id="address-default" class="address-thanhtoan">
                            <?php echo $item_default['diachi'];?>
                        </div>
                        <div class="btn-thanhtoan">
                            <button type="button" class="btn-thaydoi" data-bs-toggle="modal" data-bs-target="#addressModal">Thay đổi</button>
                        </div>
                    </div>
                <?php }}?>
                </div>

                <div style="padding-bottom: 25px;">
                    <div class="product-thanhtoan">
                        <div class="header-thaotac2">
                            <div class="P-sanpham2">Sản phẩm</div>
                            <div class="P-dongia2">Đơn giá</div>
                            <div class="P-soluong2">Số lượng</div>
                            <div class="P-thanhtien2">Thành tiền</div>
                        </div>
                    </div>

                    <div style="background-color: white; ">
                    
                    <?php for ($index = 0; $index < count($productFromCart); $index++) { ?>
                        <div style="border-bottom: 1px dashed rgba(0,0,0,.09);"></div>
                        <div style="padding-bottom: 20px; display: flex; align-items: center">
                            <input hidden type="text" name="ids[]" value="<?php echo $ids[$index];?>">
                            <input hidden type="text" name="prices-product[]" value="<?php echo $price[$index];?>">
                            <input hidden type="text" name="quantities-product[]" value="<?php echo $quantity[$index];?>">

                            <div class="img-thanhtoan">
                                <img src="
                                <?php
                                    if (str_contains($images[$index], 'https')){
                                        echo $images[$index];
                                    }
                                    else {
                                        echo "../Admin/" . $images[$index];
                                    }
                                ?>
                                " style="width: 100%; height: 100%" alt="...">
                            </div>
                            <div class="text-sanpham-thanhtoan">
                                <?php echo $name[$index]?>
                            </div>
                            <div class="loai-thanhtoan">
                                <?php echo $properties[$index]?>
                            </div>
                            <div class="dongia-thanhtoan">
                                <?php echo product_price($price[$index]);?>
                            </div>
                            <div class="dongia-thanhtoan">
                                <?php echo $quantity[$index]?>
                            </div>
                            <div class="thanhtien-thanhtoan">
                                <?php echo product_price($price[$index] * $quantity[$index]);?>
                            </div>
                        </div>
                    <?php } ?>

                    </div>
                </div>

                <div style="padding-bottom: 25px">
                    <div class="form-thanhtoan">
                        <div style=" padding: 20px; color: #cc0621; font-size: 20px">Tổng thanh toán</div>
                        <div style="border-bottom: 1px dashed rgba(0,0,0,.09);"></div>
                        <div class="details-thanhtoan" >
                            <div id="tongtienhang" class="T01">
                                <div class="line1">Tổng tiền hàng: </div>
                                <div class="line2 fs-5"><?php echo product_price($totalPrice);?></div>
                            </div>
                            <div id="phivc" class="T01">
                                <div class="line1">Phí vận chuyển: </div>
                                <div class="line2 fs-5">
                                <?php
                                    foreach($address as $item_default) {
                                        if ($item_default['macdinh'] == 1) {
                                            if (str_contains(strtolower($item_default['tinh']), 'hà nội') && $totalPrice >= 100000) {
                                                echo "Miễn phí </div>";
                                                echo "<input hidden type='text' name='fee-ship' value='0'>";
                                            } elseif(str_contains(strtolower($item_default['tinh']), 'hà nội')) {
                                                echo "30.000 VND </div>";
                                                echo "<input hidden type='text' name='fee-ship' value='30000'>";
                                            } else {
                                                echo "50.000 VND </div>";
                                                echo "<input hidden type='text' name='fee-ship' value='50000'>";
                                            }
                                        }
                                    }
                                ?>
                            </div>
                            <div id="tongtt" class="T01">
                                <div class="line1">Tổng thanh toán: </div>
                                <div class="line3 fs-5"></div>
                            </div>
                        </div>
                        <div style="border-bottom: 1px dashed rgba(0,0,0,.09);"></div>
                        <div style="padding: 25px; display: flex">
                            <div style="color: #737373; display: flex; align-items: center; font-size: 14px">Kiểm tra lại thông tin trước khi nhấn "Đặt Hàng"</div>
                            <div style="flex: 1"></div>
                            <button class="btn-dathang" id="btn-dathang">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal Address -->
    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addressModalLabel">Chọn địa chỉ nhận hàng</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <?php foreach($address as $item_address) {?>
                <div class="row mt-1 mb-2">
                    <div class="col-3">
                        <label class="name"><?php echo $item_address['ten_nguoinhan'];?></label>
                        <br>
                        <label class="phone"><?php echo $item_address['sdt_nguoinhan'];?></label>
                    </div>
                    <div class="col-7">
                        <label>Địa chỉ: </label>
                        <br>
                        <label class="address">
                            <?php echo $item_address['diachi'];?>
                        </label>
                        <label style="display: none;" class="address-province">
                            <?php echo $item_address['tinh'];?>
                        </label>
                    </div>
                    <div class="col-2 text-end <?php if ($item_address['macdinh'] == 1) echo "d-none";?> row-diachi">
                        <button id="<?php echo $item_address['id'];?>" onclick="changeDiaChi(event)" class="btn btn-primary" data-bs-dismiss="modal">Chọn</button>
                    </div>
                </div>
                <div class="mb-2" style="border-bottom: 1px dashed rgba(0,0,0,.3);"></div>
            <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
            </div>
            </div>
        </div>
    </div>

    <script src="./thanhtoan.js"></script>
    <?php
        include('Footer.php');
    ?>
</body>
</html>
