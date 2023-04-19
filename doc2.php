<?php
include("docNav.php");
include("db.php");
$id_doc=$_SESSION['id_doctors'];
$sql="SELECT CONCAT(pss.LastName_user,' ',pss.FirstName_user) AS FIO, 
psss.name_service, psss.price_service,p.date_app,p.time_app 
FROM appointments p INNER JOIN ds ps ON p.id_ds_app=ps.id_ds 
INNER JOIN user pss ON p.id_user_app=pss.id_user 
INNER JOIN services psss ON ps.id_service_ds=psss.id_service 
INNER JOIN doctors pssss ON ps.id_doctor_ds=pssss.id_doctors 
WHERE ps.id_doctor_ds=$id_doc AND p.status_app='1'
ORDER BY p.date_app;";


$result=mysqli_query($db,$sql);
echo"<div class='row about' style='margin: 4em 0;padding: 1em;position: relative;'>";
echo "<h4><a href='doc.php'>Ваши записи</a> | Прошлые записи</h4>";

echo "<table class='table table-bordered table-sm'>
<tr class='table-primary'><th>Имя клиента</th><th>Услуга</th><th>Цена</th><th>Дата</th>
<th>Время</th>";

while($myrow=mysqli_fetch_array($result))
{
    echo "<tr>";
    echo "<td>".$myrow['FIO']."</td>";
    echo "<td>".$myrow['name_service']."</td>";
    echo "<td>".$myrow['price_service']."</td>";
    echo "<td>".$myrow['date_app']."</td>";
    echo "<td>".$myrow['time_app']."</td>";
    echo "</tr>";
}
echo "</table>";
?>
