<?php


include_once './models/Elemento.php';

$nombre = null;
$descripcion = null;
$numero = null;
$activp = null;
$prioridad = null;

if (!empty($_POST['nombre'])) {
    $nombre = trim($_POST['nombre']);
}

if (!empty($_POST['desc'])) {
    $descripcion = trim($_POST['desc']);
}

if (!empty($_POST['numero'])) {
    $numero = $_POST['numero'];
}



if (isset($_POST['act'])) {
    switch (strtolower($_POST['act'])) {
        case 'Activo':
            $activp = 'Activo';
            break;
        case 'Inactivo':
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


if (!empty($_GET['id'])) {
    echo $elemento2->save($_GET['id']);
} else {
    echo json_encode(['success'=> false,'message: '=> "Has enviado una id vacia",'data: ' => null],JSON_PRETTY_PRINT);
}
