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
        <span>Danh Mục Đơn Hàng</span>
    </div>
</div>
<section>
    <div class="table-responsive" style="min-height: 300px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">STT</th>
                    <th class="text-center" style="width: 10%;">Mã Hoá Đơn</th>
                    <th class="text-center">Khách Hàng</th>
                    <th class="text-center" style="width: 15%;">Tổng Tiền Đơn Hàng</th>
                    <th class="text-center" style="width: 10%;">Phí Vận Chuyển</th>
                    <th class="text-center" style="width: 10%;">Trạng Thái</th>
                    <th class="text-center" style="width: 5%;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once './ShareAdmin/root/funcion.php';
                    include_once './Invoices/ShowInvoice.php';
                ?>
            </tbody>
        </table>
    </div>
</section>

<?php include_once './ShareAdmin/footer.php'; ?>