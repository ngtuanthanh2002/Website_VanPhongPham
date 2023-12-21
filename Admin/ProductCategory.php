<?php include_once './ShareAdmin/header.php'; ?>

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

<div class="modal-header mb-5">
    <div class="modal-title fs-4 d-flex align-items-center">
        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12.0002V9.33017C6 6.02017 8.35 4.66017 11.22 6.32017L13.53 7.66017L15.84 9.00017C18.71 10.6602 18.71 13.3702 15.84 15.0302L13.53 16.3702L11.22 17.7102C8.35 19.3402 6 17.9902 6 14.6702V12.0002Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        <span>Danh Mục Sản Phẩm</span>
    </div>
</div>
<section>
    <div class="row mb-3">
        <div class="col-3">
            <button style="color: var(--white) !important;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Thêm mới</button>
        </div>
    </div>
    <div class="table-responsive" style="min-height: 300px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">STT</th>
                    <th class="text-center" style="width: 10%;">Ảnh</th>
                    <th class="text-center" style="width: 20%;">Mã Sản Phẩm</th>
                    <th class="text-center">Tên Sản Phẩm</th>
                    <th class="text-center" style="width: 15%;">Giá Bán</th>
                    <th class="text-center" style="width: 5%;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once './ShareAdmin/root/funcion.php';
                    include_once './Product/ShowProduct.php';
                ?>
            </tbody>
        </table>
    </div>
</section>

<!-- Modal Add -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
        <form action="process_insert_product.php" method="post" enctype="multipart/form-data" class="form-add" style="height: 100%; width: 100%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-2" id="addleModalLabel">Thêm mới sản phẩm</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="overflow-x: hidden;">
                    <label class="fs-5 form-label required" for="nameProduct">1. Nhập tên sản phẩm: </label>
                    <br>
                    <input id="nameProduct" name="name_product" class="form-control form-control-lg" type="text" placeholder="Tên sản phẩm..." aria-label=".form-control-lg" required>
                    <div class="invalid name_product"></div>
                    <br>

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

                    <label class="fs-5 form-label required" for="priceProduct">3. Nhập giá bán sản phẩm: </label>
                    <br>
                    <input id="priceProduct" name="price_product" class="form-control form-control-lg" type="number" placeholder="Giá bán..." aria-label=".form-control-lg" required>
                    <div class="invalid price_product"></div>
                    <br>

                    <div class="row">
                        <div class="col-3">
                            <label class="fs-5 form-label required" for="priceProduct">4. Chọn thuộc tính: </label>
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
                                                                <input type='checkbox' name='properties[]' value='" . $eachChild['ma_thuoctinh'] . "'>
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
                    </div>
                    <br>

                    <div class="form-floating mt-2">
                        <textarea name="desc_product" class="form-control" placeholder="Mô tả sản phẩm..." id="descProduct" style="height: 100px"></textarea>
                        <label for="descProduct">Mô tả sản phẩm</label>
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

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="deleteModalLabel">Xoá sản phẩm</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Xác nhận xoá sản phẩm này?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger">Xoá</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        </div>
        </div>
    </div>
</div>

<?php include_once './ShareAdmin/footer.php'; ?>