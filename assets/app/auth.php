<?php
//Autenticación para el inicio de sesión
session_start();

include "../constant/config.php";


if(isset($_POST['but_submit'])){

    $uname = mysqli_real_escape_string($con,$_POST['user']);
    $password = mysqli_real_escape_string($con,$_POST['password']);


    if ($uname != "" && $password != ""){

        $sql_query = "select count(*) as cntUser, id_usuario as id from usuario where username='".$uname."' and password='".$password."' and estado=00 and permiso_acceso=00";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];
        $_SESSION['id_usuario'] = $row['id'];

        if($count > 0){
            $_SESSION['uname'] = $uname;
            header('Location: ../../mesas.php');
        }else{
            $result="<div class='alert alert-danger' role='alert'>
            Usuario y/o contraseña invalida.
            </div>";
            $_SESSION['result'] = $result;
            header('Location: ../../index.php');
        }
    }else{
        $result="<div class='alert alert-danger' role='alert'>
            Usuario y/o contraseña invalida.
            </div>";
            $_SESSION['result'] = $result;
            header('Location: ../../index.php');
    }
}
?>