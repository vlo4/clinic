<?php
include("userNav.php");
include("db.php");
$sql="SELECT * FROM appointments WHERE id_user_app=$idUser AND status_app='0' ORDER BY date_app";


$result=mysqli_query($db,$sql);
echo"<div class='row about' style='margin: 4em 0;padding: 1em;position: relative;'>";
echo "<h4>Ваши записи | <a href='user_app2.php'>Прошлые записи</a></h4>";

echo "<table class='table table-bordered table-sm'>
<tr class='table-primary'><th>Имя доктора</th><th>Услуга</th><th>Цена</th><th>Дата</th>
<th>Время</th><th>Отмена</th>";
while($myrow=mysqli_fetch_array($result))
{
    echo "<tr>";

    $i1=$myrow['id_ds_app'];
    $sql2="SELECT `id_doctor_ds`,`id_service_ds` FROM `ds` WHERE `id_ds`=$i1";
    $result2=mysqli_query($db,$sql2);
    $myrow2=mysqli_fetch_array($result2);

    $i2=$myrow2['id_doctor_ds'];
    $i3=$myrow2['id_service_ds'];

    $sql3="SELECT `FIO_doctor` FROM `doctors` WHERE `id_doctors`=$i2";
    $result3=mysqli_query($db,$sql3);
    $myrow3=mysqli_fetch_array($result3);
    echo "<td>".$myrow3['FIO_doctor']."</td>";

    $sql4="SELECT `name_service`,`price_service` FROM `services` WHERE `id_service`=$i3";
    $result4=mysqli_query($db,$sql4);
    $myrow4=mysqli_fetch_array($result4);
    echo "<td>".$myrow4['name_service']."</td>";
    echo "<td>".$myrow4['price_service']."</td>";

    echo "<td>".$myrow['date_app']."</td>";
    echo "<td>".$myrow['time_app']."</td>";

    echo"<td> <form method='post'>
    <button type='submit' name='submit' style='background-color: #008080; color: #fff;'
    class='btn btn-primary'>Отмена</button></td>";
    echo "<input type='hidden' name='idapp' value='".$myrow['id_app']."'></form>";
    echo "</tr>";
}
echo "</table>";
?>

<?php 
if(ISSET($_POST['submit']))
{
$id_app=$_POST['idapp'];

$sql="DELETE FROM `appointments` WHERE `id_app`='$id_app'";

$result=mysqli_query($db,$sql);
if($result==TRUE)
{
        echo "Данные успешно удалены!";
        echo"<script> document.location.href='user_app.php'</script>";
}
      else{
        echo "Ошибка";
      }
    }
?>
