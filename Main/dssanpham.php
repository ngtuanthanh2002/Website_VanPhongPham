<style>
    <?php include 'CSS/body.css' ?>
</style>
<?php
require_once './connect/connect.php';
require_once './connect/funcion.php';

$stringSQL = "SELECT * FROM `sanpham` WHERE `ten_sanpham` LIKE '%$search%' ORDER BY `ngaytao` DESC LIMIT 0, $limit";
$result = mysqli_query($connect, $stringSQL);
?>
<div class="_home-outline3">
    <div class="_dm-head">
        <div class="_sanpham_text">SẢN PHẨM</div>
    </div>
    <div class="grid-items">
    <?php if (mysqli_num_rows($result) > 0) { foreach ($result as $index => $each) { ?>
        <a href="product.php?id=<?php echo $each['ma_sanpham'];?>" class="_IT1">
            <div class="_btn_product">
                <div class="width_pic">
                    <img class="picture_items" alt="..." src="
                    <?php
                        if (str_contains($each['anh_sanpham'], 'https')){
                            echo $each['anh_sanpham'];
                        }
                        else {
                            echo "../Admin/" . $each['anh_sanpham'];

                        }
                    ?>
                    ">
                </div>
                <div class="center-text">
                    <div class="_text-items2 max-line">
                        <?php echo $each['ten_sanpham'];?>
                    </div>
                </div>
                <div class="center-text">
                    <div class="_text-items3 max-line">
                        <?php echo product_price($each['gia_sanpham']);?>
                    </div>
                </div>
            </div>
        </a>
    <?php }} else {?>
        <div class="text-center" style="grid-column-start: 3; grid-column-end: 5;">
            <h3>Không tìm thấy sản phẩm nào</h3>
        </div>
    <?php }?>
    </div>
    <?php if (mysqli_num_rows($result) > 0) {?>
        <div>
            <form action="Allsanpham.php" method="post">
                <input type="hidden" name="limit" value="<?php echo (int)($limit + 12)?>">
                <div class="nut-xemthem">
                    <button type="submit" class="btn-xemthem">
                        Xem tất cả sản phẩm
                    </button>
                </div>
            </form>
        </div>
    <?php }?>
</div>
