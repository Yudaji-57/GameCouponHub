document.addEventListener("DOMContentLoaded", function () {
    let currentPage = 1; // 현재 페이지 번호
    const itemsPerPage = 10; // 한 페이지에 표시할 항목 수
    let couponsData = []; // 전체 쿠폰 데이터

    // 검색 함수
    const searchCoupons = (searchTerm) => {
        return couponsData.filter(coupon => {
            return coupon.game_name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                coupon.coupon_code.toLowerCase().includes(searchTerm.toLowerCase());
        });
    };

    // 페이지 네비게이션 함수
    const paginateCoupons = (coupons, page) => {
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        return coupons.slice(start, end);
    };

    // 테이블 갱신 함수
    const updateTable = (coupons) => {
        const couponTableBody = document.querySelector("#couponTable tbody");
        couponTableBody.innerHTML = ''; // 테이블 비우기

        coupons.forEach(coupon => {
            const row = document.createElement("tr");

            // 날짜 포맷 변환 (예: '2025-01-06' -> '2025-01-06')
            const formatDate = (dateString) => {
                if (!dateString) return ''; // 날짜가 없을 경우 빈 문자열 반환
                const date = new Date(dateString);
                if (isNaN(date.getTime())) return ''; // 날짜가 잘못된 경우 빈 문자열 반환
                return `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;
            };

            // 만료 여부 구분
            const isExpired = coupon.expiry_date && new Date(coupon.expiry_date) < new Date() ? '만료' : '유효';

            row.innerHTML = `
                <td>${coupon.game_name}</td>
                <td>${coupon.coupon_code}</td>
                <td>${coupon.reward_details}</td>
                <td>${formatDate(coupon.issue_date)}</td>
                <td>${formatDate(coupon.expiry_date)}</td>
                <td>${formatDate(coupon.coupon_created_at)}</td>
                <td>${coupon.coupon_type}</td>
                <td>${isExpired}</td>
            `;
            couponTableBody.appendChild(row);
        });
    };

    // 페이지 네비게이션 버튼 핸들러
    const updatePagination = (filteredCoupons) => {
        const totalPages = Math.ceil(filteredCoupons.length / itemsPerPage);
        const prevButton = document.querySelector("#prevButton");
        const nextButton = document.querySelector("#nextButton");
        const pageInfo = document.querySelector("#pageInfo");

        // 페이지 정보 업데이트
        pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;

        // 이전/다음 버튼 상태 업데이트
        prevButton.disabled = currentPage === 1;
        nextButton.disabled = currentPage === totalPages;

        // 페이지 업데이트
        const paginatedCoupons = paginateCoupons(filteredCoupons, currentPage);
        updateTable(paginatedCoupons);
    };

    // 쿠폰 데이터 가져오기
    fetch('/backend/admin/coupons_data.php')
        .then(response => response.json())
        .then(data => {
            if (!data || !Array.isArray(data.coupons)) {
                console.error('잘못된 데이터 형식', data);
                return;
            }
            couponsData = data.coupons; // 전체 쿠폰 데이터를 저장
            const filteredCoupons = searchCoupons(""); // 기본적으로 모든 쿠폰 표시
            updatePagination(filteredCoupons);
        })
        .catch(error => {
            console.error('쿠폰 데이터를 불러오는 중 오류가 발생했습니다.', error);
        });

    // 검색 이벤트 리스너
    document.querySelector("#searchInput").addEventListener("input", function () {
        const searchTerm = this.value;
        const filteredCoupons = searchCoupons(searchTerm);
        currentPage = 1; // 검색 시 첫 페이지로 리셋
        updatePagination(filteredCoupons);
    });

    // 이전 버튼 이벤트
    document.querySelector("#prevButton").addEventListener("click", function () {
        if (currentPage > 1) {
            currentPage--;
            const filteredCoupons = searchCoupons(document.querySelector("#searchInput").value);
            updatePagination(filteredCoupons);
        }
    });

    // 다음 버튼 이벤트
    document.querySelector("#nextButton").addEventListener("click", function () {
        const totalPages = Math.ceil(couponsData.length / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            const filteredCoupons = searchCoupons(document.querySelector("#searchInput").value);
            updatePagination(filteredCoupons);
        }
    });
});
