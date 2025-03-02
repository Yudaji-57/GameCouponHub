// terms_privacy.js - 이용약관 & 개인정보 처리방침 모달 제어

document.addEventListener("DOMContentLoaded", function () {
    // 모달 요소 가져오기
    const termsModal = new bootstrap.Modal(document.getElementById("termsModal"));
    const privacyModal = new bootstrap.Modal(document.getElementById("privacyModal"));

    // 약관 보기 버튼 클릭 시 모달 표시
    document.querySelectorAll(".open-terms").forEach(button => {
        button.addEventListener("click", function () {
            termsModal.show();
        });
    });

    // 개인정보 처리방침 버튼 클릭 시 모달 표시
    document.querySelectorAll(".open-privacy").forEach(button => {
        button.addEventListener("click", function () {
            privacyModal.show();
        });
    });

    // 모든 모달 닫기 버튼 기능
    document.querySelectorAll(".modal .btn-secondary").forEach(button => {
        button.addEventListener("click", function () {
            termsModal.hide();
            privacyModal.hide();
        });
    });
});
