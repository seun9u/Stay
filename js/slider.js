document.addEventListener("DOMContentLoaded", () => {
    const minPriceSlider = document.getElementById("min-price");
    const maxPriceSlider = document.getElementById("max-price");
    const minPriceValue = document.getElementById("min-price-value");
    const maxPriceValue = document.getElementById("max-price-value");
    const rangeFill = document.querySelector(".range-fill");
    const resetButton = document.getElementById("reset-filters");
    const form = document.querySelector("form");
    const resultsContainer = document.querySelector(".results"); // 검색 결과 컨테이너

    const stepSize = 1000; // 1000 단위 조정
    const minGap = 5000; // 최소 간격 설정
    const defaultMinPrice = 0;
    const defaultMaxPrice = 500000;

    // 슬라이더 값 업데이트
    function updateSlider() {
        const minValue = Math.round(minPriceSlider.value / stepSize) * stepSize;
        const maxValue = Math.round(maxPriceSlider.value / stepSize) * stepSize;

        minPriceSlider.value = minValue;
        maxPriceSlider.value = maxValue;

        if (maxValue - minValue < minGap) {
            if (this === minPriceSlider) {
                minPriceSlider.value = maxValue - minGap;
            } else {
                maxPriceSlider.value = minValue + minGap;
            }
        }

        minPriceValue.textContent = `${Number(minPriceSlider.value).toLocaleString()}원  ~  `;
        maxPriceValue.textContent = `${Number(maxPriceSlider.value).toLocaleString()}  원`;

        const rangeStart = ((minPriceSlider.value - minPriceSlider.min) / (minPriceSlider.max - minPriceSlider.min)) * 100;
        const rangeEnd = ((maxPriceSlider.value - maxPriceSlider.min) / (maxPriceSlider.max - maxPriceSlider.min)) * 100;

        rangeFill.style.left = `${rangeStart}%`;
        rangeFill.style.width = `${rangeEnd - rangeStart}%`;
    }

    // 실시간 필터 적용
    function applyFilters() {
        const formData = new FormData(form); // 필터 데이터를 가져옴
        const params = new URLSearchParams(formData); // URL 파라미터로 변환

        // URL을 갱신하여 필터 상태 유지
        history.pushState({}, "", "?" + params.toString());

        // AJAX 요청으로 검색 결과 업데이트
        fetch(`search.php?${params.toString()}`)
            .then((response) => response.text())
            .then((html) => {
                console.log(html); // 서버 응답 확인용
                // 기존 검색 결과를 업데이트
                const parser = new DOMParser();
                const newDoc = parser.parseFromString(html, "text/html");
                const newResults = newDoc.querySelector(".results").innerHTML;
                resultsContainer.innerHTML = newResults;
            })
            .catch((error) => {
                console.error("Error fetching results:", error);
            });
    }

    // 초기값 설정
    updateSlider();

    // 슬라이더 이벤트
    minPriceSlider.addEventListener("input", () => {
        updateSlider();
        applyFilters();
    });
    maxPriceSlider.addEventListener("input", () => {
        updateSlider();
        applyFilters();
    });

    // 초기화 버튼 동작
    resetButton.addEventListener("click", (e) => {
        e.preventDefault();

        const categoryRadios = form.querySelectorAll('input[name="category_large"]');
        categoryRadios.forEach((radio) => {
            radio.checked = radio.value === ""; // PHP에서 '전체'를 빈 문자열로 설정
        });

        const locationInput = form.querySelector('input[name="room_location"]');
        if (locationInput) {
            locationInput.value = "";
        }

        minPriceSlider.value = defaultMinPrice;
        maxPriceSlider.value = defaultMaxPrice;
        updateSlider();

        const availableToday = form.querySelector('input[name="is_available_today"]');
        if (availableToday) {
            availableToday.checked = false;
        }

        applyFilters(); // 초기화 후 필터 적용
    });

    // 다른 필터의 실시간 적용
    form.querySelectorAll('input, select').forEach((input) => {
        input.addEventListener("change", applyFilters);
    });
});
