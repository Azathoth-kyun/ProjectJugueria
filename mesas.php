<?php 
    //Session para mantener conectado
	session_start();
	
	include "assets/constant/config.php";

	// Checa el user si esta logeado o no
	if(!isset($_SESSION['uname'])){
    	header('Location: index.php');
	}

	// Cerrar sesión
	if(isset($_POST['but_logout'])){
    	session_destroy();
    	header('Location: index.php');
	}

	$_SESSION['pedidos_ya']=null;

	$cookie_name = 'feo';
    unset($_COOKIE[$cookie_name]);
    // empty value and expiration one hour before
	$res = setcookie($cookie_name, '', time() - 3600);
	
	$cookie_name2 = 'aux';
    unset($_COOKIE[$cookie_name2]);
    // empty value and expiration one hour before
	$res2 = setcookie($cookie_name2, '', time() - 3600);

	//query de mesas
	$query_mesas="SELECT DISTINCT nro_mesa as mesita , id_mesa as id_messa FROM mesa WHERE (id_mesa % 2) <> 0;";
	$resultado=ejecutarConsulta($query_mesas);

	//numero de mesas
	$query_numero="SELECT COUNT( DISTINCT nro_mesa) as wero FROM mesa;";
	$resultado_numero = ejecutarConsulta($query_numero);
	$numero_de_mesas = mysqli_fetch_assoc($resultado_numero);
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Jugueria Oh que Rico!</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Owl Carousel -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">
    
    <style>
        .btn-mesa{
            background-image: url('images/table-icon.png');
            background-position: 15% 50%;
            background-repeat: no-repeat;
            background-size: 40px 60px;
            background-color: #f3f1f1;
            color: #454e57;
            border-color: rgb(54, 43, 43);
            width: 80%;
            height: 60px;
            font-size: 16px !important;
        }
    </style>

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>

    <!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">¿Qué desea hacer? - Mesa <span id="title_mesa"></span></h5>
				</div>
				<div class="modal-body text-center">
                    <a href="" id="realizar" type="button" class="btn btn-primary">Realizar pedido</a>
                    <a href="" id="ver" type="button" class="btn btn-secondary">Ver pedido</a>
				</div>
			</div>
			</div>
		</div>

	<nav id="colorlib-main-nav" role="navigation">
		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle active"><i></i></a>
		<div class="js-fullheight colorlib-table">
			<div class="colorlib-table-cell js-fullheight">
				<div class="row" style="margin-top: 60px;">
					<div class="col-md-12 text-center">
						<ul>
							<li class="active"><a href="mesas.php">Mesas</a></li>
							<li><a href="#">Pedidos</a></li>
							<li><a href="#">Permisos</a></li>
							<li><form method='post' id="cerrar" action="">
                                <input style="display:none;" type="number" value="1" name="but_logout" class="btn btn-outline-light"></input>
                                <a href="#" onclick="document.getElementById('cerrar').submit();">Cerrar sesión</a>
                                </form></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</nav>
	
	<div id="colorlib-page">
		<header style="background-color: #FF6107;">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="colorlib-navbar-brand">
							<a class="colorlib-logo" style="background-color: #FF6107;" href="menu.html"><i class="icon-coffee" style="margin-top: 17px; color: #000;"></i><span>Oh que</span><span>Rico!</span></a>
						</div>
						<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
					</div>
				</div>
			</div>
		</header>
		
		<div class="colorlib-menu">
			<div class="container">
				<div class="row" style="margin-top: 50px;">
					
				</div>
				<?php 
						if($resultado){
							while($row=mysqli_fetch_array($resultado)){
								echo '<div class="row" style="margin-top: 20px;">
								<div class="col-md-5 text-center">
									<button class="btn btn-mesa" onclick="menu('.$row['mesita'].');">
										&nbsp;
										&nbsp;
										Mesa
										'.$row['mesita'].'
									</button>
								</div>
								<div class="col-md-2" style="margin-top: 20px;"></div>';
								$skere=$row['mesita']+1;
								if($row['mesita']===$numero_de_mesas['wero']){
									$bochido = 'style="display:none;"';
								}
								else{
									$bochido ="";
								}
								echo'<div class="col-md-5 text-center">
									<button class="btn btn-mesa" '.$bochido.' onclick="menu('.$skere.');">
										&nbsp;
										&nbsp;
										Mesa
										'.$skere.'
									</button>
									</div>
									</div>';
							}
						}
					?>
			</div>
		</div>
	
	</div>

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Parallax -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Owl Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Date Picker -->
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>

	<!-- Main JS (Do not remove) -->
    <script src="js/main.js"></script>
    
    <script>
		function menu(numero_mesa){
			document.getElementById("title_mesa").innerHTML = numero_mesa;
			var realizar = document.getElementById("realizar");
			var ver = document.getElementById("ver");
			realizar.setAttribute("href", "pedir.php?mesa="+numero_mesa);
			ver.setAttribute("href", "contact.html");
			$('#exampleModal').modal('show');
		}
	</script>

	</body>
</html>

