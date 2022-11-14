
<?php


include_once './models/Elemento.php';

$nombre = 'Sin expecificar';
$descripcion = 'Sin expecificar';
$numero = 99999999999;
$activp = "Inactivo";
$prioridad = 'Sin expecificar';

if(!empty($_POST['nombre']))
{
    $nombre = (trim($_POST['nombre']));
}

if(!empty($_POST['desc']) )
{
    $descripcion = trim($_POST['desc'])  ;
}

if(!empty($_POST['numero']))
{
    $numero = $_POST['numero'];
}

if (!empty($_POST['act'])) {
    if ((strtolower($_POST['act'])) == 'activo') {
            $activp = 'Activo';
    }           
}


if (!empty($_POST['prio'])) {
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



echo $elemento2->save();



?>