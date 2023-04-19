<?php
session_start();
?>

<?php
        if(ISSET($_POST['submit']))
       {
    $email=$_POST['email'];
    $passw=$_POST['pass'];
    if(empty($email) or empty($passw))
    {
        exit("Вы ввели не всю информацию");
    }
    include("db.php");
    if($_POST['action']=="signup")
    {
        $query="SELECT * FROM user WHERE username_user='$email' OR email='$email'";
        $result=mysqli_query($db,$query);
        $myrow=mysqli_fetch_array($result);
        if(!empty($myrow['id_user']))
        {
            exit("Извините, пользователь с таким email уже существует");
        }
        $query="INSERT INTO user(email,username_user,passw_user) VALUES ('$email','$email','$passw')";
        $result=mysqli_query($db,$query);

        if($result==TRUE)
        {
            echo "Вы успешно зарегистрированы. Теперь Вы можете авторизироваться и перейти в личный кабинет";
            $_SESSION['username_user']=$email;
            $query="SELECT max(id_user) AS id_user FROM user";
            $result=mysqli_query($db,$query);
            $myrow=mysqli_fetch_array($result);
            $_SESSION['id_user']=$myrow['id_user'];
            echo "<script> document.location.href = 'user_prof.php'</script>";
        }
        else {echo ("Ошибка регистрации");}
    }

    if($_POST['action']=="signin"){
        $query="SELECT * FROM user WHERE username_user='$email' OR email='$email'";
        $result=mysqli_query($db,$query);
        $myrow=mysqli_fetch_array($result);
        if(empty($myrow['username_user']))
        {
            exit("Извините, пользователь с таким email/логином не зарегистирован");
        }
        else{
            if($myrow['passw_user']==$passw)
            {
                echo "Вы успешно вошли";
                $_SESSION['username_user']=$myrow['username_user'];
                $_SESSION['id_user']=$myrow['id_user'];
                if($_SESSION['username_user']=="manager"){
                    echo "<script> document.location.href = 'manager.php'</script>";
                }
                else{echo "<script> document.location.href = 'user_prof.php'</script>";}
            }else{exit("Пароль неверный");}
        }
    }
}


?>
