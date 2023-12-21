<?php
    session_start();
    if (!isset($_SESSION['user'])){
        header('Location: Login.php');
        die();
    }
    
    require_once './connect/connect.php';
    require_once './connect/funcion.php';
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
    <?php
        

    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <style>
        <?php
            include 'CSS/Login.css';
            include 'CSS/cart.css';
            include 'CSS/Hotro.css';
            include 'CSS/header.css';
            include 'CSS/Product.css';
        ?>
    </style>
</head>
<body>
    
<div class="login-war1" >
    <div class="logo-icon">
            <a href="index.php" class="logo-click">
                <div class="size-logo-icon">
                    <img class="image-logo-login" src="picture/logoHH-do.png">
                </div>
            </a>
        <div class="x0102"></div>
        <div class="x0101">Giỏ hàng</div>
    </div>
</div >
<div class="body-giohang">
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
    <?php
        if (isset($_SESSION['cart']) && $_SESSION['cart'] != null) {
            $cart = $_SESSION['cart'];
            // die(json_encode($cart));
    ?>
    <form action="thanhtoan.php" method="post">
        <div class="container3">
            <div class="header-thaotac">
                <div class="P-sanpham">Sản phẩm</div>
                <div class="P-dongia">Đơn giá</div>
                <div class="P-dongia">Số lượng</div>
                <div class="P-dongia">Số tiền</div>
                <div class="P-dongia">Thao tác</div>
            </div>
            <div class="EOP">
                <div class="AOVV">
                <?php
                    foreach ($cart as $id => $each) {
                        $sqlTT = "
                            SELECT ctsp.soluong, tt.ten_thuoctinhcon, tt.ten_thuoctinhcha FROM
                            `thuoctinh` tt INNER JOIN `chitiet_sanpham` ctsp
                            ON tt.`ma_thuoctinh` = ctsp.`ma_thuoctinh`
                            WHERE tt.`ma_thuoctinh` = '" . $each['idproperty'] . "'";
                        $resultTT = mysqli_query($connect, $sqlTT);
                        $eachTT = mysqli_fetch_array($resultTT);

                        $sqlTTCha = "SELECT * FROM `thuoctinh` WHERE `ma_thuoctinh` = '" . $eachTT['ten_thuoctinhcha'] . "'";
                        $resultTTCha = mysqli_query($connect, $sqlTTCha);
                        $eachTTCha = mysqli_fetch_array($resultTTCha);
                ?>
                    <div class="AOV">
                        <div>
                            <div class="in-label me-3">
                                <input type="text" hidden name="ids[]" value="<?php echo $id;?>">
                                <input onchange="calTotal(event)" type="checkbox" name="productFromCart[]" value="<?php echo $each['idDetail'];?>" class="product-checkbox" id="myCheckbox_<?php echo $each['idDetail']; ?>">
                                <label for="myCheckbox_<?php echo $each['idDetail']; ?>"></label>
                            </div>
                        </div>
                        <div class="BOV">
                            <div class="BOV">
                                <div style="width: 100px; height: 100px;   display: block; overflow: hidden;">
                                    <img src="
                                <?php
                                    if (str_contains($each['image'], 'https')){
                                        echo $each['image'];
                                    }
                                    else {
                                        echo "../Admin/" . $each['image'];
                                    }
                                    ?>" style="width: 100%; height: 100%" alt="..">
                                </div>
                                <input type="text" hidden name="images[]" value="<?php echo $each['image'];?>">
                                <div class="ten-giohang">
                                    <div class="max-text-giohang">
                                        <?php echo $each['name'];?>
                                    </div>
                                <input type="text" hidden name="names[]" value="<?php echo $each['name'];?>">
                                </div>
                            </div>


                            <div class="navigation-button flex-column">
                                <label>Phân loại hàng</label>
                                <input type="text" hidden name="properties[]" value="<?php echo $eachTTCha['ten_thuoctinhcha'] . ": ". $eachTT['ten_thuoctinhcon'];?>">
                                <span><?php echo $eachTTCha['ten_thuoctinhcha'] . ": ". $eachTT['ten_thuoctinhcon'];?></span>
                            </div>


                            <div class="BOV dongia">
                                <input type="text" hidden name="price[]" value="<?php echo $each['price'];?>">
                                <?php echo product_price($each['price']);?>
                            </div>
                            <div class="BOV soluong">
                                <div style="display: flex;">
                                    <button type="button" class="button-subtr" onclick="decreaseQuantity(<?php echo $each['idDetail'] . ',' . $each['price'];?>)">-</button>
                                    <input name="quantity[]" class="input-quantity quantity-<?php echo $each['idDetail'];?>" id="quantityInput" oninput="changeQuantity(<?php echo $each['idDetail'] . ',' . $each['price'];?>)" max="<?php echo $eachTT['soluong'];?>" value="<?php echo $each['quantity'];?>">
                                    <button type="button" class="button-subtr" onclick="increaseQuantity(<?php echo $each['idDetail'] . ',' . $each['price'];?>)">+</button>
                                </div>
                            </div>
                            <div class="BOV sotien span-don-gia sp-<?php echo $each['idDetail'];?>">
                                <?php echo product_price($each['quantity'] * $each['price']);?>
                            </div>
                            <div class="BOV thaotac">
                                <a href="delete_from_cart.php?idProduct=<?php echo $each['idDetail'];?>">
                                    <i class="fa-solid fa-trash-can delete-icon"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>

            <div class="sticky-top-giohang">
                <div class="flex FOP">
                    <div class="in-label">
                        <input type="checkbox" id="myCheckbox_final">
                        <label for="myCheckbox_final"></label>
                    </div>
                    <div class="text-choose">
                        Chọn tất cả
                    </div>
                    <div style="flex: 1"></div>
                        <div style="margin-right: 15px">
                            Tổng thanh toán:
                        </div>
                        <input type="text" hidden name="totalPrice">
                        <div id="totalPrice" class="text-thanhtoan">
                            0 VND
                        </div>
                    <div>
                        <button disabled id="btnSubmit" type="submit" class="btn-muahang">Mua hàng</button>
                    </div>
                </div>
            </div>

            <?php } else {
                ?>
                    <div class="ten-giohang">
                        <div class="max-text-giohang" style="width: 100%; text-align: center;">
                            Giỏ hàng trống
                        </div>
                    </div>

                <?php }?>
        </div>
    </form>
</div>
<script>
    <?php include 'script_giohang.js' ?>
    function chuyenhuongMua() {
        window.location.href = 'thanhtoan.php';
    }
</script>
<?php
include('Footer.php');
?>
</body>
</html>