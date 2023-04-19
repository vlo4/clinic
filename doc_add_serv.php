<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <title>Личный кабинет доктора</title>
</head>
<body>
    <?php
    include("docNav.php");
    include("db.php");
    ?>
    
    <div class="row about" style="margin: 4em 0;padding: 1em;position: relative;">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <form action="" method="POST" id="#form" style="left:5%;top:0%;width:1wh;">
        <h4>Фильтрация данных</h4>
        <input type="checkbox" name="chb1" value="1">По названию услуги
        <input type="text" name="searchName" placeholder="Название услуги" class="form-control"> 
        
        <input type="checkbox" name="chb3" value="3">По максимальной цене
        <input type="number" name="searchPrice" placeholder="Цена" class="form-control"> 
        <br>
        <button type="submit" style="background-color: #008080; color: #fff;" class="btn btn-primary">Искать</button>
        <button type="submit" style="background-color: #008080; color: #fff;" class="btn btn-primary">Полный список</button>
    </form>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 desc">

    <?php

$sql="SELECT `id_service`,`name_service`,`price_service` FROM `services`;";
$result=mysqli_query($db,$sql);
echo "<h4>Выбор услуги</h4>";
echo "<table class='table table-bordered table-sm'>
<tr class='table-primary'><th>Название услуги</th><th>Цена</th><th>Добавить</th>";

function show($row) {
echo "<tr>";
        echo "<td>".$row['name_service']."</td>";
        echo "<td>".$row['price_service']."</td>";
        echo"<td> <form method='post'>
    <button type='submit' style='background-color: #008080; color: #fff;' class='btn btn-primary'
     formaction='submit_doc_serv.php'>Добавить</button>
    </td>";
    echo "<input type='hidden' name='idserv' value='".$row['id_service']."'>";
    echo "<input type='hidden' name='nameserv' value='".$row['name_service']."'></form>";
    echo "</tr>";}

    while($myrow=mysqli_fetch_array($result))
{
    
    if(ISSET($_POST['chb1'])|| ISSET($_POST['chb3']))
    {
        $service=$_POST['searchName'];
        $price=$_POST['searchPrice'];

     if(ISSET($_POST['chb1'])&& IS_NULL($_POST['chb3']))
    {
    
        if($myrow['name_service']==$service){
            show($myrow);
        }
    }

     if(ISSET($_POST['chb3'])&& IS_NULL($_POST['chb1'])){
        
            if($myrow['price_service']<$price){
                show($myrow);
            }
        
        }

        if(ISSET($_POST['chb1'])&& ISSET($_POST['chb3'])){
    
            if($myrow['name_service']==$service){
                if($myrow['price_service']<$price){
                
                    show($myrow);
            
        }
        }
        }

    }
    else{
        echo "<tr>";
        echo "<td >".$myrow['name_service']."</td>";
        echo "<td>".$myrow['price_service']."</td>";
        echo"<td> <form method='post'>
    <button type='submit' style='background-color: #008080; color: #fff;' class='btn btn-primary'
     formaction='submit_doc_serv.php'>Добавить</button>
    </td>";
    echo "<input type='hidden' name='idserv' value='".$myrow['id_service']."'>";
    echo "<input type='hidden' name='nameserv' value='".$myrow['name_service']."'></form>";
    echo "</tr>";
    }
}
echo "</table>";

?>

</body>
</html>
