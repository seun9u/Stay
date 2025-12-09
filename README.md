# 🏨 STAY (Accommodation Reservation Platform)

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![Apache](https://img.shields.io/badge/Apache-D22128?style=for-the-badge&logo=apache&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)

> **"Native PHP로 구현한 숙소 예약 시스템, STAY"**
> 프레임워크 없이 직접 관계형 데이터베이스를 설계하고, 정교한 쿼리 로직으로 예약 데이터의 정합성을 확보한 웹 플랫폼입니다.

---

## 🛠️ Tech Stack

| Category | Technology |
| --- | --- |
| **Backend** | Native PHP |
| **Database** | MySQL (phpMyAdmin) |
| **Server** | Apache Web Server (XAMPP) |
| **Frontend** | HTML5, CSS3, JavaScript |

---

## 💡 Key Features

* **📅 실시간 예약 시스템**
    * 숙소 상세 정보 확인 및 체크인/체크아웃 날짜 선택을 통한 예약 기능.
* **🚫 예약 중복 방지 로직 (Core)**
    * PHP와 SQL 쿼리를 활용하여 사용자가 선택한 날짜에 이미 예약된 내역이 있는지 검증.
* **🔍 숙소 검색 및 필터링**
    * 지역별, 카테고리별 숙소 리스트 조회.
* **👤 회원 관리**
    * 회원가입, 로그인, 마이페이지(예약 내역 조회) 구현.

---

## 🚀 Core Logic & Database Design

이 프로젝트에서 가장 중점적으로 구현한 기술적 내용입니다.

### 1. Database ERD Design
숙소 예약 시스템의 핵심인 데이터 관계를 **정규화(Normalization)**하여 설계했습니다.
* **Users ↔ Reservations:** 1:N (한 명의 회원은 여러 예약을 할 수 있음)
* **Accommodations ↔ Reservations:** 1:N (하나의 숙소는 여러 날짜에 예약될 수 있음)
* **Accommodations ↔ Rooms:** 1:N (숙소는 여러 개의 객실 타입을 가짐)

---

## 💻 How to Run (Local)

1. **Environment Setup**
    * XAMPP (Apache, MySQL) 설치 및 실행.
2. **Database Setup**
    * `http://localhost/phpmyadmin` 접속.
    * `stay_db` 데이터베이스 생성.
    * 프로젝트 내 `database.sql` 파일을 Import.
3. **Project Setup**
    * `C:\xampp\htdocs` 폴더 내에 프로젝트 클론.
    ```bash
    cd C:\xampp\htdocs
    git clone [https://github.com/seun9u/Stay.git](https://github.com/seun9u/Stay.git)
    ```
4. **Config DB**
    * DB 연결 설정 파일(`db_conn.php`)에서 계정 정보 확인.
5. **Run**
    * 브라우저에서 `http://localhost/Stay` 접속.
