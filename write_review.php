<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>리뷰 작성</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* 부드러운 배경색 */
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
            background: #fff; /* 흰색 배경 */
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* 부드러운 그림자 */
            padding: 20px;
            margin-top: 50px; /* 상단 여백 */
            text-align: center; /* 중앙 정렬 */
        }

        h1 {
            color: #0070C0; /* 텍스트 색상 */
            font-size: 28px;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block; /* 블록 요소로 설정하여 줄바꿈 적용 */
            text-align: left; /* 텍스트를 왼쪽 정렬 */
            color: #0070C0; /* 텍스트 색상 */
            font-weight: bold; /* 텍스트를 굵게 표시 */
            margin-bottom: 8px; /* 아래 여백 */
        }

        .inline-label {
            display: flex; /* 플렉스 박스를 사용하여 가로 정렬 */
            align-items: center; /* 요소를 수직 중앙 정렬 */
            justify-content: left; /* 왼쪽 정렬 */
            margin-bottom: 20px; /* 아래 여백 */
        }

        .inline-label label {
            margin: 0; /* 상하좌우 여백 제거 */
            margin-right: 10px; /* 오른쪽 여백 추가 */
        }

        input[type="text"],
        textarea,
        select {
            width: 100%; /* 모든 입력 필드의 너비를 부모에 맞춤 */
            padding: 10px; /* 내부 여백 */
            margin-bottom: 20px; /* 아래 여백 */
            border: 1px solid #ddd; /* 테두리 색상 */
            border-radius: 5px; /* 테두리를 둥글게 설정 */
            font-size: 14px; /* 글자 크기 */
            box-sizing: border-box; /* 패딩과 테두리를 너비에 포함 */
        }

        textarea {
            resize: none; /* 텍스트 영역 크기 조정 비활성화 */
        }

        .button-container {
            display: flex; /* 플렉스 박스를 사용 */
            justify-content: flex-end; /* 버튼을 오른쪽 정렬 */
        }

        button {
            background-color: #0070C0; /* 버튼 배경색 */
            color: #fff; /* 텍스트 색상 */
            border: none; /* 테두리 제거 */
            padding: 10px 20px; /* 내부 여백 */
            font-size: 16px; /* 글자 크기 */
            border-radius: 5px; /* 둥근 모서리 */
            cursor: pointer; /* 클릭 가능한 커서 표시 */
        }

        button:hover {
            background-color: #005a9c; /* 호버 시 어두운 파란색 배경 */
        }
    </style>
</head>
<body>
    <!-- 뒤로가기 버튼 -->
    <a href="reviews.php" class="back-btn">&lt;</a>

    <div class="container">
        <h1>리뷰 작성하기</h1>
        <form action="submit_review.php" method="POST" enctype="multipart/form-data">
            <label for="writer_id">작성자 ID:</label>
            <input type="text" id="writer_id" name="writer_id" required>

            <label for="content_code">콘텐츠 코드:</label>
            <input type="text" id="content_code" name="content_code" required>

            <label for="star">평점:</label>
            <select id="star" name="star" required>
                <option value="5">★★★★★</option>
                <option value="4">★★★★☆</option>
                <option value="3">★★★☆☆</option>
                <option value="2">★★☆☆☆</option>
                <option value="1">★☆☆☆☆</option>
            </select>

            <label for="review_contents">리뷰 내용:</label>
            <textarea id="review_contents" name="review_contents" rows="5" required></textarea>

            <div class="inline-label">
                <label for="photo">이미지 업로드 (최대 10장):</label>
                <input type="file" id="photo" name="photo[]" accept="image/*" multiple>
            </div>

            <!-- 버튼을 오른쪽 정렬 -->
            <div class="button-container">
                <button type="submit">리뷰 제출</button>
            </div>
        </form>
    </div>
</body>
</html>
