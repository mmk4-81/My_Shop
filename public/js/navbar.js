document.addEventListener('DOMContentLoaded', function () {
    var avatarDropdown = document.getElementById('avatarDropdown');
    var dropdownMenu = document.getElementById('dropdownMenu');

    avatarDropdown.addEventListener('click', function (event) {
        event.preventDefault();
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });

    window.addEventListener('click', function (event) {
        if (!event.target.closest('.dropdown')) {
            dropdownMenu.style.display = 'none';
        }
    });
});
