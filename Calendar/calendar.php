<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="google" content="notranslate">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href='calendar.css'>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@200;300;400;600;700;800;900&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Luckiest+Guy">
  <title>WWM | Календарь</title>
</head>

<body>
  <div class="main">
    <div class="main-header">
      <div class="container">
        <div class="header-line">
        <div class="nav">
                 <ul class = "menu1">
                        <li><a href="..\">Главная</a>
                        <li><div class="vvm">WWM</div>
                        <li><a href="..\User\profile.php">Личный кабинет</a>
                </ul>
                 </div>
        </div>
      </div>

      <div class="container2">
        <div class="containerleft">
          <div class="containerleftheader">
            Календарь
          </div>
          <div class="containerleftheader-title"></div>
          <div class="calendar">
            <div class="month">
              <i class="fas fa-angle-left prev"><img src="img/arrow_back_ios.png" alt=""></i>
              <div class="date">Декабрь 2015</div>
              <i class="fas fa-angle-right next"><img src="img/arrow_forward_ios.png" alt=""></i>
            </div>
            <div class="weekdays">
              <div>Пн</div>
              <div>Вт</div>
              <div>Ср</div>
              <div>Чт</div>
              <div>Пт</div>
              <div>Сб</div>
              <div>Вс</div>
            </div>
            <div class="days"></div>
            <div class="goto-today">
              <div class="goto">
                <input type="text" placeholder="мм/гггг" class="date-input" />
                <button class="goto-btn">Найти дату</button>
              </div>
              <button class="today-btn">Сегодня</button>
            </div>
          </div>
        </div>

        <div class="containerright">
          <div class="main-container">
            <div class="retangle"><img src="img/Rectangle 4.png" alt=""></div>
            <div class="retangle-nav">
              <ul class="retangle-menu">
                <li><a href="..\Task\ToDoList.php">Управление задачами</a>
                <li><a class="checked" href="..\Calendar\calendar.php">Календарь</a>
                <li><a href="..\Diary\paint.php">Личный дневник</a>
              </ul>
            </div>
            <div class="containerleftheader-title">
              <div class="text1">События</div>
              <div class="text2">Планируйте встречи, мероприятия</div>
            </div>
            <form id="event-form" action="save_event.php" method="post">
              <div class="row">
                <input type="text" id="input-box" name="event" placeholder="Введите событие">
                <input type="date" id="date-input-box" class="inputdate">
                <button type="button" class="add" onclick="addEvent()"><img src="img/add.png" alt=""></button>
              </div>
            </form>
            <div class="containerleft2"> <?php include 'display_events.php'; ?></div>
            </div>
            </div>
          </div>
        </div>
    <div class="main-fotter">
      <div class="fotter">
        <div class="fotter-container">
          <div class="fotter-line">
            <div class="fotter-nav">
              <ul class="fotter-menu">
                <li>Екатеринбург, РГППУ 2024
                <li>Сайт разработали Краснопеева Анна, Шишкоедова Екатерина
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="calendar.js">function addEvent() {
const listContainer = document.getElementById('listContainer');
var event = document.getElementById("input-box").value;

var date = document.getElementById("date-input-box").value;

if (event === '' || date === '') {
  alert('Вы не ввели текст или дату!');
} else {

  const listItem = document.createElement('li');

  listItem.innerHTML = event + '<br><span class="dates">' + date +'<span class="delete-event"></span>'; 
  listContainer.appendChild(listItem);

  let span = document.createElement("span");
  span.innerText = "";

  listItem.appendChild(span);

  document.getElementById('input-box').value = '';
  document.getElementById('date-input-box').value = ''; 

  var xhr = new XMLHttpRequest();
  var url = 'save_event.php';

  var formData = new FormData();
  formData.append('event', event);
  formData.append('date', date); 

  xhr.open('POST', url, true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  xhr.send(formData);

  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var response = xhr.responseText;
        if (response.trim() === 'true') {
           location.reload();
          } else {
            console.error('Ошибка при добавлении задачи:', xhr.responseText);
          }
        }
      }
    }
  }
}
  </script>
</body>
</html>
