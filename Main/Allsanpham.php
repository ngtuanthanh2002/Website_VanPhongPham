<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<?php
    include('header.php');
?>
<?php
    require_once './connect/connect.php';
    require_once './connect/funcion.php';

    $checkLoc = isset($_POST['checkLoc']) ? $_POST['checkLoc'] : [];
    if (count($checkLoc) > 0) {
        $stringSQL = "SELECT * FROM `sanpham` WHERE (";
        foreach ($checkLoc as $index => $each) {
            if ($index == 0) {
                $stringSQL .= "`ten_sanpham` LIKE '%$each%'";
            } else {
                $stringSQL .= " OR `ten_sanpham` LIKE '%$each%'";
            }
        }
        $stringSQL .= ") ORDER BY `ngaytao` DESC";
    } else {
        $stringSQL = "SELECT * FROM `sanpham` WHERE `ten_sanpham` LIKE '%$search%' ORDER BY `ngaytao` DESC";
    }

    $result = mysqli_query($connect, $stringSQL);
?>

<style>
    <?php
        include 'CSS/body.css';
        include 'CSS/Allsp.css';
    ?>
</style>
<div style="background-color: #F7F7F7;">
<div class="container-allsp">
<div class="_home-outline3">
    <div class="_dm-head">
        <div class="_sanpham_text" style=" width: 100%;align-items: center;justify-content: center;">
            SẢN PHẨM
        </div>
    </div>
    <div style="display: flex">
        <div class="boloc-sanpham">
            <div style="padding-top: 5px; padding-bottom: 15px">
                <i class="fa-solid fa-filter"></i>
                BỘ LỌC TÌM KIẾM
            </div>
            <div style="padding-bottom: 15px">
                Theo danh mục
            </div>
            <div>
                <div>
                    <form action="Allsanpham.php" method="post">
                        <div class="in-label me-3 pd">
                            <input name="checkLoc[]" type="checkbox" <?php foreach ($checkLoc as $eachLoc) { if (str_contains('Giấy các loại', $eachLoc)) echo 'checked';}?> class="product-checkbox2" style="cursor: pointer" value="Giấy"> Giấy các loại
                        </div>
                        <div class="in-label me-3 pd">
                            <input name="checkLoc[]" type="checkbox"  <?php foreach ($checkLoc as $eachLoc) { if (str_contains('Bút các loại', $eachLoc)) echo 'checked';}?> class="product-checkbox2" style="cursor: pointer" value="Bút"> Bút các loại
                        </div>
                        <div class="in-label me-3 pd">
                            <input name="checkLoc[]" type="checkbox"  <?php foreach ($checkLoc as $eachLoc) { if (str_contains('Ghế', $eachLoc)) echo 'checked';}?> class="product-checkbox2" style="cursor: pointer" value="Ghế"> Ghế
                        </div>
                        <div class="in-label me-3 pd">
                            <input name="checkLoc[]" type="checkbox"  <?php foreach ($checkLoc as $eachLoc) { if (str_contains('Mực', $eachLoc)) echo 'checked';}?> class="product-checkbox2" style="cursor: pointer" value="Mực"> Mực
                        </div>
                        <div class="in-label me-3 pd">
                            <input name="checkLoc[]" type="checkbox"  <?php foreach ($checkLoc as $eachLoc) { if (str_contains('Sổ tay', $eachLoc)) echo 'checked';}?> class="product-checkbox2" style="cursor: pointer" value="Sổ tay"> Sổ tay
                        </div>
                        <div class="in-label me-3 pd">
                            <input name="checkLoc[]" type="checkbox"  <?php foreach ($checkLoc as $eachLoc) { if (str_contains('Bìa đựng hồ sơ', $eachLoc)) echo 'checked';}?> class="product-checkbox2" style="cursor: pointer" value="Bìa đựng"> Bìa đựng hồ sơ
                        </div>
                        <div class="in-label me-3 pd">
                            <input name="checkLoc[]" type="checkbox"  <?php foreach ($checkLoc as $eachLoc) { if (str_contains('Dao dọc giấy', $eachLoc)) echo 'checked';}?> class="product-checkbox2" style="cursor: pointer" value="Dao dọc giấy"> Dao dọc giấy
                        </div>
                        <div class="in-label me-3 pd">
                            <input name="checkLoc[]" type="checkbox"  <?php foreach ($checkLoc as $eachLoc) { if (str_contains('Kéo', $eachLoc)) echo 'checked';}?> class="product-checkbox2" style="cursor: pointer" value="Kéo"> Kéo
                        </div>
                        <div class="in-label me-3 pd">
                            <input name="checkLoc[]" type="checkbox"  <?php foreach ($checkLoc as $eachLoc) { if (str_contains('Giỏ đựng đồ', $eachLoc)) echo 'checked';}?> class="product-checkbox2" style="cursor: pointer" value="Giỏ đựng đồ"> Giỏ đựng đồ
                        </div>
                        <div class="in-label me-3 pd">
                            <input name="checkLoc[]" type="checkbox"  <?php foreach ($checkLoc as $eachLoc) { if (str_contains('Máy tính', $eachLoc)) echo 'checked';}?> class="product-checkbox2" style="cursor: pointer" value="Máy tính"> Máy tính
                        </div>
                        <div class="in-label me-3 pd">
                            <input name="checkLoc[]" type="checkbox"  <?php foreach ($checkLoc as $eachLoc) { if (str_contains('Balo, cặp', $eachLoc)) echo 'checked';}?> class="product-checkbox2" style="cursor: pointer" value="Balo"> Balo
                        </div>
                        <div class="in-label me-3 pd">
                            <input name="checkLoc[]" type="checkbox"  <?php foreach ($checkLoc as $eachLoc) { if (str_contains('Balo, cặp', $eachLoc)) echo 'checked';}?> class="product-checkbox2" style="cursor: pointer" value="Cặp"> Cặp
                        </div>
                        <div class="in-label me-3 pd">
                            <input name="checkLoc[]" type="checkbox"  <?php foreach ($checkLoc as $eachLoc) { if (str_contains('Giỏ đựng đồ', $eachLoc)) echo 'checked';}?> class="product-checkbox2" style="cursor: pointer" value="Giỏ đựng"> Giỏ đựng đồ
                        </div>
                        <div class="in-label me-3 pd">
                            <input name="checkLoc[]" type="checkbox"  <?php foreach ($checkLoc as $eachLoc) { if (str_contains('Các loại kệ', $eachLoc)) echo 'checked';}?> class="product-checkbox2" style="cursor: pointer" value="kệ"> Các loại kệ
                        </div>
                        <div class="in-label me-3 pd">
                            <input name="checkLoc[]" type="checkbox"  <?php foreach ($checkLoc as $eachLoc) { if (str_contains('Bàn', $eachLoc)) echo 'checked';}?> class="product-checkbox2" style="cursor: pointer" value="Bàn"> Bàn
                        </div>
                        <div class="in-label me-3 pd">
                            <input name="checkLoc[]" type="checkbox"  <?php foreach ($checkLoc as $eachLoc) { if (str_contains('ghế', $eachLoc)) echo 'checked';}?> class="product-checkbox2" style="cursor: pointer" value="ghế"> Ghế
                        </div>
                        <div style="padding-top: 15px">
                            <button type="submit" class="btn-apdung">
                                Lọc
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="grid-itemss">
            <?php if (mysqli_num_rows($result) > 0) {
                foreach ($result as $index => $each) { ?>
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
            <?php }
                } else {?>
                <div class="text-center" style="grid-column-start: 3; grid-column-end: 5;">
                    <h3>Không tìm thấy sản phẩm nào</h3>
                </div>
            <?php }?>
        </div>
    </div>

</div>
</div>
</div>
<?php
    include('Footer.php');
?>


