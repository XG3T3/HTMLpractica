
<?php



class Elemento implements IToJson{

public $nombre;
public $descripcion;
public $numero;
public $activo;
public $prioridad;


function __construct($nombre, $desc, $numero, $activo, $prioridad)
{
    $this ->nombre = $nombre;
    $this ->descripcion = $desc;
    $this ->numero = $numero;
    $this ->activo = $activo;
    $this ->prioridad = $prioridad;

    
}



public function getNombre()
{
return $this->nombre;
}


public function setNombre($nombre)
{
$this->nombre = $nombre;
}


public function getDescripcion()
{
return $this -> descripcion;
}


public function setDescripcion($descripcion)
{
$this->descripcion = $descripcion;
}


public function getNumero()
{
return $this -> numero;
}


public function setNumero($numero)
{
$this->numero = $numero;
}


public function getActivo()
{
return $this -> activo;
}


public function setActivo($activo)
{
$this->activo = $activo;
}

 
public function getPrioridad()
{
return $this->prioridad;
}


public function setPrioridad($prioridad)
{
$this->prioridad = $prioridad;
}


function toJson()
{
    $codi = json_encode(array('Nombre ' => $this->nombre, 'Descipcion' => $this->descripcion,
        'N.Serie' => $this -> numero,'Estado' => $this->activo,'Prioridad' => $this->prioridad)
    );

    $archivo = 'jsonFile.txt';

    file_put_contents($archivo , $codi.PHP_EOL , FILE_APPEND);

   return $codi;
}
}
?>

