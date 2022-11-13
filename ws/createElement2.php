
<?php


include_once './models/Elemento.php';

$nombre = 'Sin expecificar';
$descripcion = 'Sin expecificar';
$numero = 99999999999;
$activp = "Inactivo";
$prioridad = 'Sin expecificar';

if(!empty($_POST['nombre']))
{
    $nombre = (trim($_POST['nombre'])) ?? 'null';
}

if(!empty($_POST['desc']) )
{
    $descripcion = trim($_POST['desc']) ?? $descripcion ;
}

if(!empty($_POST['numero']))
{
    $numero = $_POST['numero'];
}

if (isset($_POST['act'])) {
    switch ( strtolower($_POST['act'])) {
        case 'activo':
            $activp = 'Activo';
            break;
        case 'inactivo':
            $activp = 'Inactivo';
            break;
    }
}


if (!empty($_POST['prio'])) {
    //$prioridad = $_POST['prio'];

    switch (strtolower($_POST['prio'])) {
        case 'baja':
            $prioridad = 'baja';
            break;

        case 'media':
            $prioridad = 'media';
            break;

        case 'alta':
            $prioridad = 'alta';
            break;
    }
}



$elemento2 = new Elemento($nombre, $descripcion, $numero, $activp, $prioridad);



echo ($elemento2->save());



?>