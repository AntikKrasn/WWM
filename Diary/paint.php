<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='paint.css'>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@200;300;400;600;700;800;900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Luckiest+Guy">
    <title>WWM | Личный дневник</title>
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
            Личный дневник
        </div>
        <div class="containerleftheader-title">
            <div class="text1">Мои мысли</div>
            <div class="text2">Здесь ты можешь быть собой)</div>
        </div>
        <div id="containers">
    <!-- Форма для ввода новых записей -->
    <div id="containers">
    <!-- Форма для ввода новых записей -->
    <form action="load_diary.php" method="post">
        <textarea name="note" placeholder="Напиши свои мысли..."></textarea><br>
        <input type="submit" id="saveButton" value="Сохранить">
    </form>
</div>

<?php
error_reporting(0);
session_start();
include_once 'db.php'; 
$login = $_SESSION['login'];

$sql = "SELECT * FROM diary WHERE login = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $login);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $diaryText = htmlspecialchars($row['diary_text']);
        
        $diaryText = str_replace("\n", '\\n', $diaryText);
        $diaryText = str_replace("\r", '\\r', $diaryText);
        
        echo '<script>document.querySelector("textarea[name=\'note\']").value += \'' . $diaryText . '\';</script>';
    }
}
?>
</div>
<script>
window.addEventListener("load", function() {
    var noteTextarea = document.querySelector("textarea[name='note']");
    
    if (noteTextarea.value.trim() === '') {
        noteTextarea.setAttribute('placeholder', 'Напиши свои мысли...');
    }
});

document.querySelector("form").addEventListener("submit", function(event) {
    event.preventDefault(); 
    var note = document.querySelector("textarea[name='note']").value;
    var xhr = new XMLHttpRequest();

    xhr.open("POST", "load_diary.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function() {
        if (xhr.status === 200) {
            if (xhr.responseText === "true") {
                location.reload();
            } else {
                console.error("Произошла ошибка при сохранении данных");
            }
        } else {
            console.error("Произошла ошибка при сохранении данных:", xhr.statusText);
        }
    };

    xhr.send("note=" + encodeURIComponent(note));
});
</script>
                </div>

                <div class="containerright">
                    <div class="main-container">
                        <div class="retangle"><img src="img/Rectangle 4.png" alt=""></div>
                        <div class="retangle-nav">
                            <ul class="retangle-menu">
                                <li><a href="..\Task\ToDoList.php">Управление задачами</a>
                                <li><a href="..\Calendar\calendar.php">Календарь</a>
                                <li><a class="checked" href="..\Diary\paint.php">Личный дневник</a>
                            </ul>
                        </div>
                        <div class="containerleftheader-title">
                            <div class="text1">PaintBoard</div>
                            <div class="text2">Твоя творческая мастерская</div>
                        </div>
                        <div class="containerdraw">
                            <div class="mm">
                                <p>Цвет:
                                <div class="razmer">
                                    <div class="colorrr"><input type="color" id="thecolor" value="#B3ABBD" /></div>
                                </div>
                                <p>Размер кисти:
                                <div class="razmer">
                                    <input type="range" name="ageInputName" id="ageInputId" value="5" min="1" max="10"
                                        oninput="ageOutputId.value = ageInputId.value">
                                    <output id="ageOutputId">5</output>
                                </div>
                                <div class="size">
                                </div>
                                <p>Ластик:</p>
                                <div class="razmer">
                                    <button id="xp"> <img src="img/ink_eraser.png" alt="Иконка" width="24"
                                            height="24"></button>
                                </div>
                            </div>
                            <div style="width: 99.5%; aspect-ratio: 0;"><canvas id="can"></canvas> </div>


                            <script type="text/javascript">
                                var canvas = document.getElementById("can");
                                ctx = canvas.getContext('2d');
                                ctx.lineWidth = 3;

                                function resizeCanvas() {
                                    var parent = canvas.parentElement;
                                    canvas.width = parent.clientWidth;
                                    canvas.height = parent.clientWidth * 0.48;
                                }
                                window.onresize = function () {
                                    resizeCanvas();
                                }

                                function initialize() {
                                    resizeCanvas();
                                    ctx.strokeStyle = "#B3ABBD";
                                }

                                window.onload = initialize;

                                var flag = false;
                                canvas.onmousedown = function (eva) {
                                    var eva = eva || window.event;
                                    ctx.lineCap = "round";
                                    ctx.lineJoin = "round";
                                    var x = eva.offsetX;
                                    var y = eva.offsetY;
                                    ctx.beginPath();
                                    ctx.moveTo(x, y);
                                    flag = true;
                                }

                                canvas.onmousemove = function (eva) {
                                    if (flag) {
                                        var eva = eva || window.event;
                                        var x = eva.offsetX;
                                        var y = eva.offsetY;
                                        ctx.lineTo(x, y);
                                        ctx.stroke();
                                    }
                                }

                                canvas.onmouseup = function () {
                                    flag = false;
                                    ctx.closePath();
                                }

                                canvas.onmouseleave = function () {
                                    flag = false;
                                    ctx.closePath();
                                }

                                var theColor = document.getElementById("thecolor");
                                theColor.onchange = function () {
                                    ctx.strokeStyle = this.value;
                                }


                                /*размер кисточки*/
                                document.getElementById("ageInputId").oninput = function () {
                                    draw = null
                                    lineW = document.getElementById("ageInputId").value;
                                    document.getElementById("ageOutputId").innerHTML = lineW;
                                    ctx.lineWidth = lineW;

                                };

                                /*ластик*/
                                var xp = document.getElementById("xp");
                                xp.onclick = function () {
                                    ctx.strokeStyle = 'white';
                                    ctx.lineWidth = 20;
                                }     
                            </script>
                        </div>
                        <div class="text3">* При обновлении страницы - рисунок стирается</div>  
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
</body>

</html>
