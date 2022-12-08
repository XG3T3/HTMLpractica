
<?php


include_once './models/Elemento.php';


$nombre = null;
$descripcion = 'Sin expecificar';
$numero = 99999999999;
$activp = "Inactivo";
$prioridad = 'Sin expecificar';

if(!empty($_POST['nombre'] ))
{
    $nombre = (trim($_POST['nombre']));
}

if(!empty($_POST['desc']) && !empty(trim($_POST['desc'])))
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


if($nombre != null){
    $elemento2 = new Elemento($nombre, $descripcion, $numero, $activp, $prioridad);
    echo $elemento2->save();
}

else{
    echo json_encode(['success' => false,
    'message' => "inserta todos los datos",
    'data:'=> null],JSON_PRETTY_PRINT);
}




?>