document.addEventListener("DOMContentLoaded", () => {
    const dateInput = document.getElementById("date-input");
    const calendar = document.getElementById("calendar");
    const currentMonth = document.getElementById("current-month");
    const prevMonthBtn = document.getElementById("prev-month");
    const nextMonthBtn = document.getElementById("next-month");
    const calendarGrid = document.getElementById("calendar-grid");

    let selectedDates = [];
    let today = new Date();
    let currentYear = today.getFullYear();
    let currentMonthIndex = today.getMonth();

    const monthNames = [
        "1월", "2월", "3월", "4월", "5월", "6월",
        "7월", "8월", "9월", "10월", "11월", "12월"
    ];

    // 달력 열기/닫기
    dateInput.addEventListener("click", (event) => {
        event.stopPropagation();
        calendar.classList.toggle("hidden");
        renderCalendar();
    });

    document.addEventListener("click", (event) => {
        if (!calendar.contains(event.target) && event.target !== dateInput) {
            calendar.classList.add("hidden");
        }
    });

    // 이전/다음 달 이동
    prevMonthBtn.addEventListener("click", (event) => {
        event.preventDefault();
        currentMonthIndex--;
        if (currentMonthIndex < 0) {
            currentMonthIndex = 11;
            currentYear--;
        }
        renderCalendar();
    });

    nextMonthBtn.addEventListener("click", (event) => {
        event.preventDefault();
        currentMonthIndex++;
        if (currentMonthIndex > 11) {
            currentMonthIndex = 0;
            currentYear++;
        }
        renderCalendar();
    });

    // 달력 렌더링
    function renderCalendar() {
        currentMonth.textContent = `${monthNames[currentMonthIndex]} ${currentYear}`;
        calendarGrid.innerHTML = "";

        const firstDay = new Date(currentYear, currentMonthIndex, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonthIndex + 1, 0).getDate();

        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement("div");
            calendarGrid.appendChild(emptyCell);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const date = new Date(currentYear, currentMonthIndex, day);
            const dayButton = document.createElement("button");
            dayButton.textContent = day;

            // 날짜가 선택된 상태인지 확인
            if (selectedDates.some((selectedDate) => isSameDate(selectedDate, date))) {
                dayButton.classList.add("selected");
            }

            // 범위 강조 표시
            if (isInRange(date)) {
                dayButton.classList.add("in-range");
            }

            // 일요일 강조
            if (date.getDay() === 0) {
                dayButton.classList.add("sunday");
            }

            // 날짜 클릭 이벤트
            dayButton.addEventListener("click", (event) => {
                event.preventDefault();
                handleDateSelect(date, dayButton);
            });

            calendarGrid.appendChild(dayButton);
        }
    }

    function handleDateSelect(date, button) {
        if (selectedDates.length === 2) {
            selectedDates = [];
            Array.from(calendarGrid.children).forEach((child) =>
                child.classList.remove("selected", "in-range")
            );
        }

        selectedDates.push(date);
        button.classList.add("selected");

        if (selectedDates.length === 2) {
            highlightRange();
            dateInput.value = `${formatDate(selectedDates[0])} ~ ${formatDate(selectedDates[1])}`;
            calendar.classList.add("hidden");
        }
    }

    function highlightRange() {
        if (selectedDates.length < 2) return;

        const [start, end] = selectedDates.sort((a, b) => a - b);
        Array.from(calendarGrid.children).forEach((child) => {
            const day = parseInt(child.textContent, 10);
            if (!isNaN(day)) {
                const currentDate = new Date(currentYear, currentMonthIndex, day);
                if (currentDate > start && currentDate < end) {
                    child.classList.add("in-range");
                }
            }
        });
    }

    function isInRange(date) {
        if (selectedDates.length < 2) return false;
        const [start, end] = selectedDates.sort((a, b) => a - b);
        return date > start && date < end;
    }

    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, "0");
        const day = String(date.getDate()).padStart(2, "0");
        return `${year}-${month}-${day}`;
    }

    function isSameDate(date1, date2) {
        return (
            date1.getFullYear() === date2.getFullYear() &&
            date1.getMonth() === date2.getMonth() &&
            date1.getDate() === date2.getDate()
        );
    }

    renderCalendar();
});
