<?php include_once './ShareAdmin/header.php'; ?>

<div class="modal-header mb-5">
    <div class="modal-title fs-4 d-flex align-items-center">
        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M6 12.0002V9.33017C6 6.02017 8.35 4.66017 11.22 6.32017L13.53 7.66017L15.84 9.00017C18.71 10.6602 18.71 13.3702 15.84 15.0302L13.53 16.3702L11.22 17.7102C8.35 19.3402 6 17.9902 6 14.6702V12.0002Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        <span>Danh Mục Khách Hàng</span>
    </div>
</div>
<section>
    <div class="table-responsive" style="min-height: 300px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">STT</th>
                    <th class="text-center">Tên KH</th>
                    <th class="text-center" style="width: 25%;">Email/SĐT</th>
                    <th class="text-center" style="width: 30%;">Địa chỉ</th>
                    <th class="text-center" style="width: 5%;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include_once './Customer/ShowCustomer.php';
                ?>
        </table>
    </div>
</section>
<?php include_once './ShareAdmin/footer.php'; ?>