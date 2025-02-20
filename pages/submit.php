<!-- /GameCouponHub/pages/submit.html -->
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameCouponHub - 쿠폰 제보</title>
    <link rel="stylesheet" href="../assets/css/submit.css"> <!-- submit.css: 쿠폰 제보 스타일 -->
    <script src="../assets/js/submit.js" defer></script> <!-- submit.js: 쿠폰 제보 JS -->
</head>
<body>
    <!-- Header include -->
    <!--#include virtual="/includes/header.html"-->

    <main>
        <section>
            <h1>쿠폰 제보</h1>
            <form>
                <label for="game">게임명:</label>
                <input type="text" id="game" name="game" required>
                
                <label for="coupon">쿠폰 코드:</label>
                <input type="text" id="coupon" name="coupon" required>
                
                <button type="submit">제보하기</button>
            </form>
        </section>
    </main>

    <!-- Footer include -->
    <!--#include virtual="/includes/footer.html"-->
</body>
</html>
