<?php
// PDO를 활용한 데이터베이스 연결 및 쿼리 함수 정의

/**
 * PDO 연결 생성
 * @return PDO
 */
function db_get_pdo() {
    $host = 'localhost';
    $port = '3306';
    $dbname = 'stay'; // 데이터베이스 이름
    $charset = 'utf8';
    $username = 'root'; // MySQL 기본 사용자
    $password = ""; // MySQL 기본 비밀번호 (XAMPP는 기본적으로 빈 값)
    
    // DSN 생성
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";
    try {
        // PDO 객체 생성
        $pdo = new PDO($dsn, $username, $password);
        // 에러 모드를 예외 처리로 설정
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("데이터베이스 연결 실패: " . $e->getMessage());
    }
}

/**
 * 데이터 조회
 * @param string $query SQL 쿼리
 * @param array $param 바인딩할 매개변수 배열
 * @return array|false 조회 결과 또는 실패 시 false
 */
function db_select($query, $param = array()) {
    $pdo = db_get_pdo();
    try {
        $st = $pdo->prepare($query);
        $st->execute($param);
        return $st->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
        return false;
    } finally {
        $pdo = null; // 연결 닫기
    }
}

/**
 * 데이터 삽입
 * @param string $query SQL 쿼리
 * @param array $param 바인딩할 매개변수 배열
 * @return int|false 삽입된 행의 ID 또는 실패 시 false
 */
function db_insert($query, $param = array()) {
    $pdo = db_get_pdo();
    try {
        $st = $pdo->prepare($query);
        $result = $st->execute($param);
        return $result ? $pdo->lastInsertId() : false;
    } catch (PDOException $ex) {
        return false;
    } finally {
        $pdo = null; // 연결 닫기
    }
}

/**
 * 데이터 업데이트 및 삭제
 * @param string $query SQL 쿼리
 * @param array $param 바인딩할 매개변수 배열
 * @return bool 실행 성공 여부
 */
function db_update_delete($query, $param = array()) {
    $pdo = db_get_pdo();
    try {
        $st = $pdo->prepare($query);
        $result = $st->execute($param);

        // 디버깅: 쿼리 실행 결과 확인
        if (!$result) {
            print_r($st->errorInfo()); // PDO 오류 출력
        }

        return $result;
    } catch (PDOException $ex) {
        echo "PDOException: " . $ex->getMessage(); // PDO 예외 메시지 출력
        return false;
    } finally {
        $pdo = null; // 연결 닫기
    }
}

?>
