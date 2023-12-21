
    function chuyenHuong2() {
    window.location.href = 'Login.php';
}
    function chuyenHuong() {
    window.location.href = 'Register.php';
}
    function chuyenHuong3() {
    window.location.href = 'Hotro.php';
}

let maxQuantity = quantityInput.max;
const lstBtnProperty = document.querySelectorAll('.details-button');

function decreaseQuantity(idProduct, donGia) {
    const textThanhtoan = document.querySelector('#totalPrice');
    let totalPrice = parseInt(textThanhtoan.innerHTML.trim().replace(' ', '').replace('.', '').replace('VND', ''));
    const spanDonGia = document.querySelector('.sp-' + idProduct);
    const quantityInput = document.querySelector('.quantity-' + idProduct);
    let donGiaInt = parseInt(donGia);
    let currentValue = parseInt(quantityInput.value);

    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
        spanDonGia.innerHTML = ((currentValue - 1) * donGiaInt).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});

        const checkBoxSP = document.querySelector(`#myCheckbox_${idProduct}`);
        if (!checkBoxSP.checked) {
            return;
        }
        textThanhtoan.innerHTML = (totalPrice - donGiaInt).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        document.querySelector('input[name="totalPrice"]').value = totalPrice - donGiaInt;
    }
}
function increaseQuantity(idProduct, donGia) {
    const textThanhtoan = document.querySelector('#totalPrice');
    let totalPrice = parseInt(textThanhtoan.innerHTML.trim().replace(' ', '').replace('.', '').replace('VND', ''));
    const spanDonGia = document.querySelector('.sp-' + idProduct);
    const quantityInput = document.querySelector('.quantity-' + idProduct);
    let donGiaInt = parseInt(donGia);
    let currentValue = parseInt(quantityInput.value);
    let maxQuantity = parseInt(quantityInput.max);
    if (currentValue >= maxQuantity) {
        return;
    }
    quantityInput.value = currentValue + 1;
    spanDonGia.innerHTML = ((currentValue + 1) * donGiaInt).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
    
    const checkBoxSP = document.querySelector(`#myCheckbox_${idProduct}`);
    if (!checkBoxSP.checked) {
        return;
    }
    textThanhtoan.innerHTML = (totalPrice + donGiaInt).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
    document.querySelector('input[name="totalPrice"]').value = totalPrice + donGiaInt;
}
function changeQuantity(idProduct, donGia) {
    const spanDonGia = document.querySelector('.sp-' + idProduct);
    const quantityInput = document.querySelector('.quantity-' + idProduct);

    let currentValue = parseInt(quantityInput.value);
    let maxQuantity = parseInt(quantityInput.max);
    if (currentValue > maxQuantity) {
        quantityInput.value = maxQuantity;
        spanDonGia.innerHTML = (maxQuantity * donGia).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        calTotalPrice(idProduct);
        return;
    }
    if (currentValue < 1 || quantityInput.value == '') {
        quantityInput.value = 1;
        spanDonGia.innerHTML = donGia.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        calTotalPrice(idProduct);
        return;
    }
    spanDonGia.innerHTML = (currentValue * donGia).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
    calTotalPrice(idProduct);
}

function calTotalPrice(idDetail) {
    const checkBoxSP = document.querySelector(`#myCheckbox_${idDetail}`);
    if (!checkBoxSP.checked) {
        return;
    }
    const textThanhtoan = document.querySelector('#totalPrice');
    let totalPrice = 0;
    const spanDonGia = document.querySelectorAll('.span-don-gia');
    spanDonGia.forEach(function (item) {
        totalPrice += parseInt(item.innerHTML.trim().replace(' ', '').replace('.', '').replace('VND', ''));
    });
    textThanhtoan.innerHTML = totalPrice.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
    document.querySelector('input[name="totalPrice"]').value = totalPrice;
}

const selectAllCheckbox = document.getElementById('myCheckbox_final');
const productCheckboxes = document.querySelectorAll('.product-checkbox');
const btnSubmit = document.querySelector('#btnSubmit');
window.onload = function() {
    let checkContain = false;
    productCheckboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            checkContain = true;
        }
    });
    if (checkContain) {
        btnSubmit.disabled = false;
    } else {
        btnSubmit.disabled = true;
    }
}

function calTotal(e) {
    const textThanhtoan = document.querySelector('#totalPrice');
    let totalPrice = parseInt(textThanhtoan.innerHTML.trim().replace(' ', '').replace('.', '').replace('VND', ''));
    const spanDonGia = document.querySelector('.sp-' + e.target.defaultValue);
    
    if (e.target.checked) {
        totalPrice += parseInt(spanDonGia.innerHTML.trim().replace(' ', '').replace('.', '').replace('VND', ''));
    } else {
        totalPrice -= parseInt(spanDonGia.innerHTML.trim().replace(' ', '').replace('.', '').replace('VND', ''));
        if (selectAllCheckbox.checked) {
            selectAllCheckbox.checked = false;
        }
    }
    textThanhtoan.innerHTML = totalPrice.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
    document.querySelector('input[name="totalPrice"]').value = totalPrice;

    // check disable button
    let checkContain = false;
    productCheckboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            checkContain = true;
        }
    });
    if (checkContain) {
        btnSubmit.disabled = false;
    } else {
        btnSubmit.disabled = true;
    }
}

selectAllCheckbox.addEventListener('change', function() {
    let totalPrice = 0;
    productCheckboxes.forEach(function(checkbox) {
        checkbox.checked = selectAllCheckbox.checked;
        if (checkbox.checked) {
            const id = checkbox.id.replace('myCheckbox_', '');
            const donGia = parseInt(document.querySelector(`.sp-${id}`).innerHTML.trim().replace(' ', '').replace('.', '').replace('VND', ''));
            totalPrice += donGia;
        }
    });
    const textThanhtoan = document.querySelector('#totalPrice');
    textThanhtoan.innerHTML = totalPrice.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
    document.querySelector('input[name="totalPrice"]').value = totalPrice;

    // check disable button
    let checkContain = false;
    productCheckboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            checkContain = true;
        }
    });
    if (checkContain) {
        btnSubmit.disabled = false;
    } else {
        btnSubmit.disabled = true;
    }
});