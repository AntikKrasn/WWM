<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='avtorization.css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@200;300;400;600;700;800;900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Luckiest+Guy">
    <title>WWM | Авторизация</title>
</head>

<body>
    <div class="main">
        <div class="main-header">
        <div class="container">
            <div class="header-line">
                <div class="nav">
                    <div class="nav">
                        <ul class = "menu1">
                            <li><a href="..\">Главная</a>
                            <li><div class="vvm">WWM</div>
                            <li><a href="..\Avtorization\avtorization.php">Личный кабинет</a>
                        </ul>
                 </div>
            </div>
        </div>
        </div>  
    <div class="container2">
        <div class="formaforregistr">
            
            <div class="containerregistr">
                Авторизация
            </div>
            <div class="registrflex">
                <div class="registration">
                    <form action="avtoriz.php" method="post">
                        <div class="formflex">
                            <div class="formglav">
                               
                                <div class="form">
                                    <div class="textform">Логин</div>
                                    <input type="text" id="taskInput" placeholder="Введите логин" name = "login" required>
                                </div>
                                    
                                <div class="form">
                                    <div class="textform">Пароль</div>
                                    <input type="password" placeholder="Введите пароль" name = "pass" required>
                                </div>
                                
                            </div>
                        </div>

                        <button type="submit" class="btn">Войти</button>
                        <div class="account">
                            <div class="textaccount">Хотите организовать свое время лучше</div>
                            <div class="textaccount2"><a href="..\Registration\registr.php">Создайте аккаунт прямо сейчас!</a></div>
                        </div>
                    </form>
                </div> 
                    
                <div class="registr">
                    <img class="img-people" src="img/people.png">
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
                    <ul class = "fotter-menu">
                        <li>Екатеринбург, РГППУ 2024 
                        <li>Сайт разработали Краснопеева Анна, Шишкоедова Екатерина
                    </ul>                          
                </div>
            </div>
        </div>    
    </div>
</div>

</body>

</html>