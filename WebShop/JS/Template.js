document.addEventListener("DOMContentLoaded", function() {
    // Get submenu and parent menu item
    var submenu = document.querySelector('.submenu');
    var parentMenuItem = document.querySelector('.GoToProducts');

    // Show submenu when hovering over parent menu item
    parentMenuItem.addEventListener('mouseenter', function() {
        submenu.classList.add('open');
    });

    // Hide submenu when mouse leaves submenu or parent menu item
    submenu.addEventListener('mouseleave', function(event) {
        if (!parentMenuItem.contains(event.relatedTarget)) {
            submenu.classList.remove('open');
        }
    });
    parentMenuItem.addEventListener('mouseleave', function(event) {
        if (!submenu.contains(event.relatedTarget)) {
            submenu.classList.remove('open');
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Get the button element
    var button = document.querySelector('.GoToContact');

    // Add click event listener to the button
    button.addEventListener('click', function() {
        // Redirect to the specified URL
        window.location.href = "../php/Contact.php";
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Get the button element
    var button = document.querySelector('.GoToAbout');

    // Add click event listener to the button
    button.addEventListener('click', function() {
        // Redirect to the specified URL
        window.location.href = "../php/About.php";
    });
});

window.addEventListener('DOMContentLoaded', (event) => {
    fetch('http://localhost/WebShop/php/generateMenu(class).php')
        .then(response => response.text())
        .then(data => {
            const menuContainer = document.querySelector('#menuContainer');
            if (menuContainer) {
                menuContainer.innerHTML = data;
            }
        });
});