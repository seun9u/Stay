document.addEventListener('DOMContentLoaded', () => {
    // 이미지 슬라이드 기능
    const images = document.querySelectorAll('.image-slider img');
    let currentIndex = 0;

    const updateActiveImage = () => {
        images.forEach((img, index) => {
            img.classList.toggle('active', index === currentIndex);
        });
    };

    const prevBtn = document.getElementById('prev');
    const nextBtn = document.getElementById('next');

    if (prevBtn && nextBtn) {
        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            updateActiveImage();
        });

        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % images.length;
            updateActiveImage();
        });
    }

    // 박수와 총 요금 계산
    const decreaseBtn = document.getElementById('decrease-nights');
    const increaseBtn = document.getElementById('increase-nights');
    const nightsSpan = document.getElementById('nights');
    const totalPriceSpan = document.getElementById('total-price');
    const totalPaymentInputCart = document.getElementById('total-payment-input-cart');
    const totalPaymentInputReserve = document.getElementById('total-payment-input');
    const nightsInputCart = document.getElementById('nights-input-cart');
    const nightsInputReserve = document.getElementById('nights-input');

    // 가격 변수 초기화
    const pricePerNight = parseInt(totalPriceSpan.textContent.replace(/[^\d]/g, ''), 10);
    let nights = 1;

    // 총 요금 업데이트 함수
    const updateTotalPrice = () => {
        const totalPrice = pricePerNight * nights;
        totalPriceSpan.textContent = `${totalPrice.toLocaleString()}`;
        nightsSpan.textContent = nights;

        // Hidden input에 총 금액과 숙박 일수 업데이트
        totalPaymentInputCart.value = totalPrice;
        totalPaymentInputReserve.value = totalPrice;
        nightsInputCart.value = nights;
        nightsInputReserve.value = nights;
    };

    // 증가 버튼 이벤트 리스너
    if (increaseBtn) {
        increaseBtn.addEventListener('click', () => {
            nights++;
            updateTotalPrice();
        });
    }

    // 감소 버튼 이벤트 리스너
    if (decreaseBtn) {
        decreaseBtn.addEventListener('click', () => {
            if (nights > 1) {
                nights--;
                updateTotalPrice();
            }
        });
    }

    // Reserve 버튼 클릭 이벤트
    const reserveForm = document.getElementById('reserve-form');
    if (reserveForm) {
        reserveForm.addEventListener('submit', (e) => {
            const totalPrice = pricePerNight * nights;
            alert(`총 ${nights}박 예약이 진행됩니다. 총 금액: ₩${totalPrice.toLocaleString()}`);
        });
    }
});
