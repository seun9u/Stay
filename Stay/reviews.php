<?php
// 데이터베이스 연결
$host = 'localhost';
$user = 'root';
$password = ''; // MySQL 비밀번호
$dbname = 'stay'; // 데이터베이스 이름

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("DB 연결 실패: " . $conn->connect_error);
}

// 평균 평점 및 별점 계산
$sqlAvg = "SELECT AVG(star) as avg_star FROM review";
$resultAvg = $conn->query($sqlAvg);

if ($resultAvg && $resultAvg->num_rows > 0) {
    $rowAvg = $resultAvg->fetch_assoc();
    $avgStar = round($rowAvg['avg_star'], 1); // 평점 평균 반올림 (소수점 1자리)
} else {
    $avgStar = 0; // 리뷰가 없을 경우 기본값
}

// GET 요청 처리
$filterPhotoOnly = isset($_GET['photo_only']) && $_GET['photo_only'] == 'on';
$sortOption = isset($_GET['sort']) ? $_GET['sort'] : 'newest';

// 기본 SQL
$sql = "SELECT *, TIMESTAMPDIFF(SECOND, created_at, NOW()) AS time_diff FROM review";

// 사진 후기 필터 적용
if ($filterPhotoOnly) {
    $sql .= " WHERE JSON_LENGTH(photo) > 0";
}

// 정렬 옵션 처리
switch ($sortOption) {
    case 'high_rating':
        $sql .= " ORDER BY star DESC";
        break;
    case 'low_rating':
        $sql .= " ORDER BY star ASC";
        break;
    default:
        $sql .= " ORDER BY review_id DESC"; // 최신 작성 순
}

$result = $conn->query($sql);

if (!$result) {
    die("쿼리 실행 실패: " . $conn->error);
}

// 시간 차이를 인간이 읽을 수 있는 형식으로 변환하는 함수
function timeAgo($time_diff) {
    if ($time_diff < 60) {
        return $time_diff . "초 전";
    } elseif ($time_diff < 3600) {
        return floor($time_diff / 60) . "분 전";
    } elseif ($time_diff < 86400) {
        return floor($time_diff / 3600) . "시간 전";
    } else {
        return floor($time_diff / 86400) . "일 전";
    }
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>리뷰 페이지</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

 /* 뒤로가기 버튼 */
        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: transparent;
            color: #000;
            font-size: 30px;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .back-btn:hover {
            color: #333;
        }


        .container {
            width: 60%;
            margin: 0 auto;
            padding-top: 20px;
        }

        .header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .rating-section {
            text-align: center;
            padding: 20px;
        }

        .rating-section .stars {
            font-size: 24px;
            color: #f39c12;
        }

        .rating-section .score {
            font-size: 32px;
            font-weight: bold;
            margin: 10px 0;
        }

/* 전체 별 컨테이너 */
.star-container {
    display: inline-block;
    position: relative;
    font-size: 24px;
    line-height: 1;
    color: #ddd; /* 빈 별 색상 */
    width: 24px; /* 별 하나의 고정 너비 */
    height: 24px;
    overflow: hidden;
}

/* 노란색으로 채워진 별 */
.stars {
        display: flex;
        justify-content: center;
        gap: 5px; /* 별 간 간격 */
    }
    .star-container {
        position: relative;
        display: inline-block;
        font-size: 24px;
        width: 24px;
        height: 24px;
        line-height: 1;
    }
    .star-container span {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        overflow: hidden;
    }
    .star-container .empty {
        color: #ddd;
        z-index: 0;
    }
    .star-container .filled {
        color: #f39c12;
        z-index: 1;
    }

        .image-gallery {
            display: flex;
            justify-content: flex-end;
            padding: 10px 0;
            gap: 10px;
        }

        .image-gallery a {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .image-gallery a:hover {
            text-decoration: underline;
        }

/* 필터 섹션을 오른쪽 정렬 */
/* 필터 섹션 레이아웃 */
.filter-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 5px;
    padding-bottom: 10px; /* 여백 추가 */
    border-bottom: 1px solid #ddd; /* 회색 구분선 추가 */
}


/* 왼쪽 섹션: 사진후기 체크박스 */
.filter-section div:first-child {
    text-align: left;
    margin-left: -10px;
}

.filter-section div:first-child label {
    display: inline-block;
    position: relative; /* 위치 조정을 위해 설정 */
    top: 5px; /* 아주 조금 아래로 내림 */
}

/* 체크박스를 텍스트와 정렬 */
.filter-section div:first-child label input[type="checkbox"] {
    vertical-align: middle; /* 텍스트와 체크박스 높이를 맞춤 */
    margin-top: 0; /* 위쪽 간격 제거 */
}


/* 오른쪽 섹션: 정렬 옵션 */
.filter-section div:last-child {
    text-align: right;
    margin-right: -5px;
}

/* 공통 스타일 */
.filter-section select, 
.filter-section label {
    font-size: 14px;
    margin: 0 5px;
}


             .review-list {
            margin-top: 20px;
        }

        .review-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px solid #ddd;
            padding: 15px 0;
        }

        .review-content {
            flex: 1;
        }

        .review-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .review-item img:hover {
            transform: scale(1.1);
        }

        .review-item .stars-container {
            display: flex;
            align-items: center;
        }

        .review-item .stars {
            color: #f39c12;
            font-size: 16px;
            margin-right: 10px;
        }

        .time-ago {
            font-size: 12px;
            color: #888;
        }

        .delete-container {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 5px;
        }

        .delete-link {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .delete-link:hover {
            text-decoration: underline;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        .modal .close {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #fff;
            font-size: 30px;
            cursor: pointer;
        }
    </style>
</head>
<body>

 <!-- 뒤로가기 버튼 -->
    <a href="contents_detail.php" class="back-btn">&lt;</a>

    <div class="container">
        <!-- 헤더 -->
        <div class="header">
            <h1>후기</h1>
        </div>

       <!-- 평점 섹션 -->
<div class="rating-section">
    <!-- 별 평균 표시 -->
    <div class="stars" style="display: flex; justify-content: center;">
        <?php
        // 정수 부분과 소수점 부분 분리
        $integerPart = floor($avgStar); // 정수 부분
        $fractionPart = $avgStar - $integerPart; // 소수점 부분

        // 5개의 별 출력
        for ($i = 0; $i < 5; $i++) {
            echo '<div class="star-container" style="position: relative; display: inline-block; font-size: 24px;">';

            // 채워진 별 (정수 부분)
            if ($i < $integerPart) {
                echo '<span style="color: #f39c12;">★</span>';
            }
            // 부분적으로 채워진 별 (소수점 부분)
            elseif ($i == $integerPart && $fractionPart > 0) {
                $width = round($fractionPart * 100); // 소수점 비율을 백분율로 변환
                echo '<span style="color: #ddd; position: absolute;">★</span>'; // 빈 별
                echo '<span style="color: #f39c12; position: absolute; width: ' . $width . '%; overflow: hidden;">★</span>'; // 부분 채움
            }
            // 빈 별
            else {
                echo '<span style="color: #ddd;">★</span>';
            }

            echo '</div>';
        }
        ?>
    </div>
    <!-- 평점 평균 표시 -->
    <div class="score" style="margin-top: 10px; font-size: 32px; font-weight: bold;"><?php echo $avgStar; ?></div>
    <div>평점</div>
</div>

      
<!-- 후기 이미지 섹션 -->
<div class="image-gallery">
    <a href="write_review.php">리뷰 작성하기</a>
</div>

<!-- 필터 및 정렬 옵션 -->
<div class="filter-section" style="display: flex; justify-content: space-between; align-items: center; margin-top: 5px;">
    <!-- 왼쪽: 사진후기만 보기 -->
    <div style="flex: 1; text-align: left;">
        <form method="GET" action="reviews.php" style="display: inline;">
            <label>
                <input type="checkbox" name="photo_only" 
                       onchange="this.form.submit()" 
                       <?php echo $filterPhotoOnly ? 'checked' : ''; ?>> 사진후기만 보기
            </label>
        </form>
    </div>
    
    <!-- 오른쪽: 정렬 옵션 -->
    <div style="flex: 1; text-align: right;">
        <form method="GET" action="reviews.php" style="display: inline;">
            <select name="sort" onchange="this.form.submit()">
                <option value="newest" <?php echo $sortOption == 'newest' ? 'selected' : ''; ?>>최신 작성 순</option>
                <option value="high_rating" <?php echo $sortOption == 'high_rating' ? 'selected' : ''; ?>>평점 높은 순</option>
                <option value="low_rating" <?php echo $sortOption == 'low_rating' ? 'selected' : ''; ?>>평점 낮은 순</option>
            </select>
        </form>
    </div>
</div>



        <!-- 리뷰 리스트 -->
        <div class="review-list">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="review-item">
                        <!-- 리뷰 내용 -->
                        <div class="review-content">
                            <div class="stars-container">
                                <div class="stars"><?php echo str_repeat('★', $row['star']); ?></div>
                                <div class="time-ago"><?php echo timeAgo($row['time_diff']); ?></div>
                            </div>
                            <p><strong><?php echo htmlspecialchars($row['writer_id']); ?></strong></p>
                            <p><?php echo htmlspecialchars($row['review_contents']); ?></p>

                            <!-- 여러 이미지 표시 -->
                            <?php 
                            $photos = json_decode($row['photo'], true); 
                            if (!empty($photos)):
                                foreach ($photos as $photo): ?>
                                    <img src="<?php echo htmlspecialchars($photo); ?>" alt="리뷰 이미지" class="clickable-img">
                                <?php endforeach;
                            endif;
                            ?>
                        </div>

                        <!-- 삭제 버튼 -->
                        <div class="delete-container">
                            <form action="delete_review.php" method="POST">
                                <input type="hidden" name="review_id" value="<?php echo $row['review_id']; ?>">
                                <button type="submit" class="delete-link">삭제</button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>등록된 리뷰가 없습니다.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- 이미지 확대 모달 -->
    <div class="modal" id="imageModal">
        <span class="close">&times;</span>
        <img src="" alt="확대 이미지">
    </div>

    <script>
        const modal = document.getElementById('imageModal');
        const modalImg = modal.querySelector('img');
        const closeModal = modal.querySelector('.close');
        const images = document.querySelectorAll('.clickable-img');

        images.forEach(image => {
            image.addEventListener('click', () => {
                modal.style.display = 'flex';
                modalImg.src = image.src;
            });
        });

        closeModal.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
