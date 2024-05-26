document.addEventListener("DOMContentLoaded", function() {
    // Get all submenu and parent menu item
    var submenus = document.querySelectorAll('.submenu');
    var parentMenuItems = document.querySelectorAll('.GoToProducts');

    // Show submenu when hovering over parent menu item
    parentMenuItems.forEach(function(parentMenuItem, index) {
        var submenu = submenus[index];
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
});

document.addEventListener("DOMContentLoaded", function() {
    // Get all submenu and parent menu item
    var submenus = document.querySelectorAll('.submenuLogin');
    var parentMenuItems = document.querySelectorAll('.loginInfo');
    var timeoutId;

    // Show submenu when hovering over parent menu item
    parentMenuItems.forEach(function(parentMenuItem, index) {
        var submenu = submenus[index];
        parentMenuItem.addEventListener('mouseenter', function() {
            clearTimeout(timeoutId);
            submenu.classList.add('open');
        });

        // Hide submenu when mouse leaves submenu or parent menu item
        submenu.addEventListener('mouseleave', function(event) {
            if (!parentMenuItem.contains(event.relatedTarget)) {
                timeoutId = setTimeout(function() {
                    submenu.classList.remove('open');
                }, 200);
            }
        });
        parentMenuItem.addEventListener('mouseleave', function(event) {
            if (!submenu.contains(event.relatedTarget)) {
                timeoutId = setTimeout(function() {
                    submenu.classList.remove('open');
                }, 200);
            }
        });
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
    fetch('./getCategories.php')
        .then(response => response.text())
        .then(data => {
            const menuContainer = document.querySelector('#menuContainer');
            if (menuContainer) {
                menuContainer.innerHTML = data;
            }
        });
});

function deleteCookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function redirectToCategory() {
    var categorySelect = document.getElementById('category');
    var selectedCategory = categorySelect.options[categorySelect.selectedIndex].value;
    var currentPage = window.location.pathname.split('/').pop();

    // Only redirect if the current page is Products.php or Main.php
    if (currentPage === 'Products.php' || currentPage === 'Main.php') {
        if (selectedCategory === 'ALL') {
            window.location.href = currentPage;
        } else {
            window.location.href = currentPage + '?category=' + selectedCategory;
        }
    }
}