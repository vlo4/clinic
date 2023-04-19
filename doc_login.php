<?php
session_start();
?>

<?php
        if(ISSET($_POST['submit']))
       {
    $username=$_POST['username'];
    $passw=$_POST['pass'];
    if(empty($username) or empty($passw))
    {
        exit("Вы ввели не всю информацию");
    }
    include("db.php");

    if($_POST['action']=="signin"){
        $query="SELECT * FROM doctors WHERE username_doctors='$username'";
        $result=mysqli_query($db,$query);
        $myrow=mysqli_fetch_array($result);
        if(empty($myrow['username_doctors']))
        {
            exit("Извините, пользователь с таким логином не зарегистирован");
        }
        else{
            if($myrow['passw_doctors']==$passw)
            {
                echo "Вы успешно вошли";
                $_SESSION['username_doctors']=$myrow['username_doctors'];
                $_SESSION['id_doctors']=$myrow['id_doctors'];
                echo "<script> document.location.href = 'doc.php'</script>";
            }else{exit("Пароль неверный");}
        }
    }
}


?>
