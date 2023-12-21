<?php
    include('header.php');
?>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<style>
    <?php include 'CSS/user_inf.css' ?>
    <?php include 'CSS/Login.css' ?>
</style>

<?php
    include 'connect/connect.php';
    $id = isset($_SESSION['user']['role']) ? $_SESSION['user']['id'] : $_SESSION['user']['customerID'];
    $stringSQL = "SELECT * FROM `customers` WHERE `customerID`='$id'";
    $result = mysqli_query($connect, $stringSQL);
    if (mysqli_num_rows($result) < 1) {
        $stringSQL = "SELECT * FROM `accounts` WHERE `id`='$id'";
        $result = mysqli_query($connect, $stringSQL);
    }
    
    $each = mysqli_fetch_array($result);

    if (!isset($_SESSION['user']['role'])) {
        $stringSQL = "SELECT * FROM `diachi_nhanhang` WHERE `customerID`='$id'";
        $resultDiaChi = mysqli_query($connect, $stringSQL);
        $eachDiaChiCheck = mysqli_fetch_array($resultDiaChi);
    }

    // check have delivery address
    $stringSQL = "SELECT COUNT(*) FROM `diachi_nhanhang` WHERE `customerID`='$id' AND `macdinh`='1'";
    $resultDiaChiMacDinh = mysqli_query($connect, $stringSQL);
    $number_of_rows_DiaChi = mysqli_fetch_array($resultDiaChiMacDinh)['COUNT(*)'];
?>

<div class="toast-container position-fixed p-3" style="top: 80px; right: 50px;">
    <div id="liveToastInfo" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <?php
                if (isset($_SESSION['toast-success-info'])) {
                    echo '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" xml:space="preserve" width="24px" height="24px" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#25AE88;" cx="25" cy="25" r="25"></circle> <polyline style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points=" 38,15 22,33 12,25 "></polyline> </g></svg>';
                    echo '<strong class="ms-2 me-auto">Thông báo</strong>';
                }
                if (isset($_SESSION['toast-error-info'])) {
                    echo '<svg fill="#ff0000" width="24px" height="24px" viewBox="0 -8 528 528" xmlns="http://www.w3.org/2000/svg" stroke="#ff0000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title>fail</title><path d="M264 456Q210 456 164 429 118 402 91 356 64 310 64 256 64 202 91 156 118 110 164 83 210 56 264 56 318 56 364 83 410 110 437 156 464 202 464 256 464 310 437 356 410 402 364 429 318 456 264 456ZM264 288L328 352 360 320 296 256 360 192 328 160 264 224 200 160 168 192 232 256 168 320 200 352 264 288Z"></path></g></svg>';
                    echo '<strong class="ms-2 me-auto">Lỗi</strong>';
                }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?php
                if (isset($_SESSION['toast-success-info'])) {
                    echo $_SESSION['toast-success-info'];
                    unset($_SESSION['toast-success-info']);
                    echo '<script>
                            var toastLive = document.getElementById("liveToastInfo")
                            var toast = new bootstrap.Toast(toastLive)
                            toast.show()
                        </script>';
                }
                if (isset($_SESSION['toast-error-info'])) {
                    echo $_SESSION['toast-error-info'];
                    unset($_SESSION['toast-error-info']);
                    echo '<script>
                            var toastLive = document.getElementById("liveToastInfo")
                            var toast = new bootstrap.Toast(toastLive)
                            toast.show()
                        </script>';
                }
            ?>
        </div>
    </div>
</div>

<div style="background-color: #F7F7F7; min-height: 30rem;">
    <div class="container-user">
        <div class="flex form-inf">
            <div class="left-inf">
                <div class="name-account">
                    Xin chào: <?php echo $each['name'];?>
                </div>
                <div class="menu">
                    <ul style="margin: 0">
                        <li class="active" onclick="showContent('info1')">
                            <div class="dropdown-item-user">Hồ sơ</div>
                        </li>
                        <li onclick="showContent('info2')">
                            <div class="dropdown-item-user">Đổi mật khẩu</div>
                        </li>
                        <li onclick="showContent('info3')">
                            <div class="dropdown-item-user">Địa chỉ nhận hàng</div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="detail-inf">
                <div class="X09">
                        <div class="content">
                            <div id="info1" class="hidden">
                                <div class="head-hs">Hồ Sơ Của Tôi</div>
                                <div class="head-tt">Quản lý thông tin hồ sơ để bảo mật tài khoản</div>
                                <div class="gach"></div>
                                <div>
                                    <table>
                                        <tr>
                                            <td class="EMH">
                                                Họ và tên:
                                            </td>
                                            <td class="EMHH">
                                            <?php if (empty($each['name'])) {
                                                echo 'Không có';
                                                echo '<a style="margin-left: 25px" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#changeName">Thêm mới</a>';
                                            } else {
                                                echo $each['name'];
                                                echo '<a style="margin-left: 25px" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#changeName">Thay đổi</a>';
                                            }
                                            ?>
                                            </td>
                                        </tr>
                                    <?php if (!isset($_SESSION['user']['role'])) {?>
                                        <tr>
                                            <td class="EMH">
                                                Email:
                                            </td>
                                            <td class="EMHH">
                                            <?php if (empty($each['email'])) {
                                                echo 'Không có';
                                                echo '<a style="margin-left: 25px" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#changeEmail">Thêm mới</a>';
                                            } else {
                                                echo $each['email'];
                                                echo '<a style="margin-left: 25px" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#changeEmail">Thay đổi</a>';
                                            }
                                            ?>
                                            </td>
                                        </tr>
                                    <?php }?>
                                        <tr>
                                            <td class="EMH">
                                                Số điện thoại:
                                            </td>
                                            <td class="EMHH">
                                            <?php if (empty($each['phone'])) {
                                                echo 'Không có';
                                                echo '<a style="margin-left: 25px" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#changePhone">Thêm mới</a>';
                                            } else {
                                                echo $each['phone'];
                                                echo '<a style="margin-left: 25px" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#changePhone">Thay đổi</a>';
                                            }
                                            ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="EMH">
                                                Địa chỉ
                                            </td>
                                            <td class="EMHH">
                                            <?php if (empty($each['address'])) {
                                                echo 'Không có';
                                                echo '<a style="margin-left: 25px" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#changeAddress">Thêm mới</a>';
                                            } else {
                                                echo $each['address'];
                                                echo '<a style="margin-left: 25px" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#changeAddress">Thay đổi</a>';
                                            }
                                            ?>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <div id="info2" class="hidden">
                                <div class="head-hs">Đổi mật khẩu</div>
                                <div class="head-tt">Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác</div>
                                <div class="gach"></div>
                                <div>
                                    <form action="process_change_pwd.php?id=<?php echo isset($_SESSION['user']['role']) ? $_SESSION['user']['id'] : $_SESSION['user']['customerID']; ?>" method="post">
                                        <input type="text" name="role" hidden value="<?php echo isset($_SESSION['user']['role']) ? $_SESSION['user']['id'] : null; ?>">
                                        <table>
                                            <tr>
                                                <td class="EMH">
                                                    Mật khẩu cũ
                                                </td>
                                                <td class="EMHH">
                                                    <div class="TMK1">
                                                        <div class="input-container">
                                                            <input name="oldPwd" type="password" class="MK1" id="passwordInput" placeholder="Nhập mật khẩu cũ" />
                                                            <span class="toggle-password" id="togglePassword">
                                                                <i class="fa-sharp fa-solid fa-eye-slash"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="EMH">
                                                    Mật khẩu mới
                                                </td>
                                                <td class="EMHH">
                                                    <div class="TMK1">
                                                        <div class="input-container">
                                                            <input name="newPwd" type="password" class="MK1" id="passwordInput2" placeholder="Nhập mật khẩu mới" />
                                                            <span class="toggle-password" id="togglePassword2">
                                                                <i class="fa-sharp fa-solid fa-eye-slash"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button type="submit" class="btn-save-mk">Lưu</button>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div id="info3" class="hidden">
                                <div class="head-hs">
                                    <div class="diachicuatoi">
                                        Địa chỉ của tôi
                                    </div>
                                    <div style="flex: 1"></div>
                                    <div>
                                        <button class="btn-themdiachi" id="add-button" data-bs-toggle="modal" data-bs-target="#addAddress">+ Thêm địa chỉ mới</button>
                                    </div>
                                </div>
                                <div class="gach"></div>
                            <?php
                                if ($eachDiaChiCheck != null) {
                                    foreach ($resultDiaChi as $eachDiaChi) {
                            ?>
                                <div style="padding: 25px; border-bottom: 1px solid #e8e8e8;">
                                    <div class="add-name">
                                        <div>
                                            <span><?php echo $eachDiaChi['ten_nguoinhan']?></span> | <span style="color: gray; font-size: 16px;"><?php echo $eachDiaChi['sdt_nguoinhan']?></span>
                                        </div>
                                        <div style="flex: 1"></div>
                                        <a href="UpdateDelivery.php?id=<?php echo $eachDiaChi['id'];?>" class="link-CN" id="update-button">Cập nhật</a>
                                        <a href="process_delete_delivery_address.php?id=<?php echo $eachDiaChi['id'];?>" class="link-Del">Xoá</a>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="add-diachi">
                                                <?php echo $eachDiaChi['diachi']?>
                                            </div>
                                            <div style="font-size: 15px; color: #737373;">
                                                <?php echo $eachDiaChi['xa'] . ' - ' . $eachDiaChi['huyen'] . ' - ' . $eachDiaChi['tinh']?>
                                            </div>
                                        <?php if ($eachDiaChi['macdinh'] == 1) {?>
                                            <div class="add-macdinh" style="margin-top: 10px; font-size: .9rem">
                                                <span style="border: solid 1px red; padding: 5px; color: red;">
                                                    Mặc định
                                                </span>
                                            </div>
                                        <?php }?>
                                        </div>
                                        <div class="col-4 text-end">
                                        <?php if ($eachDiaChi['macdinh'] == 0) {?>
                                            <button class="btn active" style="margin-top: 10px; --bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                                <a href="set_delivery_default.php?idCustomer=<?php echo isset($_SESSION['user']['role']) ? $_SESSION['user']['id'] : $_SESSION['user']['customerID']; ?>&id=<?php echo $eachDiaChi['id'];?>" style="text-decoration: none; color: #737373;">Thiết lập mặc định</a>
                                            </button>
                                        <?php }?>
                                        </div>
                                    </div>
                                </div>
                            <?php }} else {?>
                                <div style="padding: 25px; border-bottom: 1px solid #e8e8e8;">
                                    <div class="add-name">
                                        <div class="col-12 text-center">
                                            Chưa có địa chỉ nhận hàng
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Name -->
<div class="modal fade" id="changeName" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changeNameLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="process_update_name.php?id=<?php echo isset($_SESSION['user']['role']) ? $_SESSION['user']['id'] : $_SESSION['user']['customerID']; ?>" method="post">
                <input type="text" name="role" hidden value="<?php echo isset($_SESSION['user']['role']) ? $_SESSION['user']['id'] : null; ?>">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><?php echo empty($each['name']) ? 'Thêm tên' : 'Thay đổi tên'?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php if (!empty($each['name'])) {?>
                    <label class="fs-5 form-label">Họ tên cũ: </label>
                    <span class="ms-2 fs-4"> <?php echo $each['name']; ?></span>
                    <br>
                    <label class="fs-5 form-label">Họ tên mới: </label>
                <?php } else {?>
                    <label class="fs-5 form-label">Nhập họ tên: </label>
                <?php }?>
                    <input type="text" class="form-control" id="newName" name="newName" placeholder="<?php echo empty($each['name']) ? 'Nhập họ tên' : 'Nhập họ tên mới'?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Email -->
<?php if (isset($each['email'])) {?>
<div class="modal fade" id="changeEmail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changeEmailLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="process_update_email.php?id=<?php echo isset($_SESSION['user']['role']) ? $_SESSION['user']['id'] : $_SESSION['user']['customerID']; ?>" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><?php echo empty($each['email']) ? 'Thêm email' : 'Thay đổi email'?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php if (!empty($each['email'])) {?>
                    <label class="fs-5 form-label">Email cũ: </label>
                    <span class="ms-2 fs-4"> <?php echo $each['email']; ?></span>
                    <br>
                    <label class="fs-5 form-label">Email mới: </label>
                <?php } else {?>
                    <label class="fs-5 form-label">Nhập email: </label>
                <?php }?>
                    <input type="email" class="form-control" id="newEmail" name="newEmail" placeholder="<?php echo empty($each['email']) ? 'Nhập email' : 'Nhập email mới'?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php }?>

<!-- Modal Phone -->
<div class="modal fade" id="changePhone" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changePhoneLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="process_update_phone.php?id=<?php echo isset($_SESSION['user']['role']) ? $_SESSION['user']['id'] : $_SESSION['user']['customerID']; ?>" method="post">
                <input type="text" name="role" hidden value="<?php echo isset($_SESSION['user']['role']) ? $_SESSION['user']['id'] : null; ?>">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><?php echo empty($each['phone']) ? 'Thêm số điện thoại' : 'Thay đổi số điện thoại'?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php if (!empty($each['phone'])) {?>
                    <label class="fs-5 form-label">Số điện thoại cũ: </label>
                    <span class="ms-2 fs-4"> <?php echo $each['phone']; ?></span>
                    <br>
                    <label class="fs-5 form-label">Số điện thoại mới: </label>
                <?php } else {?>
                    <label class="fs-5 form-label">Nhập số điện thoại: </label>
                <?php }?>
                    <input type="number" class="form-control" id="newPhone" name="newPhone" placeholder="<?php echo empty($each['phone']) ? 'Nhập số điện thoại' : 'Nhập số điện thoại mới'?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Address -->
<div class="modal fade" id="changeAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changeAddressLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="process_update_address.php?id=<?php echo isset($_SESSION['user']['role']) ? $_SESSION['user']['id'] : $_SESSION['user']['customerID']; ?>" method="post">
                <input type="text" name="role" hidden value="<?php echo isset($_SESSION['user']['role']) ? $_SESSION['user']['id'] : null; ?>">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"><?php echo empty($each['address']) ? 'Thêm địa chỉ' : 'Thay đổi địa chỉ'?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php if (!empty($each['address'])) {?>
                    <label class="fs-5 form-label">Địa chỉ cũ: </label>
                    <span class="ms-2 fs-4"> <?php echo $_SESSION['user']['address']; ?></span>
                    <br>
                    <label class="fs-5 form-label">Địa chỉ mới: </label>
                <?php } else {?>
                    <label class="fs-5 form-label">Nhập địa chỉ: </label>
                <?php }?>
                    <input type="text" class="form-control" id="newAddress" name="newAddress" placeholder="<?php echo empty($each['address']) ? 'Nhập địa chỉ' : 'Nhập địa chỉ mới'?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delivery Address -->
<!-- Modal Add Address -->
<div class="modal fade" id="addAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAddressLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="process_add_delivery_address.php?id=<?php echo isset($_SESSION['user']['role']) ? $_SESSION['user']['id'] : $_SESSION['user']['customerID']; ?>" method="post">
                <input type="text" name="role" hidden value="<?php echo isset($_SESSION['user']['role']) ? $_SESSION['user']['id'] : null; ?>">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Thêm địa chỉ nhận hàng</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="fs-5 form-label">Họ tên: </label>
                    <input type="text" class="form-control fs-6" id="deliveryName" name="deliveryName" placeholder="Nhập họ tên">
                    <br>

                    <label class="fs-5 form-label">Số điện thoại: </label>
                    <input type="number" class="form-control fs-6" id="deliveryPhone" name="deliveryPhone" placeholder="Nhập số điện thoại">
                    <br>

                    <label class="fs-5 form-label">Địa chỉ: </label>
                    <input type="text" class="form-control fs-6" id="deliveryAddress" name="deliveryAddress" placeholder="Nhập địa chỉ">
                    <br>

                    <label class="fs-5 form-label">Tỉnh/Thành phố, Quận/Huyện, Xã/Phường: </label>
                    <div>
                        <select name="conscious" class="form-select form-select-sm mb-3 fs-6" id="city" aria-label=".form-select-sm">
                            <option value="" selected>Chọn tỉnh thành</option>
                        </select>
                        
                        <select name="district" class="form-select form-select-sm mb-3 fs-6" id="district" aria-label=".form-select-sm">
                            <option value="" selected>Chọn quận huyện</option>
                        </select>

                        <select name="wards" class="form-select form-select-sm fs-6" id="ward" aria-label=".form-select-sm">
                            <option value="" selected>Chọn phường xã</option>
                        </select>
                    </div>
                    <br>

                <?php if ($number_of_rows_DiaChi > 0) {?>
                    <input type="checkbox" name="setDefault">
                    <label class="fs-6 form-label">Đặt làm địa chỉ mặc định</label>
                <?php }?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
	var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");
    var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json", 
        method: "GET",
        responseType: "application/json",
    };
    var promise = axios(Parameter);
    promise.then(function (result) {
        renderCity(result.data);
    });

    function renderCity(data) {
        for (const x of data) {
            citis.options[citis.options.length] = new Option(x.Name, x.Name);
        }
        citis.onchange = function () {
            district.length = 1;
            ward.length = 1;
            if(this.value != ""){
                const result = data.filter(n => n.Name === this.value);

                for (const k of result[0].Districts) {
                    district.options[district.options.length] = new Option(k.Name, k.Name);
                }
            }
        };
        district.onchange = function () {
            ward.length = 1;
            const dataCity = data.filter((n) => n.Name === citis.value);
            if (this.value != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Name === this.value)[0].Wards;

                for (const w of dataWards) {
                    wards.options[wards.options.length] = new Option(w.Name, w.Name);
                }
            }
        };
    }
</script>
<script>
    <?php include 'User_infor.js' ?>
</script>

<?php include('Footer.php'); ?>
