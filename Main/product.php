<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<?php
    include('header.php');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<?php
    require_once './connect/connect.php';
    require_once './connect/funcion.php';
    $search = "";
    $id = $_GET['id'];
    $stringSQL = "SELECT * FROM `sanpham` WHERE `ma_sanpham` = '$id'";
    $result = mysqli_query($connect, $stringSQL);

    $stringSQL = "SELECT * FROM `chitiet_sanpham` WHERE `ma_sanpham` = '$id'";
    $resultDetail = mysqli_query($connect, $stringSQL);

    // get thuộc tính
    $stringSQL = "SELECT * FROM `thuoctinh`";
    $resultProperty = mysqli_query($connect, $stringSQL);


    $lstIDPropertyParent = array();
    $lstIDPropertyChild = array();
    // lấy ra danh sách các thuộc tính mà sản phẩm có
    foreach ($resultDetail as $index => $each) {
        foreach($resultProperty as $item) {
            if ($each['ma_thuoctinh'] == $item['ma_thuoctinh']) {
                array_push($lstIDPropertyChild, $item);
            }
        }
    }
    // lấy ra danh sách các thuộc tính cha
    $maTTParent = "";
    foreach ($lstIDPropertyChild as $itemTT) {
        if ($itemTT['ten_thuoctinhcha'] != $maTTParent) {
            $maTTParent = $itemTT['ten_thuoctinhcha'];
            $strSQL = "SELECT * FROM `thuoctinh` WHERE `ma_thuoctinh` = '$maTTParent'";
            $resultTT = mysqli_query($connect, $strSQL);
            $itemTTParent = mysqli_fetch_array($resultTT);
            array_push($lstIDPropertyParent, $itemTTParent);
        }
    }
?>

<div class="toast-container position-fixed p-3" style="top: 80px; right: 50px;">
    <div id="liveToastAddToCart" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <?php
                if (isset($_SESSION['toast-success-add-to-cart'])) {
                    echo '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" xml:space="preserve" width="24px" height="24px" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#25AE88;" cx="25" cy="25" r="25"></circle> <polyline style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points=" 38,15 22,33 12,25 "></polyline> </g></svg>';
                    echo '<strong class="ms-2 me-auto">Thông báo</strong>';
                }
                if (isset($_SESSION['toast-error-add-to-cart'])) {
                    echo '<svg fill="#ff0000" width="24px" height="24px" viewBox="0 -8 528 528" xmlns="http://www.w3.org/2000/svg" stroke="#ff0000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title>fail</title><path d="M264 456Q210 456 164 429 118 402 91 356 64 310 64 256 64 202 91 156 118 110 164 83 210 56 264 56 318 56 364 83 410 110 437 156 464 202 464 256 464 310 437 356 410 402 364 429 318 456 264 456ZM264 288L328 352 360 320 296 256 360 192 328 160 264 224 200 160 168 192 232 256 168 320 200 352 264 288Z"></path></g></svg>';
                    echo '<strong class="ms-2 me-auto">Lỗi</strong>';
                }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?php
                if (isset($_SESSION['toast-success-add-to-cart'])) {
                    echo $_SESSION['toast-success-add-to-cart'];
                    unset($_SESSION['toast-success-add-to-cart']);
                    echo '<script>
                            var toastLive = document.getElementById("liveToastAddToCart")
                            var toast = new bootstrap.Toast(toastLive)
                            toast.show()
                        </script>';
                }
                if (isset($_SESSION['toast-error-add-to-cart'])) {
                    echo $_SESSION['toast-error-add-to-cart'];
                    unset($_SESSION['toast-error-add-to-cart']);
                    echo '<script>
                            var toastLive = document.getElementById("liveToastAddToCart")
                            var toast = new bootstrap.Toast(toastLive)
                            toast.show()
                        </script>';
                }
            ?>
        </div>
    </div>
</div>
<div class="center-header"></div>
<div class="body-color-product">
    <?php  foreach ($result as $index => $each) { ?>
    <div class="container-product flex">
        <div class="picture-product">
                <div class="link-product">
                    <img src="
                    <?php
                    if (str_contains($each['anh_sanpham'], 'https')){
                        echo $each['anh_sanpham'];
                    }
                    else {
                        echo "../Admin/" . $each['anh_sanpham'];
                    }
                    ?>
                    "
                    alt="..." " class="product-image"/>

                </div>
            <div class="list-pic-product">
                <button id="prev-slide" class="slide-button" style="display: none;">
                        <i class="fa-solid fa-angle-left"></i>
                </button>
                <div class="list-pic">
                    <?php foreach($resultDetail as $item) {?>
                        <img src="<?php
                            if (str_contains($item['anhs_sanpham'], 'https')){
                                echo $item['anhs_sanpham'];
                            }
                            else {
                                echo "../Admin/" . $item['anhs_sanpham'];
                            }
                        ?>" class="list-product-image" onclick="showImg(this.src)" " />
                    <?php }?>
                </div>
                <button id="next-slide" class="slide-button">
                    <i class="fa-solid fa-angle-right"></i>
                </button>
            </div>
        </div>
        <div class="details-product">
            <div class="details-header">
                <div class="text-header">
                    <?php echo $each['ten_sanpham'];?>
                </div>
                <div class="details-prices">
                    <div class="text-prices">
                        <?php echo product_price($each['gia_sanpham']);?>
                    </div>
                </div>
                <div class="details-choose">
                    <?php foreach($lstIDPropertyParent as $propertyParent) {?>
                        <div class="color-details">
                            <div class="header-color"><?php echo $propertyParent['ten_thuoctinhcha'];?></div>
                            <div class="x099">
                                <?php foreach($lstIDPropertyChild as $propertyChild) {
                                    if ($propertyChild['ten_thuoctinhcha'] == $propertyParent['ma_thuoctinh']) {
                                        foreach($resultDetail as $itemProductDetail) {
                                            if ($itemProductDetail['ma_thuoctinh'] == $propertyChild['ma_thuoctinh']) {
                                                $idproductChild = $itemProductDetail['id'];
                                            }
                                        }
                                ?>
                                    <button id="<?php echo $propertyChild['ma_thuoctinh'];?>" data-productChild="<?php echo $idproductChild;?>" class="details-button" onclick="clickBtnProperty(this, event)">
                                        <?php echo $propertyChild['ten_thuoctinhcon'];?>
                                    </button>
                                <?php }
                                }?>
                            </div>
                        </div>
                    <?php }?>
                </div>
                <form action="muangay.php" method="post">
                    <input type="text" hidden name="idProduct" value="<?php echo $id;?>">
                    <input type="text" hidden name="idProductDetail" value="">
                    <div class="details-choose">
                        <div class="color-details">
                            <div class="header-color">Số lượng</div>
                            <div class="x0100">
                                <button type="button" class="button-subtr" onclick="decreaseQuantity()">-</button>
                                <input name="quantity" class="input-quantity" id="quantityInput" oninput="changeQuantity()" value="1">
                                <button type="button" class="button-subtr" onclick="increaseQuantity()">+</button>
                            </div>
                            <div class="message-error"></div>
                        </div>
                    </div>
                    <div class="details-buy">
                        <div class="color-details">
                            <div>
                                <button type="button" class="add-giohang" onclick="AddToCart('<?php echo $id; ?>')">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span>
                                        Thêm Vào Giỏ Hàng
                                    </span>
                                </button>
                                    
                                <button type="submit" class="muaHang">
                                    Mua Ngay
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <?php }?>
</div>
<div class="center-header"></div>
<div class="body-color-product">
    <div class="container-product flex">
        <div class="head-ttsp">
            <div class="tt-sp">THÔNG TIN SẢN PHẨM</div>
        </div>

    </div>
    <?php  foreach ($result as $index => $each) { ?>
        <div class="inf-product">
        <div class="text-inf-product">
            <?php
            if ($each['mota_sanpham'] != '') {
                echo $each['mota_sanpham'];
            } else {
                echo 'Chưa có mô tả';
            }
            ?>
        </div>
    </div>
    <?php }?>
   <div class="bottom-ttsp"></div>
</div>

<?php
    include('Footer.php');
?>
<script>
    <?php include 'product.js' ?>
</script>

<style>
    <?php include 'CSS/Product.css' ?>
</style>
