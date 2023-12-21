const tongtienhang = document.getElementById('tongtienhang');
const phivc = document.getElementById('phivc');
const tongtt = document.getElementById('tongtt');

window.onload = function() {
    const tienhangValue = parseInt(tongtienhang.querySelector('.line2').innerHTML.trim().replace(' ', '').replace('.', '').replace('VND', ''));
    const phivcValue = parseInt(phivc.querySelector('.line2').innerHTML.trim().replace(' ', '').replace('.', '').replace('VND', ''));

    tongtt.querySelector('.line3').innerHTML = (tienhangValue + phivcValue).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
}

const lstBtnDiaChi = document.querySelectorAll('.row-diachi');
const nameDefault = document.getElementById('name-default');
const phoneDefault = document.getElementById('phone-default');
const addressDefault = document.getElementById('address-default');

const deliveryAddress = document.getElementById('delivery-address');

function changeDiaChi(e) {
    lstBtnDiaChi.forEach(function(btn) {
        btn.classList.remove('d-none');
    });
    e.target.parentElement.classList.add('d-none');
    
    nameDefault.innerHTML = e.target.parentElement.parentElement.querySelector('.name').innerHTML.trim();
    phoneDefault.innerHTML = e.target.parentElement.parentElement.querySelector('.phone').innerHTML.trim();
    addressDefault.innerHTML = e.target.parentElement.parentElement.querySelector('.address').innerHTML.trim();
    deliveryAddress.value = e.target.id;
    const province = e.target.parentElement.parentElement.querySelector('.address-province').innerHTML.trim();
    const tienhangValue = parseInt(parseInt(tongtienhang.querySelector('.line2').innerHTML.trim().replace(' ', '').replace('.', '').replace('VND', '')));
    if (province.toLowerCase().includes('hà nội')) {
        if (tienhangValue < 500000) {
            phivc.querySelector('.line2').innerHTML = '30.000 VND';
            phivc.querySelector('input[name="fee-ship"]').innerHTML = '30000';
        } else {
            phivc.querySelector('.line2').innerHTML = '0 VND';
            phivc.querySelector('input[name="fee-ship"]').innerHTML = '0';
        }
    } else {
        phivc.querySelector('.line2').innerHTML = '50.000 VND';
        phivc.querySelector('input[name="fee-ship"]').innerHTML = '50000';
    }
    const phivcValue = parseInt(phivc.querySelector('.line2').innerHTML.trim().replace(' ', '').replace('.', '').replace('VND', ''));
    tongtt.querySelector('.line3').innerHTML = (tienhangValue + phivcValue).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
}