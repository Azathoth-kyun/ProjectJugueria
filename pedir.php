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
	
	if(isset($_COOKIE['aux'])){
		$mensaje= 1;
	}else{
		$mensaje= 0;
	}

	if(isset($_GET['mesa'])){
		$mesa = $_GET['mesa'];
	}

	$query_categorias="SELECT * FROM categoria;";
	$resultado_de_categorias=ejecutarConsulta($query_categorias);

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
		.nav-tabs {
        display: inline-flex;
        width: 100%;
        overflow-x: auto;
        -ms-overflow-style: none; /*// IE 10+*/
        overflow: -moz-scrollbars-none;/*// Firefox*/}
        .nav-tabs>li.active>a,
        .nav-tabs>li.active>a:focus,
        .nav-tabs>li.active>a:hover {
            border-width: 0;
        }
        .nav-tabs>li>a {
            border: none;
            color: #666;
        }
        .nav-tabs>li.active>a,
        .nav-tabs>li>a:hover {
            border: none;
            color: #FF6107 !important;
            background: transparent;
        }
        .nav-tabs>li>a::after {
            content: "";
            background: #FF6107;
            height: 2px;
            position: absolute;
            width: 100%;
            left: 0px;
            bottom: 1px;
            transition: all 250ms ease 0s;
            transform: scale(0);
        }
        .nav-tabs>li.active>a::after,
        .nav-tabs>li:hover>a::after {
            transform: scale(1);
        }
        .tab-nav>li>a::after {
            background: #FF6107 none repeat scroll 0% 0%;
            color: #fff;
        }
        .tab-pane {
            padding: 15px 0;
        }
        .tab-content {
            padding: 20px
        }

        .nav-tabs::-webkit-scrollbar {
            display: none; /*Safari and Chrome*/
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
				<h5 class="modal-title" id="exampleModalLabel">Añadir a la orden?</h5>
				</div>
				<div class="modal-body">
						<span style="display:none;" id="id_platillito">SKEREEEE</span>
						<input type="number" id="precio_platillo" style="display:none;">
						<span id="platillito">Este producto:</span>
						<input type="number" id="cantidad_platillito" min="1" class="text-center" style="float: right;max-width:20px;height:30px;outline: 0; border-width: 0 0 2px;border-color: black;" value="1">
						<textarea class="form-control" style="margin-top: 20px; border-radius: 10px;
    					box-shadow: 0 0 0 1px #000; border: 1px solid transparent;" id="observacion_pedido" rows="3" placeholder="Observación..."></textarea>
				</div>
				<div class="modal-footer">
					<div class="text-center">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						<button type="button" onclick="addToCart();" class="btn btn-primary">Añadir</button>
					</div>
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
							<li><a href="mesas.php">Mesas</a></li>
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
		
		<span style="display:none;" id="aux_cookie">
		<?php echo $mensaje; ?>
		</span>
		

		<div class="colorlib-menu">
			<div class="container">
				<div class="row" style="margin-top: 50px;">
				</div>
				<div class="row">
					<div class="col-md-12 animate-box">
						<div class="row">
							<div class="col-md-12 text-center">
								<ul class="nav nav-tabs text-center" role="tablist">
									<?php if($resultado_de_categorias){
										$yepeto = array();
										while($row_cat=mysqli_fetch_array($resultado_de_categorias)){
											array_push($yepeto,$row_cat['nombre']);
											echo '<li role="presentation" id="'.$row_cat['nombre'].'1" style="font-size: 14px;"><a href="#'.$row_cat['nombre'].'" aria-controls="'.$row_cat['nombre'].'" role="tab" data-toggle="tab"><span style="display:none;" id="'.$row_cat['nombre'].'_aux">'.$row_cat['id_categoria'].'</span>'.$row_cat['nombre'].'</a></li>';
										}
									}
									?>
									<!-- <li role="presentation" class="active" style="font-size: 14px;"><a href="#main" aria-controls="mains" role="tab" data-toggle="tab">Jugos</a></li>
									<li role="presentation"  style="font-size: 14px;"><a href="#desserts" aria-controls="desserts" role="tab" data-toggle="tab">Panes</a></li>
									<li role="presentation" style="font-size: 14px;"><a href="#drinks" aria-controls="drinks" role="tab" data-toggle="tab">Infusiones</a></li>
									<li role="presentation" style="font-size: 14px;"><a href="#drinks" aria-controls="drinks" role="tab" data-toggle="tab">Postres</a></li>
									<li role="presentation" style="font-size: 14px;"><a href="#drinks" aria-controls="drinks" role="tab" data-toggle="tab">Pasas</a></li> -->
								</ul>
							</div>
							<form id="filter-search">
								<div class="text-center" style="margin-top: 10px;">
									<input type="text" style="height:30px;outline: 0; border-width: 0 0 2px;border-color: black;" placeholder="Buscar...">
								</div>
							</form>
						</div>
						<div class="tab-content">
							<?php 
							for ($i=0; $i < count($yepeto); $i++) { 
								echo '<div role="tabpanel" class="tab-pane" id="'.$yepeto[$i].'">
								<div class="row">
									<div class="col-md-6">
									<ul class="menu-dish">
										';
									$query_plato="SELECT P.id_producto as id_producto, P.nombre as nombre, P.precio as precio FROM producto P INNER JOIN categoria C ON P.id_categoria=C.id_categoria WHERE C.nombre LIKE '%$yepeto[$i]%' AND (P.id_producto%2)=0";
									$tame_impala=ejecutarConsulta($query_plato);
									if($tame_impala){
										while($row_moon=mysqli_fetch_array($tame_impala)){
											echo '<li onclick="aniadir(\''.$row_moon['nombre'].'\','.$row_moon['id_producto'].','.$row_moon['precio'].');" style="cursor: pointer;">
											<span style="display: none;">'.$row_moon['nombre'].'</span>
											<figure class="dish-entry">
												<div class="dish-img" style="background-image: url(images/dish-'.$row_moon['id_producto'].'.jpg);"></div>
											</figure>
											<div class="text">
											  <span class="price">S/.'.number_format($row_moon['precio'], 2, '.', '').'</span>
											  <h3>'.$row_moon['nombre'].'</h3>
											  <!--<p class="cat">Meat / Potatoes / Rice / Tomatoe</p>-->
											</div>
										  </li>';
										}
									}
								echo '
									</ul>
									</div>
									<div class="col-md-6">
									<ul class="menu-dish">';
									$query_plato2="SELECT P.id_producto as id_producto, P.nombre as nombre, P.precio as precio FROM producto P INNER JOIN categoria C ON P.id_categoria=C.id_categoria WHERE C.nombre LIKE '%$yepeto[$i]%' AND (P.id_producto%2)<>0";
									$tame_impala2=ejecutarConsulta($query_plato2);
									if($tame_impala2){
										while($row_moon2=mysqli_fetch_array($tame_impala2)){
											echo '<li onclick="aniadir(\''.$row_moon2['nombre'].'\','.$row_moon2['id_producto'].','.$row_moon2['precio'].');" style="cursor: pointer;">
											<span style="display: none;">'.$row_moon2['nombre'].'</span>
											<figure class="dish-entry">
												<div class="dish-img" style="background-image: url(images/dish-'.$row_moon2['id_producto'].'.jpg);"></div>
											</figure>
											<div class="text">
											  <span class="price">S/.'.number_format($row_moon2['precio'], 2, '.', '').'</span>
											  <h3>'.$row_moon2['nombre'].'</h3>
											  <!--<p class="cat">Meat / Potatoes / Rice / Tomatoe</p>-->
											</div>
										  </li>';
										}
									}
								echo '
								</ul>
								</div></div>	
								</div>';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
        
    </div>
    <a href="" id="ver-pedido-btn" onclick="console.log('skere');" class="btn btn-info" style="position: fixed;
    bottom: 0; width: 50%;
    right: 25%;
    display:none;">Ver pedido</a>

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

	<script src="js/searcher.js"></script>

	<script>
        function setCook(name, value) {
    var cookie = [
        name,
        '=',
        JSON.stringify(value)
    ].join('');
    document.cookie = cookie;
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) {
            return JSON.parse(
                c.substring(nameEQ.length, c.length)
            );
        }
    }
    return null;
    }	
		if(document.getElementById("aux_cookie").innerHTML == 1){
			console.log('Existe');
		}
		else{
			setCook('feo',null);
		}
		var boomerino = readCookie('feo');
		var botono = document.getElementById('ver-pedido-btn');
        if(boomerino != null){
			cart = boomerino;
			botono.style.display= null;
            botono.setAttribute("href", "viewpedido.php?mesa=<?php echo $mesa ?>");
        }
        else{
            cart = [];
        }
        function addToCart(){
            var plato = document.getElementById("platillito").innerHTML;
            var cantidad = document.getElementById("cantidad_platillito").value;
			var observacion = document.getElementById("observacion_pedido").value;
			var precio_plato = document.getElementById("precio_platillo").value;
			var id_plato = document.getElementById("id_platillito").innerHTML;
			precio_plato= precio_plato * cantidad;
			console.log(precio_plato);
            var pedido = [plato,cantidad,precio_plato,observacion,id_plato];
            cart.push(pedido);
            setCook('feo',cart);
            var boomer = readCookie('feo');
            console.log(boomer);
            botono.style.display= null;
            botono.setAttribute("href", "viewpedido.php?mesa=<?php echo $mesa ?>");
			$('#exampleModal').modal('hide');
		}
		function aniadir(platillo,id_platillo,precio){
			document.getElementById("platillito").innerHTML = platillo;
			document.getElementById("id_platillito").innerHTML = id_platillo;
			document.getElementById("precio_platillo").value = precio;
			document.getElementById("cantidad_platillito").value = 1;
			document.getElementById("observacion_pedido").value = "";
			$('#exampleModal').modal('show');
		}
		$('#Jugos1').addClass("active");
		$('div#Jugos').addClass("active");

	</script>

	</body>
</html>

