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
    session_start();
    include("db.php");
    

    echo "<div class='row about' style='margin: 4em 0;padding: 1em;position: relative;'>
    <div class='col-lg-4 col-md-4 col-sm-12 desc'>
        <form method='post' action=''>
            <h4>Выбор отчета:</h4>
            <br>
            <div class='form-check'>
                <input class='form-check-input' type='radio' name='rb1' value='1' id='rb1'>
                <label class='form-check-label' for='rb1'>
                    Рейтинг услуг</label>
            </div>
            <br>
            <div class='form-check'>
                <input class='form-check-input' type='radio' name='rb1' value='2' id='rb1'>
                <label class='form-check-label' for='rb1'>
                    Рейтинг докторов</label>
            </div><br>Начало периода
            <input type='date' name='startDate' class='form-control'><br>Конец периода
            <input type='date' name='endDate' class='form-control' required><br>

            <button type='submit' name='submit' class='btn btn-primary'
            style='background-color: #008080; color: #fff;'>Просмотр</button>
        </form>
    </div>
    <div class='col-lg-8 col-md-8 col-sm-12 desc'>";
    ?>

<?php 
if(ISSET($_POST['submit']))
{
    $n=$_POST['rb1'];
    $start=$_POST['startDate'];
    $end=$_POST['endDate'];

    if($start==0){
        $start="%_%";
    }

    if($n==1)
    {
        $sql="SELECT pss.name_service,pss.price_service,COUNT(ps.id_service_ds) AS kol,
         SUM(pss.price_service) AS summ FROM `appointments`p 
         INNER JOIN ds ps ON p.id_ds_app=ps.id_ds 
         INNER JOIN services pss ON ps.id_service_ds=pss.id_service 
         WHERE `status_app`=1 AND p.date_app BETWEEN '$start' AND '$end' 
         GROUP BY pss.name_service,pss.price_service 
         ORDER BY COUNT(ps.id_service_ds) DESC;";

        $result=mysqli_query($db,$sql);
        echo "<h4>Рейтинг услуг</h4>";

        echo "<table class='table table-bordered table-sm'>
        <tr class='table-primary'><th>Услуга</th><th>Стоимость услуги</th>
        <th>Кол-во клиентов</th><th>На сумму</th>";
        $sum=0;
        $count=0;
        while($myrow=mysqli_fetch_array($result))
        {
            $sum+=$myrow['summ'];
            $count+=$myrow['kol'];

            echo "<tr>";
            echo "<td>".$myrow['name_service']."</td>";
            echo "<td>".$myrow['price_service']."</td>";
            echo "<td>".$myrow['kol']."</td>";
            echo "<td>".$myrow['summ']."</td>";
            echo "<tr>";
        }

        echo "<tr>";
        echo "<td></td><td><b>Итого:</b></td>
        <td><b>$count</b></td><td><b>$sum</b></td>";
        echo "</tr>";
        echo "</table>";
    }

    if($n==2)
    {
        $sql="SELECT psss.FIO_doctor,COUNT(ps.id_service_ds) AS kol, 
        SUM(pss.price_service) AS summ FROM `appointments`p 
        INNER JOIN ds ps ON p.id_ds_app=ps.id_ds 
        INNER JOIN services pss ON ps.id_service_ds=pss.id_service 
        INNER JOIN doctors psss ON ps.id_doctor_ds=psss.id_doctors 
        WHERE `status_app`=1 AND p.date_app BETWEEN '$start' AND '$end'
        GROUP BY psss.FIO_doctor 
        ORDER BY COUNT(ps.id_service_ds) DESC;";

        $result=mysqli_query($db,$sql);
        echo "<h4>Рейтинг докторов</h4>";

        echo "<table class='table table-bordered table-sm'>
        <tr class='table-primary'><th>ФИО доктора</th>
        <th>Кол-во услуг</th><th>На сумму</th>";
        $sum=0;
        $count=0;
        while($myrow=mysqli_fetch_array($result))
        {
            $sum+=$myrow['summ'];
            $count+=$myrow['kol'];

            echo "<tr>";
            echo "<td>".$myrow['FIO_doctor']."</td>";
            echo "<td>".$myrow['kol']."</td>";
            echo "<td>".$myrow['summ']."</td>";
            echo "<tr>";
        }

        echo "<tr>";
        echo "<td><b>Итого:</b></td>
        <td><b>$count</b></td><td><b>$sum</b></td>";
        echo "</tr>";
        echo "</table>";
    }
}



?>

</body>
</html>
