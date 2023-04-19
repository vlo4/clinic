<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <title>Личный кабинет пользователя</title>
</head>
<body>
    <?php
    include("userNav.php");
    include("db.php");
    ?>

<?php
    $sql="SELECT * FROM user WHERE id_user='$idUser'";
    $result=mysqli_query($db,$sql);
    $myrow=mysqli_fetch_array($result);

    $userName=$myrow['username_user'];
    $passw=$myrow['passw_user'];
    $lastName=$myrow['LastName_user'];
    $firstName=$myrow['FirstName_user'];
    $fatherName=$myrow['MidName_user'];
    $birthDate=$myrow['birthdate'];
    $policy=$myrow['policy'];
    $insurance=$myrow['insurance'];
    $tel=$myrow['tel'];
    $email=$myrow['email'];

    echo "<div class='row about' style='margin: 4em 0;padding: 1em;position: relative;'>
    <div class='col-lg-4 col-md-4 col-sm-12'>
        <form action='#' method='POST' class='form-group' style='margin-bottom: 1%;'>
        <h4>Редактирование профиля</h4>
        <input type='text' name='userName' placeholder='Логин/E-mail' class='form-control' value='$userName' required><br>
        <input type='password' name='passw' placeholder='Пароль' class='form-control' value='$passw' required><br>
        <input type='text' name='lastName' placeholder='Фамилия' class='form-control' value='$lastName'><br>
        <input type='text' name='firstName' placeholder='Имя' class='form-control' value='$firstName'><br>
        <input type='text' name='fatherName' placeholder='Отчество' class='form-control' value='$fatherName'><br>
        <input type='date' name='birthDate' class='form-control' value='$birthDate'><br>
        <input type='text' name='policy' placeholder='Полис' class='form-control' value='$policy'><br>
        <input type='text' name='insurance' placeholder='Снилс' class='form-control' value='$insurance'><br>
        <input type='text' name='tel' placeholder='Телефон' class='form-control' value='$tel'><br>
        <input type='email' name='email' placeholder='E-mail' class='form-control' value='$email' required><br>
        <button type='submit' name='submit' class='btn' style='background-color: #008080; color: #fff;'>Сохранить изменения</button>
    </form>
    </div>";
    ?>


<?php
if(ISSET($_POST['submit'])){

    $userName=$_POST["userName"];
    $passw=$_POST["passw"];
    $lastName=$_POST["lastName"];
    $firstName=$_POST["firstName"];
    $fatherName=$_POST["fatherName"];
    $birthDate=$_POST["birthDate"];
    $policy=$_POST["policy"];
    $insurance=$_POST["insurance"];
    $tel=$_POST["tel"];
    $email=$_POST["email"];

    $sql="UPDATE user SET LastName_user='$lastName',FirstName_user='$firstName',
    MidName_user='$fatherName',birthdate='$birthDate',
    tel='$tel',email='$email',username_user='$userName',passw_user='$passw', policy='$policy', 
    insurance='$insurance' WHERE id_user=$idUser";
    $result=mysqli_query($db,$sql);
    if($result==TRUE)
    {
        echo "Данные успешно сохранены!";
        echo "<script> document.location.href = 'user_prof.php'</script>";
    }
    else{
        echo"Ошибка.";
    }
}
?>

</body>
</html>
