const calendar = document.querySelector(".calendar"),
  date = document.querySelector(".date"),
  daysContainer = document.querySelector(".days"),
  prev = document.querySelector(".prev"),
  next = document.querySelector(".next"),
  todayBtn = document.querySelector(".today-btn"),
  gotoBtn = document.querySelector(".goto-btn"),
  dateInput = document.querySelector(".date-input");

let today = new Date();
let month = today.getMonth();
let year = today.getFullYear();

const months = [
  "Январь",
  "Февраль",
  "Март",
  "Апрель",
  "Май",
  "Июнь",
  "Июль",
  "Август",
  "Сентябрь",
  "Октябрь",
  "Ноябрь",
  "Декабрь",
];

// Функция для инициализации календаря
function initCalendar() {
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const prevLastDay = new Date(year, month, 0);
  const prevDays = prevLastDay.getDate();
  const lastDate = lastDay.getDate();
  const day = firstDay.getDay() === 0 ? 6 : firstDay.getDay() - 1;
  const nextDays = 7 - lastDay.getDay();

  date.innerHTML = months[month] + " " + year;

  let days = "";

  for (let x = day; x > 0; x--) {
    days += `<div class="day prev-date">${prevDays - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDate; i++) {
    if (
      i === new Date().getDate() &&
      year === new Date().getFullYear() &&
      month === new Date().getMonth()
    ) {
      days += `<div class="day today active">${i}</div>`;
    } else {
      days += `<div class="day">${i}</div>`;
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="day next-date">${j}</div>`;
  }
  daysContainer.innerHTML = days;
  addListner();
}

// Функция для перехода на предыдущий месяц
function prevMonth() {
  month--;
  if (month < 0) {
    month = 11;
    year--;
  }
  initCalendar();
}

// Функция для перехода на следующий месяц
function nextMonth() {
  month++;
  if (month > 11) {
    month = 0;
    year++;
  }
  initCalendar();
}

// Добавляем обработчики событий на кнопки перехода по месяцам
prev.addEventListener("click", prevMonth);
next.addEventListener("click", nextMonth);

// Инициализируем календарь
initCalendar();

// Функция для добавления обработчиков событий на дни календаря
function addListner() {
  const days = document.querySelectorAll(".day");
  days.forEach((day) => {
    day.addEventListener("click", (e) => {
      // Обработчик события выбора дня календаря
    });
  });
}

todayBtn.addEventListener("click", () => {
  today = new Date();
  month = today.getMonth();
  year = today.getFullYear();
  initCalendar();
});

dateInput.addEventListener("input", (e) => {
  dateInput.value = dateInput.value.replace(/[^0-9/]/g, "");
  if (dateInput.value.length === 2) {
    dateInput.value += "/";
  }
  if (dateInput.value.length > 7) {
    dateInput.value = dateInput.value.slice(0, 7);
  }
  if (e.inputType === "deleteContentBackward") {
    if (dateInput.value.length === 3) {
      dateInput.value = dateInput.value.slice(0, 2);
    }
  }
});

// Обработчик события кнопки "перейти"
gotoBtn.addEventListener("click", gotoDate);

// Функция для перехода к заданной дате
function gotoDate() {
  const dateArr = dateInput.value.split("/");
  if (dateArr.length === 2) {
    if (dateArr[0] > 0 && dateArr[0] < 13 && dateArr[1].length === 4) {
      month = dateArr[0] - 1;
      year = dateArr[1];
      initCalendar();
      return;
    }
  }
  alert("Неверная дата");
}

// Функция для обновления активного дня календаря
function getActiveDay(date) {
  const day = new Date(year, month, date);
}

// Функция для обновления событий на активном дне календаря
function updateEvents(date) {}


function addEvent() {
  const listContainer = document.getElementById('listContainer');
  // Получаем значение поля задачи
  var event = document.getElementById("input-box").value;
  // Получаем значение поля даты
  var date = document.getElementById("date-input-box").value;
  
  if (event === '' || date === '') {
      alert('Вы не ввели текст или дату!');
  } else {
      const listItem = document.createElement('li');
      listItem.innerHTML = event + '<br><span class="dates">' + date + '</span>' + '<span class="delete-event"></span>';
      listContainer.appendChild(listItem);

      let span = document.createElement("span");
      span.innerText = "";

      listItem.appendChild(span);
      document.getElementById('input-box').value = '';
      document.getElementById('date-input-box').value = ''; // Очищаем значение поля ввода даты

      // Отправляем данные на серверный скрипт add_event.php
      var xhr = new XMLHttpRequest();
      var params = 'event=' + encodeURIComponent(event) + '&date=' + encodeURIComponent(date);
      
      xhr.open('POST', 'save_event.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      
      xhr.onload = function() {
          if (xhr.status >= 200 && xhr.status < 300) {
              location.reload(); // Перезагружаем страницу после успешной отправки данных
          } else {
              alert('Ошибка при отправке данных на сервер');
          }
      };
      
      xhr.send(params);
  }
}