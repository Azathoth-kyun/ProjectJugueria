<?php

require '../assets/constant/config.php';
session_start();

function subir_pedido($usuario,$mesa,$fecha,$nombre,$estado){
    $insercion = "INSERT INTO pedido(id_mesa,fecha,id_usuario,nombre_referencia,estado) VALUES ('$mesa','$fecha','$usuario','$nombre','$estado');";
    $result_insercion = ejecutarConsulta_retornarID($insercion);
    return $result_insercion;
}

function subir_detalle($last_id, $boomer){
    for ($i=0; $i < count($boomer) ; $i++) { 
        $id_producto = $boomer[$i][4];
        $cantidad = $boomer[$i][1];
        $costo = $boomer[$i][2];
        $observacion = $boomer[$i][3];
        $insercion = "INSERT INTO detalle_pedido(id_pedido, id_producto, cantidad, costo, observacion) VALUES ('$last_id','$id_producto','$cantidad','$costo','$observacion');";
        $result_insercion = ejecutarConsulta($insercion);
    }
    return $result_insercion;
}

?>