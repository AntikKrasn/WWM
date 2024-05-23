<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='profile.css'>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@200;300;400;600;700;800;900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Luckiest+Guy">
    <title>WWM | Личный кабинет</title>
</head>

<body>

<?php
error_reporting(0);
session_start(); 
ob_start(); 

if(isset($_SESSION['login'], $_SESSION['name'], $_SESSION['number'], $_SESSION['email'])) {
    $login = $_SESSION['login'];
    $name = $_SESSION['name'];
    $number = $_SESSION['number'];
    $email = $_SESSION['email'];
} else {
 
}
?>
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
        Привет, <?php echo $name; ?>!
    </div>
    <div class="registration">
        <form action="update_profile.php" method="POST">
            <div class="formflex">
                <div class="formglav">
                    <div class="form">
                        <div class="textform">Логин</div>
                        <input type="text" name="login" value="<?php echo $login; ?>" readonly>
                    </div>
                    <div class="form">
                        <div class="textform">Номер телефона</div>
                        <input type="text" name="number" value="<?php echo $number; ?>" maxlength="11">
                    </div>
                    <div class="form">
                        <div class="textform">Электронная почта</div>
                        <input type="text" name="email" value="<?php echo $email; ?>">
                    </div>
                </div>
            </div>
            <div class="buttons">
                <button type="submit" class="btn">Сохранить изменения</button>
                <button type="button" id="logout"><img src="img/logout.png" alt="Выход"></button>
                <script>
                document.getElementById('logout').onclick = function() {
                    // Перенаправляем пользователя на страницу авторизации
                    window.location.href = 'logout.php';
                };
                </script>
            </div>
        </form>
    </div> 
</div>
            <div class="containerright">
                <div class="main-container">
                    <div class="retangle"><img src="img/Rectangle 4.png" alt=""></div>
                    <div class="retangle-nav">
                        <ul class="retangle-menu">
                            <li><a href="..\Task\ToDoList.php">Управление задачами</a>
                            <li><a href="..\Calendar\calendar.php">Календарь</a>
                            <li><a href="..\Diary\paint.php">Личный дневник</a>
                        </ul>
                    </div>
                    <div class="imageglav">
                        <div class="image">
                            <img class="img-people" src="img/Group 10.png">
                            
                        </div>
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
</body>

</html>
