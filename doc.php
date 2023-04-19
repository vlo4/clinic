<?php
include("docNav.php");
include("db.php");
$id_doc=$_SESSION['id_doctors'];
$sql="SELECT CONCAT(pss.LastName_user,' ',pss.FirstName_user) AS FIO, 
psss.name_service, psss.price_service,p.date_app,p.time_app,p.id_app 
FROM appointments p INNER JOIN ds ps ON p.id_ds_app=ps.id_ds 
INNER JOIN user pss ON p.id_user_app=pss.id_user 
INNER JOIN services psss ON ps.id_service_ds=psss.id_service 
INNER JOIN doctors pssss ON ps.id_doctor_ds=pssss.id_doctors 
WHERE ps.id_doctor_ds=$id_doc AND p.status_app='0'
ORDER BY p.date_app;";


$result=mysqli_query($db,$sql);
echo"<div class='row about' style='margin: 4em 0;padding: 1em;position: relative;'>";
echo "<h4>Ваши записи | <a href='doc2.php'>Прошлые записи</a></h4>";

echo "<table class='table table-bordered table-sm'>
<tr class='table-primary'><th>Имя клиента</th><th>Услуга</th><th>Цена</th><th>Дата</th>
<th>Время</th><th>Явка</th><th>Неявка</th>";

while($myrow=mysqli_fetch_array($result))
{
    echo "<tr>";
    echo "<td>".$myrow['FIO']."</td>";
    echo "<td>".$myrow['name_service']."</td>";
    echo "<td>".$myrow['price_service']."</td>";
    echo "<td>".$myrow['date_app']."</td>";
    echo "<td>".$myrow['time_app']."</td>";
    echo"<td> <form method='post'>
    <button type='submit' name='submit' style='background-color: #008080; color: #fff;'
    class='btn btn-primary'>Явка</button></td>";

    echo "<td><button type='submit' name='didnotcome' style='background-color: #008080; color: #fff;'
    class='btn btn-primary'>Неявка</button></td>";

    echo "<input type='hidden' name='idapp' value='".$myrow['id_app']."'></form>";
    echo "</tr>";
}
echo "</table>";
?>

<?php 
if(ISSET($_POST['submit']))
{
$id_app=$_POST['idapp'];

$sql="UPDATE `appointments` SET `status_app`='1' WHERE `id_app`='$id_app'";

$result=mysqli_query($db,$sql);
if($result==TRUE)
{
        echo "Данные успешно сохранены!";
        echo"<script> document.location.href='doc.php'</script>";
}
      else{
        echo "Ошибка";
      }
    }
?>

<?php 
if(ISSET($_POST['didnotcome']))
{
$id_app=$_POST['idapp'];

$sql="UPDATE `appointments` SET `status_app`='2' WHERE `id_app`='$id_app'";

$result=mysqli_query($db,$sql);
if($result==TRUE)
{
        echo "Данные успешно сохранены!";
        echo"<script> document.location.href='doc.php'</script>";
}
      else{
        echo "Ошибка";
      }
    }
?>
