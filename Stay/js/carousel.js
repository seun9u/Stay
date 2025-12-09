const carousel = document.querySelector('.carousel');
const items = document.querySelectorAll('.carousel-item');
const prevBtn = document.querySelector('.carousel-prev');
const nextBtn = document.querySelector('.carousel-next');
const indicators = document.querySelectorAll('.carousel-indicators span');

let currentIndex = 0;
const itemsPerPage = 3; // 한 번에 보여줄 슬라이드 개수
const totalPages = Math.ceil(items.length / itemsPerPage);

// 슬라이드 이동
function moveToSlide(index) {
    currentIndex = index;
    const offset = -(100 / itemsPerPage) * currentIndex * itemsPerPage;
    carousel.style.transform = `translateX(${offset}%)`;

    // 인디케이터 활성화 업데이트
    indicators.forEach((indicator, i) => {
        indicator.classList.toggle('active', i === currentIndex);
    });
}

// 이전 버튼 이벤트
prevBtn.addEventListener('click', () => {
    currentIndex = currentIndex === 0 ? totalPages - 1 : currentIndex - 1;
    moveToSlide(currentIndex);
});

// 다음 버튼 이벤트
nextBtn.addEventListener('click', () => {
    currentIndex = currentIndex === totalPages - 1 ? 0 : currentIndex + 1;
    moveToSlide(currentIndex);
});

// 인디케이터 클릭 이벤트
indicators.forEach((indicator, index) => {
    indicator.addEventListener('click', () => moveToSlide(index));
});

// 초기화
moveToSlide(0);
const autoSlideInterval = 4000;
setInterval(() => {
    currentIndex = currentIndex === totalPages - 1 ? 0 : currentIndex + 1;
    moveToSlide(currentIndex);
}, autoSlideInterval);