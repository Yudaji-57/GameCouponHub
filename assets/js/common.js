// /assets/js/common.js

// 사이드바 토글
document.addEventListener('DOMContentLoaded', function () {
    const sidebarToggleButton = document.getElementById('sidebar-toggle');
    if (sidebarToggleButton) {
        sidebarToggleButton.addEventListener('click', function () {
            var sidebar = document.getElementById('sidebar');
            var icon = document.getElementById('toggle-icon');

            // 'collapsed' 클래스를 추가/제거
            sidebar.classList.toggle('collapsed');

            // 아이콘 변경
            if (sidebar.classList.contains('collapsed')) {
                icon.classList.remove('fa-chevron-left');
                icon.classList.add('fa-chevron-right');  // '펼치기' 아이콘
            } else {
                icon.classList.remove('fa-chevron-right');
                icon.classList.add('fa-chevron-left');  // '접기' 아이콘
            }
        });
    }
});
