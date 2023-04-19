<?php
session_start();
include("db.php");
include("docNav.php");
$idService=$_POST['idserv'];

echo" <div class='row about' style='margin: 4em 0;padding: 1em;position: relative;'>
<div class='col-lg-4 col-md-4 col-sm-12'>";
echo"<h4>Вы уверены что хотите добавить услугу '".$_POST['nameserv']."'?</h4>";
echo"<br>";
echo"<form method='post'>
<button type='submit' name='submit' style='background-color: #008080; color: #fff;margin-right:10px;' 
class='btn btn-primary;'>
Да</button>";
echo"<button type='submit' style='background-color: #008080; color: #fff;' class='btn btn-primary'
formaction='doc_add_serv.php'>Нет</button>";
echo"<input type='hidden' name='idserv' value='$idService'>";
echo"<input type='hidden' name='nameserv' value='".$_POST['nameserv']."'></form>";

if(ISSET($_POST['submit'])){
$idDoc=$_SESSION['id_doctors'];
$idService=$_POST['idserv'];
$NameService=$_POST['nameserv'];

$query="INSERT INTO ds(id_doctor_ds,id_service_ds)
VALUES ($idDoc,$idService)";

$sql="SELECT `id_ds`,`id_doctor_ds`,`id_service_ds` 
FROM ds WHERE id_doctor_ds='$idDoc' AND id_service_ds='$idService'";
$result2 = mysqli_query($db,$sql);
$num_rows = mysqli_num_rows($result2);

if ($num_rows == 0) {
    $result=mysqli_query($db,$query);
    if($result==TRUE)
    {
        echo "Ваша заявка добавлена";
        echo "<script> document.location.href = 'doc_services.php'</script>";
    }
    else{
        echo "Ошибка";
    }}

    else {
        echo "Вы уже добавляли эту услугу";
      }

    }
?>
