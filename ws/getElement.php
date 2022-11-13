<?php



//include_once './Conexion.php';
include_once './models/Elemento.php';



if (!empty($_GET['id'])){
    echo(Elemento :: getElement($_GET['id']));
}
else{
    echo(Elemento :: getElementAll());
}




?>