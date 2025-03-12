function loadComponent(id, filePath) {
    fetch(filePath)
        .then(response => response.text())
        .then(data => document.getElementById(id).innerHTML = data)
        .catch(error => console.error(`Error loading ${filePath}:`, error));
}

document.addEventListener("DOMContentLoaded", function () {
    loadComponent("header", "../includes/header.html");
    loadComponent("footer", "../includes/footer.html");
});
