let maxQuantity = 0;
const errorQuantity = document.querySelector('.message-error');
const btnByNow = document.querySelector('.muaHang');
const quantityInput = document.getElementById("quantityInput");
const lstBtnProperty = document.querySelectorAll('.details-button');

function decreaseQuantity() {
    var currentValue = parseInt(quantityInput.value);

    errorQuantity.innerHTML = '';
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
}
function increaseQuantity() {
    let check = false;
    lstBtnProperty.forEach(item => {
        if (item.classList.contains('active')) {
            check = true;
        }
    });
    if (!check) {
        errorQuantity.innerHTML = `<div class="alert-danger" role="alert">Vui lòng chọn thuộc tính!</div>`;
        return;
    }
    var currentValue = parseInt(quantityInput.value);
    var maxQuantity = parseInt(quantityInput.max);
    if (currentValue >= maxQuantity) {
        errorQuantity.innerHTML = `<div class="alert-danger" role="alert">Số lượng sản phẩm không đủ!</div>`;
        return;
    }
    errorQuantity.innerHTML = '';
    quantityInput.value = currentValue + 1;
}
function changeQuantity() {
    let check = false;
    lstBtnProperty.forEach(item => {
        if (item.classList.contains('active')) {
            check = true;
        }
    });
    if (!check) {
        quantityInput.value = 1;
        errorQuantity.innerHTML = `<div class="alert-danger" role="alert">Vui lòng chọn thuộc tính!</div>`;
        return;
    }
    var currentValue = parseInt(quantityInput.value);
    var maxQuantity = parseInt(quantityInput.max);
    if (currentValue > maxQuantity) {
        quantityInput.value = maxQuantity;
        return;
    }
    errorQuantity.innerHTML = '';
}

var addButton = document.querySelector('.add-giohang');
var closeBtn = document.querySelector('.close-btn');
var okButton = document.querySelector('.ok-btn2');
addButton.addEventListener('click', function() {
    // thongBao.style.display = 'block';
});


function chuyenHuonggiohang() {
    window.location.href = 'view_cart.php';
}

const inputIdProductDetail = document.querySelector('form input[name="idProductDetail"]');

function clickBtnProperty(element, e) {
    const idProductDetail = element.getAttribute('data-productChild');
    inputIdProductDetail.value = idProductDetail.toString();

    lstBtnProperty.forEach(item => {
        item.classList.remove('active');
    });
    errorQuantity.innerHTML = '';
    e.target.classList.toggle('active');
    quantityInput.value = 1;
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var result = JSON.parse(this.responseText);
            if (result > 0) {
                maxQuantity = result;
                quantityInput.max = maxQuantity;
                addButton.disabled = false;
                btnByNow.disabled = false;
            } else {
                maxQuantity = 0;
                errorQuantity.innerHTML = `<div class="alert-danger" role="alert">Sản phẩm đã hết hàng!</div>`;
                addButton.disabled = true;
                btnByNow.disabled = true;
            }
        }
    };
    xhttp.open("GET", "check_quantity.php?id=" + e.target.id, true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send();
}

let bigImg = document.querySelector('.link-product img');
function showImg(pic){
    bigImg.src = pic;
}

function AddToCart(idProduct) {
    let check = false;
    lstBtnProperty.forEach(item => {
        if (item.classList.contains('active')) {
            check = true;
        }
    });
    if (!check) {
        errorQuantity.innerHTML = `<div class="alert-danger" role="alert">Vui lòng chọn thuộc tính!</div>`;
        return;
    }
    let quantity = quantityInput.value;
    let idproperty = document.querySelector('.details-button.active').id;
    window.location.href = './add_to_cart.php?id=' + idProduct + '&property=' + idproperty + '&quantity=' + quantity;
}


const initSlider = () => {
    const gridContainer = document.querySelector(".list-pic-product .list-pic");
    const nextButton = document.querySelector(".list-pic-product #next-slide");
    const prevButton = document.querySelector(".list-pic-product #prev-slide");
    const images = document.querySelectorAll(".list-pic-product .list-pic .list-product-image");

    // Lấy kích thước của ảnh
    const imageWidth = images[0].clientWidth;
    const imageHeight = images[0].clientHeight;

    // Lấy kích thước của grid
    const gridWidth = gridContainer.clientWidth;
    const gridHeight = gridContainer.clientHeight;

    // Tính số lượng cột và hàng trong mỗi grid
    const columns = Math.floor(gridWidth / imageWidth);
    const rows = Math.floor(gridHeight / imageHeight);

    // Tính số lượng ảnh trong mỗi grid
    const imagesPerGrid = columns * rows;

    // Tính tổng số lượng grids
    const totalGrids = Math.ceil(images.length / imagesPerGrid);
    let currentGridIndex = 0;

    // Kiểm tra và ẩn hiện nút prev-slide và next-slide
    const handleSlideButtons = () => {
        prevButton.style.display = currentGridIndex > 0 ? "block" : "none";
        nextButton.style.display = currentGridIndex < totalGrids - 1 ? "block" : "none";
    };

    // Cuộn đến grid tiếp theo khi nhấn nút next-slide
    nextButton.addEventListener("click", () => {
        if (currentGridIndex < totalGrids - 1) {
            currentGridIndex++;
            const targetScrollLeft = currentGridIndex * gridWidth;
            gridContainer.scrollTo({
                left: targetScrollLeft,
                behavior: "smooth"
            });
        }
        handleSlideButtons();
    });

    // Cuộn đến grid trước đó khi nhấn nút prev-slide
    prevButton.addEventListener("click", () => {
        if (currentGridIndex > 0) {
            currentGridIndex--;
            const targetScrollLeft = currentGridIndex * gridWidth;
            gridContainer.scrollTo({
                left: targetScrollLeft,
                behavior: "smooth"
            });
        }
        handleSlideButtons();
    });

    // Gọi hàm handleSlideButtons khi gridContainer cuộn
    gridContainer.addEventListener("scroll", () => {
        handleSlideButtons();
    });

    // Thiết lập ban đầu
    handleSlideButtons();
};

window.addEventListener("resize", initSlider);
window.addEventListener("load", initSlider);

