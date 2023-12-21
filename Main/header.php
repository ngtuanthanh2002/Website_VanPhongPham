<?php
    session_start();
    
    require_once './connect/connect.php';
    if (isset($_COOKIE['token'])) {
        $token = $_COOKIE['token'];
        $sql = "SELECT * FROM `accounts` WHERE `token` = '$token'";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $_SESSION['user'] = $row;
        } else {
            $sql = "SELECT * FROM `customers` WHERE `token` = '$token'";
            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $_SESSION['user'] = $row;
            }
        }
    }

    $search = "";
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
    }

    $limit = 12;
    if (isset($_GET['limit'])) {
        $limit = $_GET['limit'];
    }

    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $itemCount = count($cart);
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
        <?php include 'CSS/header.css' ?>
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body>
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
    <div class="sticky-top2">
        <div class="_header1">
            <nav class="container-header">
                <div class="flex v-center">
                    <div>
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
                <div class="navbar__spacer"></div>

                <ul class="flex v-center"">
                    <a class="text-color-white-ha hover" href="Hotro.php" style="cursor: pointer;">
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
                            <li><a class="dropdown-item" href="../Admin/index.php" target="_blank">Trang Admin</a></li>
                            <?php } ?>
                            
                            <?php if (!isset($_SESSION['admin'])) {?>
                            <li><a class="dropdown-item" href="User_Infor.php">Thông tin cá nhân</a></li>
                            <?php } ?>
                            <li><a class="dropdown-item" href="logout.php">Đăng xuất</a></li>
                        </ul>
                    </div>
                <?php
                    } else {
                ?>
                    <ul class="flex v-center">
                        <a class="text-color-white-ha hover" href="Register.php">Đăng ký</a>
                        <span class="_span-space text-color-white-ga">|</span>
                        <a class="text-color-white-ha hover" href="Login.php">Đăng nhập</a>
                    </ul>
                <?php }?>
            </nav>
        </div>

        <div class="navbar navbar-expand-sm _header2">
        <div class="container-fluid2">
                <div class="_container-center">
                    <div class="_search-img2">
                        <a href="index.php">
                            <img class="logo2" src="picture/logoHH.png" alt="Logo"/>
                        </a>
                    </div>
                    <div class="in-thanh-sp">
                        <form style="margin-bottom: 0;" action="Allsanpham.php" method="get">
                            <div class="thanh_sp_header">
                                <input name="search" value="<?php echo $search?>" type="text" class="input-search" placeholder="Nhập tìm kiếm...">
                                <div class="khung-button">
                                    <button class="button-search">
                                        <i class="fa fa-search text-color-white-ha"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="link_sp_header">
                            <a class="_search-text hover" href="Allsanpham.php?search=giấy">Giấy A4</a>
                            <a class="_search-text hover" href="Allsanpham.php?search=kẹp sách">Kẹp sách</a>
                            <a class="_search-text hover" href="Allsanpham.php?search=bút">Bút các loại</a>
                            <a class="_search-text hover" href="Allsanpham.php?search=mực">Mực</a>
                            <a class="_search-text hover" href="Allsanpham.php?search=ghim">Ghim</a>
                            <a class="_search-text hover" href="Allsanpham.php?search=máy tính">Máy tính</a>
                            <a class="_search-text hover" href="Allsanpham.php?search=ghế">Ghế</a>
                            <a class="_search-text hover" href="Allsanpham.php?search=bàn">Bàn</a>
                            <a class="_search-text hover" href="Allsanpham.php?search=giá sách">Giá sách</a>
                            <a class="_search-text hover" href="Allsanpham.php?search=túi vải">Túi vải</a>
                            <a class="_search-text hover" href="Allsanpham.php?search=cặp">Cặp</a>
                        </div>

                    </div>
                    <div class="_btn-gioHang">
                        <a href="view_cart.php" class="text-color-white _gioHang hover">
                            <i class="fas fa-shopping-cart">
                                <span class="cart-count"><?php echo $itemCount; ?></span>
                            </i>

                        </a>
                    </div>

                </div>
            </div>
        </div>
        </nav>
    </div>
</body>
</html>
