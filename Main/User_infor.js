document.addEventListener("DOMContentLoaded", function() {
    showContent('info1');
});

function showContent(id) {
    var contentDivs = document.querySelectorAll('.content > div');
    contentDivs.forEach(function(div) {
        div.classList.add('hidden');
    });

    var selectedDiv = document.getElementById(id);
    if (selectedDiv) {
        selectedDiv.classList.remove('hidden');
    }

    var menuItems = document.querySelectorAll('.menu li');
    menuItems.forEach(function(item) {
        item.classList.remove('active');
    });

    var selectedItem = document.querySelector('.menu li[data-id="' + id + '"]');
    if (selectedItem) {
        selectedItem.classList.add('active');
    }
}


document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('passwordInput');
    const passwordIcon = document.getElementById('togglePassword').firstElementChild;

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        // Thay đổi class của Font Awesome để hiển thị biểu tượng mắt mở
        passwordIcon.className = 'fa-solid fa-eye';
    } else {
        passwordInput.type = 'password';
        // Thay đổi class của Font Awesome để hiển thị biểu tượng mắt đóng
        passwordIcon.className = 'fa-sharp fa-solid fa-eye-slash';
    }
});
document.getElementById('togglePassword2').addEventListener('click', function() {
    const passwordInput = document.getElementById('passwordInput2');
    const passwordIcon = document.getElementById('togglePassword2').firstElementChild;

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        // Thay đổi class của Font Awesome để hiển thị biểu tượng mắt mở
        passwordIcon.className = 'fa-solid fa-eye';
    } else {
        passwordInput.type = 'password';
        // Thay đổi class của Font Awesome để hiển thị biểu tượng mắt đóng
        passwordIcon.className = 'fa-sharp fa-solid fa-eye-slash';
    }
});

// ---------- Sự kiện cập nhật và thêm địa chỉ ---------------------
var updateButton = document.getElementById('update-button');
var addButton = document.getElementById('add-button');
var updateForm = document.querySelector('.update-form');
var addForm = document.querySelector('.add-form');
var overlay = document.querySelector('.overlay');
var btnTrolai = document.getElementById('btn-trolai');
var addTrolai = document.getElementById('add-btn-trolai');

// updateButton.addEventListener('click', function(event) {
//     event.preventDefault();
//     updateForm.style.display = 'block';
//     overlay.classList.add('active'); // Thêm lớp active khi form được hiển thị
// });
addButton.addEventListener('click', function(event) {
    event.preventDefault();
    addForm.style.display = 'block';
    overlay.classList.add('active'); // Thêm lớp active khi form được hiển thị
});
// Sự kiện để đóng form và loại bỏ lớp active khi overlay được nhấn
overlay.addEventListener('click', function() {
    updateForm.style.display = 'none';
    overlay.classList.remove('active'); // Loại bỏ lớp active khi form được đóng
});
btnTrolai.addEventListener('click', function() {
    // Tắt update-form và overlay khi nhấn nút "Trở lại"
    updateForm.style.display = 'none';
    overlay.classList.remove('active'); // Loại bỏ lớp active từ overlay
});
addTrolai.addEventListener('click', function() {
    // Tắt update-form và overlay khi nhấn nút "Trở lại"
    addForm.style.display = 'none';
    overlay.classList.remove('active'); // Loại bỏ lớp active từ overlay
});
