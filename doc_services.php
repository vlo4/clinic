<?php
include("docNav.php");
include("db.php");
$id_doc=$_SESSION['id_doctors'];
$sql="SELECT name_service, price_service FROM `ds`p 
INNER JOIN services ps ON p.id_service_ds=ps.id_service WHERE `id_doctor_ds`=$id_doc;";


$result=mysqli_query($db,$sql);
echo"<div class='row about' style='margin: 4em 0;padding: 1em;position: relative;'>";
echo "<h4>Ваши услуги</h4>";

echo "<table class='table table-bordered table-sm'>
<tr class='table-primary'><th>Название услуги</th><th>Цена</th>";

while($myrow=mysqli_fetch_array($result))
{
    echo "<tr>";
    echo "<td>".$myrow['name_service']."</td>";
    echo "<td>".$myrow['price_service']."</td>";
    echo "</tr>";
}
echo "</table>";
?>
