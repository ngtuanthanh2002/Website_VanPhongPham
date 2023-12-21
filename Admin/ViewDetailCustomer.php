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
<!-- Modal -->
<?php
    include_once './ShareAdmin/root/connect.php';
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM customers WHERE customerID = '$id'";
    $result = mysqli_query($connect, $sql);
    $each = mysqli_fetch_array($result);

    // get delivery address
    $sql = "SELECT * FROM diachi_nhanhang WHERE customerID = '$id'";
    $deliveryAddress = mysqli_query($connect, $sql);
?>
<div class="modal fade show" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-modal="true" style="display: block; background: rgb(0,0,0,0.5);">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <form action="CustomerCategory.php" method="get" class="form-add" style="height: 100%; width: 100%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-2" id="addleModalLabel">Chi tiết khách hàng</h1>
                    <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="overflow-x: hidden;">
                    <label class="fs-5 form-label">Họ tên: </label>
                    <span class="ms-2 fs-4"> <?php echo $each['name']; ?></span>
                    <br>
                    <br>

                    <label class="fs-5 form-label">Địa chỉ: </label>
                    <?php if($each['address'] != null) {?>
                        <span class="ms-2 fs-4"> <?php echo $each['address']; ?></span>
                    <?php } else {?>
                        <span class="ms-2 fs-5"> Không có</span>
                    <?php }?>
                    <br>
                    <br>

                    <div class="row flex-row">
                        <div class="col-6">
                            <label class="fs-5 form-label">Điện thoại: </label>
                            <?php if($each['phone'] != null) {?>
                                <span class="ms-2 fs-4"> <?php echo $each['phone']; ?></span>
                            <?php } else {?>
                                <span class="ms-2 fs-5"> Không có</span>
                            <?php }?>
                        </div>
                        <div class="col-6">
                            <label class="fs-5 form-label">Email: </label>
                            <?php if($each['email'] != null) {?>
                                <span class="ms-2 fs-4"> <?php echo $each['email']; ?></span>
                            <?php } else {?>
                                <span class="ms-2 fs-5"> Không có</span>
                            <?php }?>
                        </div>
                    </div>
                    <br>

                    <label class="fs-5 form-label " for="priceProduct">Danh sách địa chỉ nhận hàng: </label>
                        <br>
                        <div class="table-responsive" style="min-height: 348px;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 2%;">STT</th>
                                        <th class="text-center" style="width: 20%;">Họ tên</th>
                                        <th class="text-center" style="width: 20%;">Số điện thoại</th>
                                        <th class="text-center">Địa chỉ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (mysqli_num_rows($deliveryAddress) > 0) {
                                            
                                        } else {
                                            echo '<tr>';
                                            echo '<td colspan="4" class="text-center">Không có dữ liệu</td>';
                                            echo '</tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Đóng</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include_once './ShareAdmin/footer.php'; ?>