<?php
    session_start();
    if (isset($_SESSION['user'])) {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoàng Hà Stationery</title>
    <link rel = "icon" href="picture/logo-web.png" type="image/x-icon">
    <style>
        <?php include 'CSS/Register.css' ?>
    </style>
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

    <div>
        <div class="register-war1">
            <div class="logo-icon">
                <div class="size-logo-icon">
                    <a href="index.php">
                        <img class="image-logo-login" src="picture/logoHH-do.png" alt="...">
                    </a>
                </div>
                <div class="x0104"></div>
                <div class="x0103">Đăng ký</div>
            </div>
        </div >
        <div class="bg-img-size2">
            <img class="register-pic" src="picture/bg-login@2x.png" alt="..."/>
            <div class="container3">
                <div class="registration form">
                    <header>Đăng ký</header>
                        <form action="process_register.php" method="post">
                            <input name="email" type="text" placeholder="Nhập email/số điện thoại">
                            <input name="password" type="password" placeholder="Nhập mật khẩu">
                            <input oninput="changeRePassword()" name="repassword" type="password" placeholder="Nhập lại mật khẩu">
                            <div class="message-error" style="color: red;"></div>
                            <input type="submit" class="button" value="Đăng ký">
                        </form>
                    <div class="signup">
                        <span class="signup">Đã có tài khoản?
                            <label onclick="chuyenHuong()">Đăng nhập</label>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const messageError = document.querySelector('.message-error');
        function chuyenHuong() {
            window.location.href = 'Login.php';
        }
        function changeRePassword() {
            var password = document.getElementsByName("password")[0].value;
            var repassword = document.getElementsByName("repassword")[0].value;
            if (password != repassword) {
                messageError.innerHTML = "Mật khẩu không khớp!";
            } else {
                messageError.innerHTML = "";
            }
        }
    </script>
</body>
</html>
