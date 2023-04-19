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
        <h4>Добавление доктора</h4>
        <br>
        <input type="text" name="nameDoc" placeholder="Имя доктора" class="form-control"> 
        <br>
        <input type="text" name="login" placeholder="Логин" class="form-control"> 
        <br>
        <input type="text" name="password" placeholder="Пароль" class="form-control"> 
        <br>
        <button type="submit" name="submit" style="background-color: #008080; color: #fff;"
         class="btn btn-primary">Добавить</button>
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
    $sql="SELECT COUNT(*) FROM doctors";
    $result=mysqli_query($db,$sql);
    $row=mysqli_fetch_row($result);
    $total=$row[0];
    $str_page=ceil($total/$kol);

$sql="SELECT * FROM doctors LIMIT $first, $kol;";
$result=mysqli_query($db,$sql);
echo "<h4>Доктора</h4>";
echo "<table class='table table-bordered table-sm'>
<tr class='table-primary'><th>Имя доктора</th><th>Логин</th><th>Пароль</th><th>Изменить</th>";

for($i=1; $i<=$str_page;$i++)
echo "<a href=manager_doctors.php?page=".$i.">Страница ".$i."</a>"."|";

while($myrow=mysqli_fetch_array($result))
{
    echo "<tr>";
        echo "<td>".$myrow['FIO_doctor']."</td>";
        echo "<td>".$myrow['username_doctors']."</td>";
        echo "<td>".$myrow['passw_doctors']."</td>";
        echo"<td> <form method='post'>
    <button type='submit' style='background-color: #008080; color: #fff;' class='btn btn-primary'
     formaction='submitUpd_doctors.php'>Изменить</button>
    </td>";
    echo "<input type='hidden' name='idDoctor' value='".$myrow['id_doctors']."'></form>";
    echo "</tr>";
}
echo "</table>";
?>

<?php
        if(ISSET($_POST['submit']))
        {
            $namedoc=$_POST['nameDoc'];
            $username_doc=$_POST['login'];
            $passw_doc=$_POST['password'];


            $sql2="INSERT INTO `doctors`(`username_doctors`, `passw_doctors`, `FIO_doctor`) 
            VALUES ('$username_doc','$passw_doc','$namedoc')";

              $result=mysqli_query($db,$sql2);
              if($result==TRUE)
              {
                echo "Данные успешно сохранены!";
                echo "<script> document.location.href='manager_doctors.php'</script>";
              }
              else{
                echo "Ошибка";
              }
        }
        ?>


</body>
</html>
