
// Lấy tất cả các nút radio và nút chuyển tiếp
var radioBtns = document.querySelectorAll('input[type=radio][name=radio-btn]');
var prevBtn = document.querySelector('.btn-prev');
var nextBtn = document.querySelector('.btn-next');
var slider = document.querySelector('.slider');

prevBtn.style.display = 'none';
nextBtn.style.display = 'none';

// Thêm sự kiện khi di chuột vào slider
slider.addEventListener('mouseenter', function() {
    prevBtn.style.display =  'block';
    nextBtn.style.display = 'block';
});

// Thêm sự kiện khi di chuột rời khỏi slider
slider.addEventListener('mouseleave', function() {
    prevBtn.style.display = 'none';
    nextBtn.style.display = 'none';
});


// Đặt sự kiện click cho nút chuyển tiếp
prevBtn.addEventListener('click', function() {
    // Tìm radio button đang được chọn
    var checkedRadio;
    for (var i = 0; i < radioBtns.length; i++) {
        if (radioBtns[i].checked) {
            checkedRadio = radioBtns[i];
            break;
        }
    }

    // Nếu không có radio button nào được chọn, chọn radio button cuối cùng
    if (!checkedRadio) {
        checkedRadio = radioBtns[radioBtns.length - 1];
    }

    // Lấy index của radio button đang được chọn
    var currentIndex = Array.from(radioBtns).indexOf(checkedRadio);

    // Chuyển đến ảnh trước đó (nếu là ảnh đầu tiên, chuyển đến ảnh cuối cùng)
    var newIndex = currentIndex - 1;
    if (newIndex < 0) {
        newIndex = radioBtns.length - 1;
    }

    // Chuyển đổi radio button và kích hoạt sự kiện change
    radioBtns[newIndex].checked = true;
    radioBtns[newIndex].dispatchEvent(new Event('change'));
});
nextBtn.addEventListener('click', function() {
    // Tìm radio button đang được chọn
    var checkedRadio;
    for (var i = 0; i < radioBtns.length; i++) {
        if (radioBtns[i].checked) {
            checkedRadio = radioBtns[i];
            break;
        }
    }

    // Nếu không có radio button nào được chọn, chọn radio button đầu tiên
    if (!checkedRadio) {
        checkedRadio = radioBtns[0];
    }

    // Lấy index của radio button đang được chọn
    var currentIndex = Array.from(radioBtns).indexOf(checkedRadio);

    // Chuyển đến ảnh tiếp theo (nếu là ảnh cuối cùng, chuyển đến ảnh đầu tiên)
    var newIndex = currentIndex + 1;
    if (newIndex >= radioBtns.length) {
        newIndex = 0;
    }

    // Chuyển đổi radio button và kích hoạt sự kiện change
    radioBtns[newIndex].checked = true;
    radioBtns[newIndex].dispatchEvent(new Event('change'));
});

var counter = 1;
setInterval(function()  {
    document.getElementById('radio'+ counter).checked = true;
    counter++;

    if(counter>5){
        counter=1
    }
}, 9000);

