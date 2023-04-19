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

<div class="row about" style="margin: 4em 0;padding: 1em;position: relative;">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <form action="" method="POST" id="#form" style="left:5%;top:0%;width:1wh;">
        <h4>Добавление услуги</h4>
        <br>
        <input type="text" name="service" placeholder="Название услуги" class="form-control"> 
        <br>
        <input type="number" name="price" placeholder="Цена услуги" class="form-control"> 
        <br>
        <button type="submit" name="submit" style="background-color: #008080; color: #fff;" class="btn btn-primary">Добавить</button>
    </form>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 desc">

    <?php
    $page=1;
    $kol=5;
    $first=0;
    if(isset($_GET['page']))
    {
        $page=$_GET['page'];
    } else {$page=1;}
    $first=($page*$kol)-$kol;
    $sql="SELECT COUNT(*) FROM services";
    $result=mysqli_query($db,$sql);
    $row=mysqli_fetch_row($result);
    $total=$row[0];
    $str_page=ceil($total/$kol);

$sql="SELECT name_service, price_service, id_service FROM services LIMIT $first, $kol;";
$result=mysqli_query($db,$sql);
echo "<h4>Услуги</h4>";
echo "<table class='table table-bordered table-sm'>
<tr class='table-primary'><th>Название услуги</th><th>Цена</th><th>Изменить</th>";

for($i=1; $i<=$str_page;$i++)
echo "<a href=manager_services.php?page=".$i.">Страница ".$i."</a>"."|";

while($myrow=mysqli_fetch_array($result))
{
    echo "<tr>";
        echo "<td>".$myrow['name_service']."</td>";
        echo "<td>".$myrow['price_service']."</td>";
        echo"<td> <form method='post'>
    <button type='submit' style='background-color: #008080; color: #fff;' class='btn btn-primary'
     formaction='submitUpd_services.php'>Изменить</button>
    </td>";
    echo "<input type='hidden' name='idService' value='".$myrow['id_service']."'></form>";
    echo "</tr>";
}
echo "</table>";
?>

<?php
        if(ISSET($_POST['submit']))
        {
            $service=$_POST['service'];
            $price=$_POST['price'];

            $sql2="INSERT INTO `services`(`name_service`, `price_service`) VALUES ('$service','$price')";

              $result=mysqli_query($db,$sql2);
              if($result==TRUE)
              {
                echo "Данные успешно сохранены!";
                echo "<script> document.location.href='manager_services.php'</script>";
              }
              else{
                echo "Ошибка";
              }
        }
        ?>

</body>
</html>
