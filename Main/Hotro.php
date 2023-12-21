<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" href="picture/logo-web.png" type="image/x-icon">
    <title>Hoàng Hà Stationery</title>

    <style>
        <?php include 'CSS/Login.css' ?>
        <?php include 'CSS/Hotro.css' ?>
        <?php include 'CSS/Footer.css' ?>
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
    <div class="login-war1" >
        <div class="logo-icon">
            <a href="index.php" class="logo-click">
                <div class="size-logo-icon">
                    <img class="image-logo-login" src="picture/logoHH-do.png">
                </div>
            </a>
            <div class="x0102"></div>
            <div class="x0101">Trung tâm hỗ trợ</div>
        </div>
    </div >

    <div class="hotro-war1">
        <div class="hotro-xinchao-text">Xin chào, Hoàng Hà có thể giúp gì cho bạn?</div>
    </div>

    <div class="hotro-war2">
        <div style="margin-bottom: 30px">
            <div class="header-question-hotro">Câu hỏi thường gặp</div>
            <div class="question" onclick="chuyenhuongCSKH()">
                <div class="question-text">
                    Cách xử lý khi hệ thống không thể xác minh tài khoản Shopee của tôi để đăng nhập? Tại sao hệ thống không thể xác minh được yêu cầu đăng nhập của tôi?
                </div>
            </div>
            <div class="question" onclick="chuyenhuongCSBM()">
                <div class="question-text">
                    CHÍNH SÁCH BẢO MẬT
                </div>
            </div>


            <div style="margin-bottom: 30px">

                <div class="header-question-hotro">Ý kiến đóng góp của khách hàng</div>
                <form action="add_review.php" method="post">
                    <div class="from-donggop">
                        <textarea id="feedback" name="feedback" class="input-donggopykien" rows="5" cols="50"></textarea>
                    </div>
                    <div class="error-message" id="error-message"></div>
                    <div class="success-message" id="success-message"></div>
                    <div class="btn-donggop">
                        <button type="submit" class="gui-y-kien">Gửi ý kiến đóng góp</button>
                    </div>
                </form>
        <div class="footer-hotro">
            <div class="inf-footer-hotro">
                <div class="inf-title-footer">
                    <div style="text-align: center;">
                        Bạn muốn tìm thêm thông tin gì không?
                    </div>
                </div>
                <div class="inf-address">
                    <div class="lienhe-hotline">
                        <div class="sdt">
                            <i class="fa-solid fa-phone" style="margin-right: 5px"></i>
                            0999.999.999
                        </div>
                    </div>
                    <div class="lienhe-gmail">
                        <div class="sdt">
                            <i class="fa-solid fa-envelope" style="margin-right: 5px"></i>
                            HoanghaStationery@gmail.com
                        </div>
                    </div>
                    <div class="lienhe-diachi">
                        <div class="sdt">
                            <i class="fa-solid fa-location-dot" style="margin-right: 5px"></i>
                            123 Lĩnh Nam - Hoàng Mai - Hà Nội
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function chuyenhuongCSKH() {
            window.location.href = 'lienheCSKH.php';
        }
        function chuyenhuongCSBM() {
            window.location.href = 'CSBM.php';
        }
    </script>
</body>
</html>