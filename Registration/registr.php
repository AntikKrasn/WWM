<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='registr.css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@200;300;400;600;700;800;900&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Luckiest+Guy">
    <title>WWM | Регистрация</title>
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
                            <li><a href="..\Avtorization\avtorization.php">Личный кабинет</a>
                        </ul>
                 </div>
            </div>
        </div>
        
    <div class="container2">
        <div class="formaforregistr">
            
            <div class="containerregistr">
                Регистрация
            </div>
            <div class="registrflex">
                <div class="registration">
                    <form action="registration.php" method="post">
                        <div class="formflex">
                            <div class="formglav">
                                <div class="form">
                                    <div class="textform">Фамилия</div>
                                    <input type="text" id="fam" placeholder="Введите фамилию" name = "familia" required>
                                </div>
                                    
                                <div class="form">
                                    <div class="textform">Имя</div>
                                    <input type="text" id="name" placeholder="Введите имя" name = "name" required>
                                </div>
                                
                                <div class="form">
                                    <div class="textform">Телефон</div>
                                    <input type="text" id="phone" placeholder="Введите номер телефона" name = "number" maxlength="11" required>
                                </div>
                            </div>

                            <div class="formglav">
                                <div class="form">
                                    <div class="textform">Логин</div>
                                    <input type="text" id="taskInput" placeholder="Введите логин"  name = "login" required>
                                </div>
                                    
                                <div class="form">
                                    <div class="textform">Пароль</div>
                                    <input type="password" placeholder="Введите пароль"  name = "pass" required>
                                </div>
                                
                                <div class="form">
                                    <div class="textform">Электронная почта</div>
                                    <input type="email" placeholder="Введите адрес эл. почты" name = "email" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn">Зарегистрироваться</button>
                        <div class="account">
                            <div class="textaccount">Уже есть аккаунт?</div>
                            <div class="textaccount2"><a href="..\Avtorization\avtorization.php">Войдите прямо сейчас</a></div>
                        </div>
                    </form>
                </div> 
                    
                <div class="registr">
                    <img class="img-regist" src="img/registr.png">
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