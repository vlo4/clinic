<?php
session_start();
include("db.php");
include("userNav.php");
$idds=$_POST['idDS'];

echo" <div class='row about' style='margin: 4em 0;padding: 1em;position: relative;'>
<div class='col-lg-4 col-md-4 col-sm-12'>";
echo"<h4>Выбор даты и времени </h4>";
echo"<br>";
echo"<form method='post'>
<input type='date' name='appDate' class='form-control' required><br>

<select name='appTime' class='form-control'>
<option value='9:30'>9:30</option>
<option value='10:00'>10:00</option>
<option value='10:30'>10:30</option>
<option value='11:00'>11:00</option>
<option value='11:30'>11:30</option>
<option value='12:00'>12:00</option>
<option value='12:30'>12:30</option>
<option value='14:00'>14:00</option>
<option value='14:30'>14:30</option>
<option value='15:00'>15:00</option>
<option value='15:30'>15:30</option>
<option value='16:00'>16:00</option>
<option value='16:30'>16:30</option>
</select>  <br>

<button type='submit' name='submit' style='background-color: #008080; color: #fff;margin-right:10px;' 
class='btn btn-primary;'>Записаться</button>";
echo"<input type='hidden' name='id_ds' value='$idds'></form>";

if(ISSET($_POST['submit'])){
$idUser=$_SESSION['id_user'];
$date=$_POST['appDate'];
$time=$_POST['appTime'];

$id_ds=$_POST['id_ds'];
$sql2="SELECT `id_doctor_ds` FROM `ds` WHERE `id_ds`=$id_ds";
$result2=mysqli_query($db,$sql2);
$myrow2=mysqli_fetch_array($result2);

$id_doctor=$myrow2['id_doctor_ds'];



$query="INSERT INTO `appointments`(`id_user_app`, `id_ds_app`, `date_app`, `time_app`, `status_app`)
 VALUES ('$idUser','$id_ds','$date','$time','0')";

$sql="SELECT p.id_ds_app, p.date_app, p.time_app, ps.id_doctor_ds
FROM `appointments` p
INNER JOIN ds ps ON p.id_ds_app=ps.id_ds
 WHERE ps.id_doctor_ds=$id_doctor
AND p.date_app='$date' AND p.time_app='$time'";

$result3 = mysqli_query($db,$sql);
$num_rows = mysqli_num_rows($result3);

if ($num_rows == 0) {
    $result=mysqli_query($db,$query);
    if($result==TRUE)
    {
        echo "Ваша заявка добавлена";
        echo "<script> document.location.href = 'user_app.php'</script>";
    }
    else{
        echo "Ошибка";
    }}

    else {
        echo "Этот промежуток времени занят";
      }

    }
?>
