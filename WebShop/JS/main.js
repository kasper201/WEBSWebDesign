document.addEventListener("DOMContentLoaded", function() {
    // Get submenu and parent menu item
    var submenu = document.querySelector('.submenu');
    var parentMenuItem = document.querySelector('.GoToProducts');

    // Show submenu when hovering over parent menu item
    parentMenuItem.addEventListener('mouseover', function() {
        submenu.style.display = 'block';
    });

    // Hide submenu when mouse leaves submenu or parent menu item
    submenu.addEventListener('mouseleave', function() {
        if(!parentMenuItem.contains(event.relatedTarget)) {
            submenu.style.display = 'none';
        }
    });
    parentMenuItem.addEventListener('mouseleave', function() {
        if(!submenu.contains(event.relatedTarget)) {
            submenu.style.display = 'none';
        }
    });
});