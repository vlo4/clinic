<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <title>Личный кабинет менеджера</title>
</head>
<body>
<?php
    include("manNav.php");
    include("db.php");
    ?>

<?php
$id_service=$_POST['idService'];
$sql="SELECT * FROM services WHERE id_service='$id_service'";
$result=mysqli_query($db,$sql);
    $myrow=mysqli_fetch_array($result);

    $name_service=$myrow['name_service'];
    $price=$myrow['price_service'];



echo"<div class='row about' style='margin: 4em 0;padding: 1em;position: relative;'>
    <div class='col-lg-4 col-md-4 col-sm-12'>
        <form action='' method='POST' id='#form' style='left:5%;top:0%;width:1wh;'>
        <h4>Изменение услуги</h4>
        <br>
        <input type='text' name='service' placeholder='Название услуги' value='$name_service' class='form-control'> 
        <br>
        <input type='number' name='price' placeholder='Цена услуги' value='$price' class='form-control'> 
        <br>
        <button type='submit' name='submit' style='background-color: #008080; color: #fff;' 
        class='btn btn-primary'>Изменить</button>
        <button type='submit' formaction='manager_services.php' style='background-color: #008080; color: #fff;' 
        class='btn btn-primary'>Вернуться</button>
        <input type='hidden' name='idserv' value='$id_service'>
    </form>
    </div>
    <div class='col-lg-8 col-md-8 col-sm-12 desc'>";

    ?>

<?php
if(ISSET($_POST['submit'])){

    $id=$_POST['idserv'];
    $nameService=$_POST['service'];
    $Price=$_POST['price'];

    $sql="UPDATE `services` SET `name_service`='$nameService',
    `price_service`='$Price' WHERE `id_service`='$id'";
     
    $result=mysqli_query($db,$sql);
    if($result==TRUE)
    {
        echo "Данные успешно сохранены!";
        echo "<script> document.location.href = 'manager_services.php'</script>";
    }
    else{
        echo"Ошибка.";
    }
}
?>

</body>
</html>
