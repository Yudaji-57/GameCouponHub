# 프로젝트 제목

프로젝트에 대한 간략한 설명을 추가합니다. 예를 들어, 이 프로젝트는 모바일 게임 쿠폰 관리 시스템으로, 사용자들이 쿠폰을 검색하고 관리할 수 있게 돕습니다.

## 목차
1. [설치 방법](#설치-방법)
2. [사용 방법](#사용-방법)
3. [기여 방법](#기여-방법)
4. [라이선스](#라이선스)

## 설치 방법

이 프로젝트를 로컬에서 실행하려면 다음 단계를 따르세요:

### 필수 요구 사항
- PHP 7.4 이상
- MySQL 5.7 이상
- Composer

### 설치 절차

1. **프로젝트 클론**:
    ```bash
    git clone https://github.com/yourusername/GameCouponHub.git
    cd GameCouponHub
    ```

2. **의존성 설치**:
    Composer를 사용하여 필요한 라이브러리들을 설치합니다:
    ```bash
    composer install
    ```

3. **.env 파일 설정**:
    `.env.example` 파일을 `.env`로 복사하고, 데이터베이스 및 이메일 설정을 맞게 수정합니다:
    ```bash
    cp .env.example .env
    ```

4. **데이터베이스 설정**:
    데이터베이스를 설정하고, `database.php` 파일에 맞는 정보로 업데이트하세요.

5. **서버 실행**:
    로컬 서버를 실행하려면:
    ```bash
    php -S localhost:8801
    ```

## 사용 방법

프로젝트를 실행한 후, 웹 브라우저에서 `http://localhost:8801`에 접속하여 프로젝트를 사용할 수 있습니다. 비밀번호 찾기, 쿠폰 관리 등 여러 기능을 확인할 수 있습니다.

## 기여 방법

이 프로젝트에 기여하고 싶다면, 아래 단계를 따르세요:

1. Fork 이 프로젝트
2. 새 브랜치를 만드세요 (`git checkout -b feature-branch`)
3. 변경사항을 커밋하세요 (`git commit -am 'Add new feature'`)
4. 브랜치를 푸시하세요 (`git push origin feature-branch`)
5. Pull Request를 제출하세요

## 라이선스

이 프로젝트는 MIT 라이선스 하에 라이센스가 제공됩니다. 자세한 내용은 `LICENSE` 파일을 참조하세요.

## 연락처

- 개발자: 차성민
- 이메일: cis5686@gmail.com
