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
	
    if(isset($_COOKIE['feo'])){
        $_SESSION['pedidos_ya'] = $_COOKIE['feo'];
        $arreglo_pete= json_decode($_COOKIE['feo']);
	}
	
	if(isset($_GET['mesa'])){
		$mesa = $_GET['mesa'];
	}

    //$cookie_name = 'feo';
    //unset($_COOKIE[$cookie_name]);
    // empty value and expiration one hour before
    //$res = setcookie($cookie_name, '', time() - 3600);
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
        table {
          border-collapse: collapse;
          width: 100%;
        }
        .bb th {
            border-bottom: 1px solid black !important;
        }
        
        th, td {
          text-align: left;
          padding: 8px;
        }
        
        tr:nth-child(even) {background-color: #f2f2f2;}

		input[type=checkbox]{
			height: 0;
			width: 0;
			visibility: hidden;
		}

		label {
			float: right;
			cursor: pointer;
			text-indent: -9999px;
			width: 70px;
			height: 25px;
			background: grey;
			display: block;
			border-radius: 100px;
			position: relative;
		}

		label:after {
			content: '';
			position: absolute;
			top: 5px;
			left: 5px;
			width: 20px;
			height: 20px;
			background: #fff;
			border-radius: 90px;
			transition: 0.3s;
		}

		input:checked + label {
			background: #bada55;
		}

		input:checked + label:after {
			left: calc(100% - 5px);
			transform: translateX(-100%);
		}

		label:active:after {
			width: 50px;
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
				<h5 class="modal-title" id="exampleModalLabel">Enviar la orden?</h5>
				</div>
				<div class="modal-body">
					<div class="d-flex-inline flex-row">
						<span style="display:inline; font-size:14px; margin-right: 5px;">Nombre:</span>
						<input id="nombre_referencia" style="display:inline; min-width: 75%; border-radius: 10px;
    					box-shadow: 0 0 0 1px #000; border: 1px solid transparent;height:20px;float: right; margin-top: 5px;" type="text" placeholder="Ej: Pablito" />
						<br>
						<br>
						<span style="display:inline; font-size:14px; margin-right: 5px;">Para llevar?</span>
						<input style="display:inline;" type="checkbox" id="switch" /><label for="switch">Toggle</label>
					</div>
				</div>
				<div class="modal-footer">
					<div class="text-center">
						<button type="button" onclick="sendOrder();" class="btn btn-primary">Enviar</button>
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

		<div class="colorlib-menu">
			<div class="container">
				<div class="row" style="margin-top: 20px;">
					<div class="col-md-6 col-md-offset-3 text-center animate-box intro-heading">
						<span class="icon"><i class="flaticon-cutlery"></i></span>
						<h3>Pedido - Mesa N°<?php echo $mesa; ?></h3>
					</div>
                </div>
                <?php echo '<script>console.log('.$_COOKIE['feo'].');</script>'; ?>
                <div>
                    <table id="tabla_pedido">
                        <tr class="bb">
                            <th>Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Precio</th>
                            <th class="text-center">Anular</th>
                        </tr>
						<?php 
							$totalisimo= 0;
                            for ($i=0; $i < count($arreglo_pete) ; $i++) {
								$aux = $i + 1;
								$totalisimo = $totalisimo + $arreglo_pete[$i][2];
                                echo '<tr><td>'.$arreglo_pete[$i][0].'</td>
                                <td class="text-center">
                                '.$arreglo_pete[$i][1].'
                                </td>
                                <td class="text-center">
                                '.number_format($arreglo_pete[$i][2], 2, '.', '').'
								</td>
								<td style="display: none;">'.$arreglo_pete[$i][3].'</td>
								<td style="display: none;">'.$arreglo_pete[$i][4].'</td>
                                <td class="text-center">
                                <button onclick="delete_frodo('.$aux .');" class="btn btn-danger text-center" style="width:20px; padding: 0px;">
                                    <b>X</b>
                                </button>
                                </td></tr>';
                            }
                        ?>
                    </table>
                </div>
                <hr style="height:1px;border:none;color:#333;background-color:#333;" />
                <div class="text-right">
                    <b>Total: <span id="total_gol"> <?php echo number_format($totalisimo, 2, '.', '');?></span></b>&nbsp;&nbsp;
                </div>
                <div class="text-center">
                    <button onclick="show_modal();" class="btn btn-primary">
                        Confirmar
                    </button>
                    <button onclick="window.location.href = 'pedir.php?mesa=<?php echo $mesa; ?>'" class="btn btn-secondary">
                        <i class="icon-arrow-left3"></i>Regresar
                    </button>
                </div>
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

        var boomerino = readCookie('feo');
    </script>
	<script>
	function show_modal(){
		$('#exampleModal').modal('show');
	}
	setCook('aux',1);
	var cart_aux = [];
	function delete_frodo(numero_skere){
		var nro_restar = document.getElementById("tabla_pedido").rows[numero_skere].cells[2].innerHTML;
		var totalisimo = document.getElementById("total_gol").innerHTML;
		var nuevo_totalisimo = totalisimo - nro_restar;
		document.getElementById("total_gol").innerHTML = nuevo_totalisimo.toFixed(2);
		document.getElementById('tabla_pedido').deleteRow(numero_skere);
		var table_length = document.getElementById("tabla_pedido").rows.length;
		for (let index = 1; index < table_length; index++) {
			var item1 = document.getElementById("tabla_pedido").rows[index].cells[0].innerHTML;
			var item2 = document.getElementById("tabla_pedido").rows[index].cells[1].innerHTML;
			var item3 = document.getElementById("tabla_pedido").rows[index].cells[2].innerHTML;
			var item4 = document.getElementById("tabla_pedido").rows[index].cells[3].innerHTML;
			var item5 = document.getElementById("tabla_pedido").rows[index].cells[4].innerHTML;
			var pedido = [item1,item2,item3,item4,item5];
			cart_aux.push(pedido);
			setCook('feo',cart_aux);
		}
		var boomer = readCookie('feo');
		console.log(boomer);
	}
	</script>
	<script>
		function sendOrder(){
			var boomer = readCookie('feo');
		var mesa= <?php echo $mesa; ?>;
		var usuario= <?php echo $_SESSION['id_usuario']; ?>;
		var today = new Date();
		var dd = String(today.getDate()).padStart(2, '0');
		var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
		var yyyy = today.getFullYear();
		today = dd + '/' +  mm + '/' + yyyy;
		console.log(today);
		if($('#switch').is(':checked')){
			var estado = '01';
		}else{
			var estado = '00';
		}
		var nombre_referencia= $('#nombre_referencia').val();
		$.ajax({
			type: 'POST',
			url: 'ajax/control.php',
			data: {
                    action: 'subir_pedido',
                    boomer: boomer,
					mesa: mesa,
					usuario: usuario,
					fecha: today,
					estado: estado,
					nombre: nombre_referencia
                },
                success: function () {
					console.log('NICE');
                }
		});
		}
	</script>
	</body>
</html>

