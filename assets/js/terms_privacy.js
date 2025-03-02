// terms_privacy.js - 이용약관 & 개인정보 처리방침 모달 제어

document.addEventListener("DOMContentLoaded", function () {
    // 모달 요소 가져오기
    const termsModal = new bootstrap.Modal(document.getElementById("termsModal"));
    const privacyModal = new bootstrap.Modal(document.getElementById("privacyModal"));

    // 약관 보기 버튼 클릭 시 모달 표시
    document.querySelectorAll(".open-terms").forEach(button => {
        button.addEventListener("click", function () {
            // inert 속성 제거
            document.querySelector("#termsModal .modal-dialog").removeAttribute('inert');
            termsModal.show();
        });
    });

    // 개인정보 처리방침 버튼 클릭 시 모달 표시
    document.querySelectorAll(".open-privacy").forEach(button => {
        button.addEventListener("click", function () {
            // inert 속성 제거
            document.querySelector("#privacyModal .modal-dialog").removeAttribute('inert');
            privacyModal.show();
        });
    });

    // 모든 모달 닫기 버튼 기능
    document.querySelectorAll(".modal .btn-secondary").forEach(button => {
        button.addEventListener("click", function () {
            // inert 속성 추가
            document.querySelector("#termsModal .modal-dialog").setAttribute('inert', 'true');
            document.querySelector("#privacyModal .modal-dialog").setAttribute('inert', 'true');
            
            termsModal.hide();
            privacyModal.hide();
        });
    });

    // 모달이 열릴 때 포커스 이동 (첫 번째 포커스 가능한 요소로 이동)
    document.getElementById("termsModal").addEventListener('shown.bs.modal', function () {
        this.querySelector('button').focus(); // 예시: 첫 번째 버튼에 포커스
    });

    document.getElementById("privacyModal").addEventListener('shown.bs.modal', function () {
        this.querySelector('button').focus(); // 예시: 첫 번째 버튼에 포커스
    });
});
