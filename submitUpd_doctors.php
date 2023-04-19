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

<?php
$id_doc=$_POST['idDoctor'];
$sql="SELECT * FROM doctors WHERE id_doctors='$id_doc'";
$result=mysqli_query($db,$sql);
$myrow=mysqli_fetch_array($result);

    $namedoc=$myrow['FIO_doctor'];
    $username_doc=$myrow['username_doctors'];
    $passw_doc=$myrow['passw_doctors'];



echo"<div class='row about' style='margin: 4em 0;padding: 1em;position: relative;'>
    <div class='col-lg-4 col-md-4 col-sm-12'>
        <form action='' method='POST' id='#form' style='left:5%;top:0%;width:1wh;'>
        <h4>Изменение доктора</h4>
        <br>
        <input type='text' name='namedoctor' placeholder='Имя доктора' value='$namedoc' class='form-control'> 
        <br>
        <input type='text' name='usernamedoc' placeholder='Логин' value='$username_doc' class='form-control'> 
        <br>
        <input type='text' name='passwdoc' placeholder='Пароль' value='$passw_doc' class='form-control'> 
        <br>
        <button type='submit' name='submit' style='background-color: #008080; color: #fff;' 
        class='btn btn-primary'>Изменить</button>
        <button type='submit' formaction='manager_doctors.php' style='background-color: #008080; color: #fff;' 
        class='btn btn-primary'>Вернуться</button>
        <input type='hidden' name='iddoc' value='$id_doc'>
    </form>
    </div>
    <div class='col-lg-8 col-md-8 col-sm-12 desc'>";

    ?>

<?php
if(ISSET($_POST['submit'])){

    $id1=$_POST['iddoc'];
    $namedoc1=$_POST['namedoctor'];
    $username_doc1=$_POST['usernamedoc'];
    $passw_doc1=$_POST['passwdoc'];

    $sql="UPDATE `doctors` SET `username_doctors`='$username_doc1',
    `passw_doctors`='$passw_doc1', `FIO_doctor`='$namedoc1' WHERE `id_doctors`='$id1'";
     
    $result=mysqli_query($db,$sql);
    if($result==TRUE)
    {
        echo "Данные успешно сохранены!";
        echo "<script> document.location.href = 'manager_doctors.php'</script>";
    }
    else{
        echo"Ошибка.";
    }
}
?>

</body>
</html>
