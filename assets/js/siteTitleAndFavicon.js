// assets/js/siteTitleAndFavicon.js

// URL에서 'title' 파라미터 값을 가져오는 함수
function getTitleFromUrl() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('title');
}

// 페이지 타이틀 설정 함수
function setPageTitle() {
    const title = getTitleFromUrl();
    if (title) {
        document.title = title;  // 타이틀을 쿼리 파라미터로 설정
    }
}

// 사이트 아이콘을 설정하는 함수
function setFavicon(iconPath) {
    var link = document.querySelector("link[rel*='icon']") || document.createElement('link');
    link.type = 'image/x-icon';
    link.rel = 'icon';
    link.href = iconPath;
    document.getElementsByTagName('head')[0].appendChild(link);
}

// 페이지 로드 시 타이틀 설정
setPageTitle();

setFavicon('../assets/images/favicon.ico');  // 아이콘 경로 설정
