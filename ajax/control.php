<?php

require 'methods.php';

$action = $_POST['action'];

switch ($action) {

    case 'subir_pedido':
        $usuario = $_POST['usuario'];
        $mesa = $_POST['mesa'];
        $fecha = $_POST['fecha'];
        $nombre = $_POST['nombre'];
        $estado = $_POST['estado'];
        $boomer = json_decode($_COOKIE['feo']);
        $last_id = subir_pedido($usuario,$mesa,$fecha,$nombre,$estado);
        $exito = subir_detalle($last_id, $boomer);
        print($exito);
    break;
}

?>