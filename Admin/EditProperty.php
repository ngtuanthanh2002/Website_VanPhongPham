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
        <span>Danh Mục Thuộc Tính Sản Phẩm</span>
    </div>
</div>
<section>
    <div class="row mb-3">
        <div class="col-3">
            <button style="color: var(--white) !important;" type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#addModal">Thêm mới</button>
        </div>
    </div>
    <div class="table-responsive" style="min-height: 300px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">STT</th>
                    <th class="text-center" style="width: 20%;">Mã Thuộc Tính</th>
                    <th class="text-center">Tên Thuộc Tính</th>
                    <th class="text-center" style="width: 5%;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once './Product/ShowProperties.php';
                ?>
        </table>
    </div>
</section>

<?php
    $id = $_GET['id'];
    $stringSQL = "SELECT * FROM `thuoctinh` WHERE `id` = '$id'";

    $result = mysqli_query($connect, $stringSQL);
    $each = mysqli_fetch_array($result);

    $stringSQL = "SELECT * FROM `thuoctinh` WHERE `ten_thuoctinhcha` = '". $each['ma_thuoctinh'] . "'";
    $result = mysqli_query($connect, $stringSQL);
    $lstthuoctinhcon = array();
    foreach ($result as $eachChild) {
        array_push($lstthuoctinhcon, $eachChild);
    }
    $thuoctinhcon = '';
    foreach ($lstthuoctinhcon as $eachChild) {
        $thuoctinhcon .= $eachChild['ten_thuoctinhcon'] . ',';
    }
    $thuoctinhcon = substr($thuoctinhcon, 0, -1);
?>
<!-- Modal -->
<div class="modal fade show" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-modal="true" style="display: block; background: rgb(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form action="process_update_properties.php?id=<?php echo $id;?>" method="post" class="form-add" style="height: 100%; width: 100%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-2" id="addleModalLabel">Sửa thuộc tính</h1>
                    <a href="ProductProperties.php">X</a>
                </div>

                <div class="modal-body" style="overflow-x: hidden;">
                    <label class="fs-5 form-label required" for="nameParentProperties">1. Tên thuộc tính (VD: Màu sắc, Chất liệu...): </label>
                    <br>
                    <input onchange="changeInput(event)" id="nameParentProperties" name="name_parent_properties" value="<?php echo $each['ten_thuoctinhcha'];?>" class="form-control form-control-lg" type="text" placeholder="Tên thuộc tính..." aria-label=".form-control-lg" required>
                    <div class="invalid name_parent_properties"></div>
                    <br>

                    <label class="fs-5 form-label" for="nameChildProperties">2. Danh sách thuộc tính(Giữ hoặc xoá thuộc tính): </label>
                    <br>
                    <?php foreach ($lstthuoctinhcon as $indexChild => $eachChild) {?>
                        <div id="property-<?php echo $indexChild;?>" class="item-property row align-items-center">
                            <div class="col-8">
                                <input id="nameChildProperties" name="name_child_properties[]" value="<?php echo $eachChild['ten_thuoctinhcon'];?>" class="form-control form-control-lg" type="text" placeholder="Danh sách thuộc tính..." aria-label=".form-control-lg" required>
                                <div class="invalid name_child_properties"></div>
                            </div>
                            <div class="col-4">
                                <button data-del="property-<?php echo $indexChild;?>" type="button" class="btn btn-danger" onclick="deleteProperties(event)">Xoá</button>
                                <?php if ($indexChild == count($lstthuoctinhcon) - 1) {?>
                                    <button data-ins="property-<?php echo $indexChild;?>" type="button" class="btn btn-primary" onclick="addProperties(event)">Thêm</button>
                                <?php }?>
                            </div>
                        </div>
                    <?php }?>
                    <div class="message-error mt-2"></div>
                    <br>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    const btnSubmit = document.querySelector('#addModal .modal-footer button[type="submit"]');
    const errorDiv = document.querySelector('.message-error');

    function changeInput(e) {
        const tenthuoctinh = e.target;
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                console.log(this.responseText);
                var result = JSON.parse(this.responseText);
                if (result === true) {
                    btnSubmit.disabled = true;
                    errorDiv.innerHTML = '<div class="alert alert-danger mb-0" role="alert">Tên thuộc tính đã tồn tại!</div>';
                } else {
                    btnSubmit.disabled = false;
                    errorDiv.innerHTML = "";
                }
            }
        };
        xhttp.open("GET", "check_tenthuoctinh.php?ten_thuoctinh=" + tenthuoctinh.value + "&id=<?php echo $id;?>", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send();
    }

    function addProperties(e) {
        const id = e.target.getAttribute('data-ins');
        const index = id.split('-')[1];
        if (index == 9) {
            errorDiv.innerHTML = '<div class="alert alert-danger mb-0" role="alert">Chỉ được thêm tối đa 10 thuộc tính!</div>';
            return;
        }
        const parentElement = document.getElementById(id);
        const html = `
            <div id="property-${Number(index) + 1}" class="item-property row align-items-center">
                <div class="col-8">
                    <input id="nameChildProperties" name="name_child_properties[]" class="form-control form-control-lg" type="text" placeholder="Nhập thuộc tính..." aria-label=".form-control-lg" required>
                    <div class="invalid name_child_properties"></div>
                </div>
                <div class="col-4">
                    <button data-del="property-${Number(index) + 1}" type="button" class="btn btn-danger" onclick="deleteProperties(event)">Xoá</button>
                    <button data-ins="property-${Number(index) + 1}" type="button" class="btn btn-primary" onclick="addProperties(event)">Thêm</button>
                </div>
            </div>
        `;
        parentElement.insertAdjacentHTML('afterend', html);
        e.target.remove();
    }

    function deleteProperties(e) {
        const id = event.target.getAttribute('data-del');
        const parentElement = document.getElementById(id);
        const ten_thuoctinh = parentElement.querySelector('#nameChildProperties').value;

        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                var result = JSON.parse(this.responseText);
                if (result === true) {
                    errorDiv.innerHTML = '<div class="alert alert-danger mb-0" role="alert">Thuộc tính đã được sử dụng, không thể xoá!</div>';
                } else {
                    errorDiv.innerHTML = "";

                    
                    const check = e.target.parentElement.querySelector('.btn-primary');
                    parentElement.remove();
                    const item_properties = document.querySelectorAll('.item-property');

                    const idAdd = document.querySelector('.btn-primary').getAttribute('data-ins');
                    if (idAdd == null && check != null && item_properties.length > 1) {
                        const idElement = item_properties[item_properties.length - 1].getAttribute('id').split('-')[1];
                        const html = `
                            <button data-ins="property-${idElement}" type="button" class="btn btn-primary" onclick="addProperties(event)">Thêm</button>
                        `;
                        item_properties[item_properties.length - 1].querySelector('.col-4').insertAdjacentHTML('beforeend', html);
                    }
                }
            }
        };
        xhttp.open("GET", "check_thuoctinh.php?ten_thuoctinh=" + ten_thuoctinh, true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send();
    }
</script>
<?php include_once './ShareAdmin/footer.php'; ?>