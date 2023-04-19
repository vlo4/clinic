<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <title>Стоматология "Искра"</title>
</head>
<body>
    <?php
    include("db.php");
    ?>
    <nav class="navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="index.php"><img src="img/clinic_logo.jpg" width="50" style="padding-right:10px"/>Стоматология "Искра"</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
       data-target="#navbarSupportedContent"
       aria-controls="navbarSupportedContent" aria-expanded="false"
       aria-label="Toggle Navigation">
       <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-4">
            <li class="nav-item">
                <a class="nav-link" href="#about">О нас</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#services">Наши услуги</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user_login.html">Вход как пользователь</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="doc_login.html">Вход как доктор</a>
            </li>
        </ul>
       </div>
       </nav>

      <header class="header" id="about">
        <div class="overlay"></div>
        <div class="container"></div>
        <div class="description">
        <h4>Наша миссия</h4>
        <p>
            Мы несем в мир здоровье и красоту улыбок через оказание качественных
             и доступных стоматологических услуг по профилактике и лечению зубов в нашем городе.
        </p>
        <h4>Наши цели</h4>
        <p>
            Помогать людям, которые обратились к нам за помощью, самым лучшим для них способом.
        </p>
        <p>
            Помочь Вам сделать свой образ жизни здоровым, потому что здоровье начинается с полости рта. 
            Донести до наших сограждан принцип: «профилактика лучше и дешевле чем лечение».
        </p>
    </div>
    </header>
    
    <div class="container" id="services">
    <h4 class="text-center">Наши услуги</h4>
    <div class="row">

    <?php
    $sql="SELECT * FROM `services`";
    $result=mysqli_query($db,$sql);

    while($myrow=mysqli_fetch_array($result)){
        ?>
    <div class="col-lg-3 col-md-4 col-sm-12">
    <div class="card" style="height: 130px; margin-bottom: 10px;">
    <div class='card-body' style="padding:1em">
    <h4 class='card-title'><?php echo $myrow['name_service']; ?></h4>
    <p class="card-text">
    <?php echo $myrow['price_service']; ?> рублей</p>
    </div>
    </div>
    </div>
    <?php } ?>
    
    </div>
    </div>

    <hr />
    <footer style="padding-left:10px">
    <p>Адрес стоматологии "Искра": XXXX - Телефон: XXXX</p>
    </footer>   
</body>
</html>
