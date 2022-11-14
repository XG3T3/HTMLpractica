
<?php

use LDAP\Result;

include './interfaces/interefaz.php';



class Elemento implements IToJson {

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


    function toJson(){
        $codi = json_encode(array('Nombre ' => $this->nombre, 'Descipcion' => $this->descripcion,
            'N.Serie' => $this -> numero,'Estado' => $this->activo,'Prioridad' => $this->prioridad)
        );

        $archivo = 'jsonFile.txt';

        file_put_contents($archivo , $codi.PHP_EOL , FILE_APPEND);

        return $codi;
    }

 ////////////////////// PRACTICA PDO/////////////////////////////////////////////


    private static function conexion(){
        $dsn= 'mysql:name=127.0.0.1;port=3306;dbname=monfab';
        $pdo = new PDO($dsn,'root','');
        return $pdo;
        
    
    }



    public static function getElementAll(){

        try{
            $pdo = self::conexion();

            try{

            
                $consulta = $pdo->query("SELECT nombre,descripcion,nserie,estado,prioridad FROM elementos");
                $consultaRes = $consulta->fetchAll(PDO :: FETCH_ASSOC);
            
                return json_encode(['succes' => true,
                                    'mensaje' => "Mostrando todos los elementos de la tabla,",
                                    'data:'=> $consultaRes], JSON_PRETTY_PRINT);   
            }
            catch(PDOException $exx){
                return json_encode(['succes' => false,
                                    'mensaje' => "La query tiene un error",
                                    'data:'=> null], JSON_PRETTY_PRINT);
            }

        }

        catch(PDOException $ex){
        return json_encode(['succes' => false,
                        'mensaje' => "La conexion tiene un error",
                        'data:'=> null], JSON_PRETTY_PRINT);
                        

        }

    }


    public static function getElement($id){

        try{

            $pdo = self::conexion();
            
            try{
                $consulta = $pdo->prepare("SELECT nombre,descripcion,nserie,estado,prioridad FROM elementos
                WHERE id = :id");

                $consulta-> bindParam(":id",$id);
                $consulta->execute();

                $consultaRes = $consulta->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($consultaRes)){
                
                    return json_encode(['success' => true,'Mensaje' => 'elemento encontrado','datos:' => $consultaRes],JSON_PRETTY_PRINT);     
                }

                else{
                    
                    return json_encode(['success' => false,'Mensaje' => "elemento con el $id no encontrado",'datos:' => null],JSON_PRETTY_PRINT);     
                }
            }
            catch(PDOException $exx){
                return json_encode(['succes' => false,
                                    'Mensaje' => "La query tiene un error",
                                    'data:'=> null],JSON_PRETTY_PRINT);
            }
        }
        catch(PDOException $ex){
            return json_encode(['succes' => false,
            'Mensaje' => "La conexion tiene un error",
            'data:'=> null],JSON_PRETTY_PRINT);
            }


    }


    public static function eliminar($id){

        try{
            
            $pdo = self::conexion();

            try{

                $existe= $pdo -> prepare("SELECT nombre,descripcion,nserie,estado,prioridad FROM elementos  WHERE id = :id");
                $existe -> bindParam(":id",$id);
                $existe -> execute();
                $resultado = $existe->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($resultado)){

                    $consulta =$pdo->prepare("DELETE FROM elementos
                    WHERE id = :id");

                    $consulta ->bindParam(':id', $id);

                    $consulta->execute();

                    return json_encode(['success' => true,"message:"=> "Elemento con la $id ha sido borrado",'data' => $resultado],JSON_PRETTY_PRINT);

                }
                else{
            
                    return json_encode(['success' => false,'message:'=>"no existe la id: $id ",'data' => null],JSON_PRETTY_PRINT);
                
                }
            }
            catch(PDOException $exx){
                return json_encode(['succes' => false,
                                    'Mensaje' => "La query tiene un error",
                                    'data:'=> null],JSON_PRETTY_PRINT);
            }
        }
        catch(PDOException $ex){
            return json_encode(['succes' => false,
            'Mensaje' => "La conexion tiene un error",
            'data:'=> null],JSON_PRETTY_PRINT);
            
        }
    
    }



    function createElement(){


        try{
            
            $pdo = self::conexion();

            try{
                $nombre = $this->nombre;
                $descripcion= $this->descripcion;
                $nserie= $this->numero;
                $activo = $this->activo;
                $prioridad = $this->prioridad;


                $sql ="INSERT INTO elementos (nombre, descripcion, nserie, estado, prioridad)
                VALUES (:nombre,:descripcion,:nserie,:activo,:prioridad)";


                $consulta= $pdo->prepare($sql);


                $consulta->bindParam(":nombre",$nombre);
                $consulta->bindParam(":descripcion",$descripcion);
                $consulta->bindParam(":nserie",$nserie);
                $consulta->bindParam(":activo",$activo);
                $consulta->bindParam(":prioridad",$prioridad);

                $consulta -> execute();




                $ultimoid = $pdo->lastInsertId();

                $insertado = $pdo->query("SELECT nombre,descripcion,nserie,estado,prioridad FROM elementos
                WHERE id = $ultimoid");

                $insertadoBase = $insertado->fetchAll(PDO :: FETCH_ASSOC);
                

                return json_encode(['success' => true,'message' => "elemento creado con la id : " . $ultimoid,'data' => $insertadoBase],JSON_PRETTY_PRINT) ;
            }

            catch(PDOException $exx){
                return json_encode(['succes' => false,
                                    'message' => "La query tiene un error",
                                    'data:'=> null],JSON_PRETTY_PRINT);
            }
        }
        catch(PDOException $ex){
            return json_encode(['succes' => false,
                                'message' => "La conexion tiene un error",
                                'data:'=> null],JSON_PRETTY_PRINT);
        }
        
    }

    

    function modificaElement($id){

        try{
            
            $pdo = Elemento::conexion();

            try{

                $existe = $pdo->prepare("SELECT nombre,descripcion,nserie,estado,prioridad FROM elementos  WHERE id = :id");
                $existe->bindParam(":id", $id);
                $existe->execute();
                $resultado = $existe->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($resultado)) {

                    $cambio = [];
                    $bimpara = [];

                    foreach ($this as $atributo => $valor) {
                        if ($valor != null) {

                            if ($atributo == 'numero') {
                                $atributo = 'nserie';
                            }


                            if ($atributo == 'activo') {
                                $atributo = 'estado';
                            }

                            if ($atributo == 'prio') {
                                $atributo = 'prioridad';
                            }

                            $cambio[] = "$atributo =:$atributo";
                            $bimpara[":$atributo"] = $valor;
                        }
                    }


                    if(!empty($cambio)){
                        $cambioset = implode(',', $cambio);



                        $sql = "UPDATE elementos SET $cambioset WHERE id = :id";


                        $consulta2 = $pdo->prepare($sql);

                        $consulta2->bindParam(':id', $id);

                        foreach ($bimpara as $atributo => &$valors) {

                            $consulta2->bindParam($atributo, $valors, PDO::PARAM_STR);
                        }
                        $consulta2->execute();


                        $existe = $pdo->prepare("SELECT nombre,descripcion,nserie,estado,prioridad FROM elementos  WHERE id = :id");
                        $existe->bindParam(":id", $id);
                        $existe->execute();
                        $resultado = $existe->fetchAll(PDO::FETCH_ASSOC);

                        return json_encode(['success' => true, 'message' => 'elemento modificado', 'data :' => $resultado], JSON_PRETTY_PRINT);
                    }

                    else{
                    return json_encode(['success' => false, 'message' => 'no has introducido nada para actualizar', 'data :' => null], JSON_PRETTY_PRINT);
                    }
                } 

                else {
                return json_encode(['success' => false, 'message' => 'no existe el elemento', 'data :' => null], JSON_PRETTY_PRINT);
                }
            
            }
            catch(PDOException $exx){
                return json_encode(['succes' => false,
                                    'message' => "La query tiene un error",
                                    'data:'=> null],JSON_PRETTY_PRINT);
            }

        }
        
        catch(PDOException $ex){
            return json_encode(['succes' => false,
            'message' => "La conexion tiene un error",
            'data:'=> null],JSON_PRETTY_PRINT);
            }

    }


   

    function save($id = null){

                if ($id != null) {
                    return $this->modificaElement($id);
                } else {
                    return $this->createElement();
                }
    }

}


?>

