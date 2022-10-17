<?php

include_once './models/Elemento.php';





$nombre = 'Sin expecificar';
$descripcion = 'Sin expecificar';
$numero = 99999999999;
$activp = "Inactivo";
$prioridad = 'Sin expecificar';

if(!empty(trim( $_POST['nombre'])))
{
    $nombre = $_POST['nombre'];
}

if(!empty(trim( $_POST['desc'])) )
{
    $descripcion = $_POST['desc'];
}

if(!empty($_POST['numero']))
{
    $numero = $_POST['numero'];
}

if(isset($_POST['act']))
{
    $activp = 'Activo';
}

if(!empty($_POST['prio']))
{
    $prioridad = $_POST['prio'];
}


$elemento = new Elemento($nombre, $descripcion, $numero, $activp, $prioridad);

echo $elemento->toJson();




?>