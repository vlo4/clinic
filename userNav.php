<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <title>Личный кабинет пользователя</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="user_prof.php"><img src="img/clinic_logo.jpg" width="50" style="padding-right:10px"/>Личный кабинет пользователя</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
       data-target="#navbarSupportedContent"
       aria-controls="navbarSupportedContent" aria-expanded="false"
       aria-label="Toggle Navigation">
       <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-4">
            <li class="nav-item">
                <a class="nav-link" href="user_prof.php">Профиль</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user_choose.php">Запись на прием</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user_app.php">Ваши записи</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Выход</a>
            </li>
        </ul>
       </div>
       </nav>

       <?php $idUser=$_SESSION['id_user']; ?>
       </body>
</html>
