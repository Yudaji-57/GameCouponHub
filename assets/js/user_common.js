// /assets/js/user_common.js

document.addEventListener("DOMContentLoaded", function () {
    const currentPath = window.location.pathname;
    document.querySelectorAll(".nav-link").forEach(link => {
        if (link.getAttribute("href") === currentPath) {
            link.classList.add("active");
        }
    });
});

