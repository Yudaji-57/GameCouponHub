document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("darkModeToggle");
    const body = document.body;

    // 로컬 스토리지에서 다크 모드 상태 불러오기
    if (localStorage.getItem("darkMode") === "enabled") {
        body.classList.add("dark-mode");
        toggleButton.textContent = "☀️"; // 라이트 모드 아이콘
    }

    // 버튼 클릭 시 모드 전환
    toggleButton.addEventListener("click", function () {
        body.classList.toggle("dark-mode");

        if (body.classList.contains("dark-mode")) {
            localStorage.setItem("darkMode", "enabled");
            toggleButton.textContent = "☀️"; // 라이트 모드 아이콘
        } else {
            localStorage.setItem("darkMode", "disabled");
            toggleButton.textContent = "🌙"; // 다크 모드 아이콘
        }
    });
});
