<?php
    include_once './ShareAdmin/header.php';
    if ($_SESSION['user']['role'] != 0 && $_SESSION['user']['role'] != 1) {
        $_SESSION['toast-error'] = "Bạn không có quyền truy cập";
        header("Location: ./index.php");
        die();
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

<div class="modal-header mb-5">
    <div class="modal-title fs-4 d-flex align-items-center">
        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12.0002V9.33017C6 6.02017 8.35 4.66017 11.22 6.32017L13.53 7.66017L15.84 9.00017C18.71 10.6602 18.71 13.3702 15.84 15.0302L13.53 16.3702L11.22 17.7102C8.35 19.3402 6 17.9902 6 14.6702V12.0002Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        <span>Danh Mục Nhân Viên</span>
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
                    <th class="text-center">Họ Tên</th>
                    <th class="text-center" style="width: 15%;">SĐT</th>
                    <th class="text-center" style="width: 10%;">Ngày Sinh</th>
                    <th class="text-center">Địa chỉ</th>
                    <th class="text-center" style="width: 10%;">Chức vụ</th>
                    <th class="text-center" style="width: 5%;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once './Staff/ShowStaff.php';
                ?>
        </table>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form action="process_insert_staff.php" method="post" class="form-add" style="height: 100%; width: 100%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-2" id="addleModalLabel">Thêm mới nhân viên</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="overflow-x: hidden;">
                    <label class="fs-5 form-label required" for="nameStaff">1. Nhập họ tên: </label>
                    <br>
                    <input id="nameStaff" name="name_staff" class="form-control form-control-lg" type="text" placeholder="Tên nhân viên..." aria-label=".form-control-lg" required>
                    <div class="invalid name_staff"></div>
                    <br>

                    <label class="fs-5 form-label required" for="phoneStaff">2. Nhập số điện thoại: </label>
                    <br>
                    <input onchange="changeInput(event)" id="phoneStaff" name="phone_staff" class="form-control form-control-lg" type="text" placeholder="Số điện thoại nhân viên..." aria-label=".form-control-lg" required>
                    <div class="invalid phone_staff"></div>
                    <br>

                    <label class="fs-5 form-label required" for="dobStaff">3. Ngày sinh: </label>
                    <br>
                    <input onchange="changeInputDate(event)" id="dobStaff" name="dob_staff" class="form-control form-control-lg" type="date" required>
                    <div class="invalid dob_staff"></div>
                    <br>

                    <label class="fs-5 form-label required" for="addressStaff">4. Nhập địa chỉ: </label>
                    <br>
                    <input id="addressStaff" name="address_staff" class="form-control form-control-lg" type="text" placeholder="Địa chỉ nhân viên..." aria-label=".form-control-lg" required>
                    <div class="invalid address_staff"></div>
                    <br>

                    <label class="fs-5 form-label" for="pwdStaff">5. Mật khẩu tài khoản (mặc định là 9876543210): </label>
                    <br>
                    <input id="pwdStaff" name="pwd_staff" class="form-control form-control-lg" type="text" placeholder="Mật khẩu tài khoản..." aria-label=".form-control-lg">
                    <div class="invalid pwd_staff"></div>
                    <br>

                <?php if ($_SESSION['user']['role'] == 0 || $_SESSION['user']['role'] == 1) {?>
                    <label class="fs-5 form-label" for="roleStaff">6. Chức vụ: </label>
                    <br>
                    <select name="role_staff" id="roleStaff" class="form-select" aria-label="Default select example">
                        <option value="1">Quản lý</option>
                        <option value="2" selected>Nhân viên</option>
                    </select>
                    <br>
                <?php } ?>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    const btnSubmit = document.querySelector('button[type="submit"]');
    const errorPhone = document.querySelector('.phone_staff');
    const errorDob = document.querySelector('.dob_staff');

    function changeInput(e) {
        const phone = e.target;
        const regexPhone = /(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/;
        if (!regexPhone.test(phone.value)) {
            btnSubmit.disabled = true;
            errorPhone.innerHTML = "Số điện thoại không hợp lệ!";
            return;
        }
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                var result = JSON.parse(this.responseText);
                if (result === true) {
                    btnSubmit.disabled = true;
                    errorPhone.innerHTML = "Số điện thoại đã được sử dụng!";
                } else {
                    btnSubmit.disabled = false;
                    errorPhone.innerHTML = "";
                }
            }
        };
        xhttp.open("GET", "check_phone_staff.php?phone=" + phone.value, true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send();
    }

    function changeInputDate(e) {
        const dob = e.target;
        const age = getAge(dob.value);
        if (age < 18) {
            btnSubmit.disabled = true;
            errorDob.innerHTML = "Nhân viên phải trên 18 tuổi!";
        } else {
            btnSubmit.disabled = false;
            errorDob.innerHTML = "";
        }
    }

    function getAge(dateString) {
        var today = new Date();
        var birthDate = new Date(dateString);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }
</script>
<?php include_once './ShareAdmin/footer.php'; ?>