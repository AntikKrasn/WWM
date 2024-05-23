<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='todolist.css'>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@200;300;400;600;700;800;900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Luckiest+Guy">
    <title>WWM | Управление задачами</title>
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
                        Управление задачами
                    </div>
                    <div class="todoapp">
                        <div class="containerleftheader-title">
                            <div class="text1">ToDoList</div>
                            <div class="text2">Запиши в него все свои важные дела, чтобы не забыть</div>
                        </div>
                        <form id="task-form" action="save_task.php" method="post">
                            <div class="row">
                                <input type="text" id="input-box" name="task" placeholder="Введите задачу">
                                <button type="button" class="add" onclick="addTask()"><img src="img/add.png" alt=""></button>
                            </div>
                        </form>
                        <script>
    function addTask() {
        const listContainer = document.getElementById('listContainer');

        // Получаем значение поля задачи
        var task = document.getElementById("input-box").value;

        if (task === '') {
            alert('Вы не ввели текст!');
        } else {
            const listItem = document.createElement('li');
            listItem.innerText = task;
            listContainer.appendChild(listItem);

            let span = document.createElement("span");
            span.innerText = "";

            listItem.appendChild(span);

            document.getElementById('input-box').value = '';

           // Отправляем данные на серверный скрипт add_event.php
           var xhr = new XMLHttpRequest();
           var params = 'task=' + encodeURIComponent(task);

            // Формируем URL для отправки запроса на добавление задачи
            xhr.open('POST', 'save_task.php', true);
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
</script>
            <?php include 'display_tasks.php'; ?>
            </div>
                </div>

                <div class="containerright">
                    <div class="main-container">
                        <div class="retangle"><img src="img/Rectangle 4.png" alt=""></div>
                        <div class="retangle-nav">
                            <ul class="retangle-menu">
                                <li><a class="checked" href="..\Task\ToDoList.php">Управление задачами</a>
                                <li><a href="..\Calendar\calendar.php">Календарь</a>
                                <li><a href="..\Diary\paint.php">Личный дневник</a>
                            </ul>
                        </div>
                        <div class="containerleftheader-title">
                            <div class="text1">Заметки</div>
                            <div class="text2">Запишите на ходу ценную мысль</div>
                        </div>
                        <div id="containers">
                            <div id="list-header">
                                <div id="addNoteDiv" onclick="popup()">
                                    <i class="fa-solid fa-plus"><img src="img/add2.png" alt=""></i>
                                </div>
                            </div>
                        </div>
                        <div id="list-container">
                        <?php include 'display_note.php'; ?>
                        </div>
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
</div>
    <script src="script.js"></script>
</body>

</html>