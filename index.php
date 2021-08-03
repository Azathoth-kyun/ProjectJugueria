<?php 
//Session para mantener conectado
session_start();


if($_SESSION['uname'] != null || $_SESSION['uname'] != ""){
    header('Location: mesas.php');
}

$count=0;

if($_SESSION['result'] != null || $_SESSION['result'] !=""){
    $count=1;
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ingresar</title>
    <link rel="stylesheet" href="assets-login/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets-login/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets-login/css/styles.min.css">
</head>

<body>
    <div class="login-clean">
        <form action="assets/app/auth.php" method="POST" autocomplete="OFF">
        <?php if($_SESSION['result'] != null || $_SESSION['result'] !=""){
                        if($count==1){
                        echo $_SESSION['result'];
                        $_SESSION['result'] = "";
                        }
                    }?>
            <h2 class="sr-only">Ingresar</h2>
            <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="user" placeholder="Usuario"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Contraseña"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" name="but_submit" type="submit">Ingresar</button></div></form>
    </div>
    <script src="assets-login/js/jquery.min.js"></script>
    <script src="assets-login/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>