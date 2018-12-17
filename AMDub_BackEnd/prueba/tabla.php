<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Tabla {


static $server = "localhost";

static $user = "root";

static $password = "";

static $database = "proyecto";

private $table; //Nombre de la tabla

private $idField; //Nombre del campo clave

private $fields;  //Array con los nombres de los campos (opcional)

private $showFields; //Array con los nombres de los campos a mostrar en determinadas consultas (opcional)

static private $conn;


/**

* El constructor necesita el nombre de la tabla y el nombre del campo clave

* Opcionalmente podemos indicar los campos que tiene la tabla y aquellos que queremos mostrar

* Cuando se haga una selección

* @param type $table

* @param type $idField

* @param type $fields

* @param type $showFields

*/

public function __construct($table, $idField, $fields = "", $showFields = "") {

   	$this->table = $table;

   	$this->idField = $idField;

   	$this->fields = $fields;

   	$this->showFields = $showFields;

   	self::conectar();

}


/**

* Función de conexión

*/

static function conectar() {

   	try {

       	self::$conn = new PDO("mysql:host=" . self::$server . ";dbname=" . self::$database, self::$user, self::$password, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]);

       	self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   	} catch (Exception $ex) {

       	echo $ex->getMessage();

   	}

}


/**

* Getter de las propiedades

* @param type $name

* @return type

*/

function __get($name) {

   	if (property_exists($this, $name)) {

       	return $this->$name;

   	}

}


/**

* Setter de las propiedades

* @param type $name

* @param type $value

* @throws Exception

*/

function __set($name, $value) {

   	if (property_exists($this, $name) && !empty($value)) {

       	$this->$name = $value;

   	} else {

       	throw new Exception("Error: datos incorrectos");

   	}

}




//A partir de aquí vamos a crear las funciones básicas para un proceso de CRUD: Obtener todos los registros, un registro por id, insertar, actualizar y eliminar.


//Obtener todos:


/**

* Nos recupera todos los registros, opcionalmente podemos pasar una condición del tipo campo=valor

* Si no queremos que salgan todos los campos $completo debe estar a falso

* @param type $condicion

* @return type

*/

function getAll($condicion = "", $completo = true) {

   	$where = "";

   	$campos = " * ";

   	if (!empty($condicion)) {

       	//Aquí tendré que hacer algo!!!

       	$where = " where 1=1 ";

       	foreach ($condicion as $clave => $valor) {

           	$where .= " and " . $clave . " = '" . $valor . "' ";

       	}

   	}

   	if (!$completo && !empty($this->showFields)) {

       	$campos = implode(",", $this->showFields);

   	}

   	$res = self::$conn->query("select $campos from  $this->table $where");

   	return $res->fetchAll(PDO::FETCH_ASSOC);

}


/**

* Lo mismo que la anterior pero usando prepare

* @param type $condicion

* @param type $completo

* @return type

*/

function getAllPrepare($condicion = [], $completo = true) {

   	$where = "";

   	$campos = " * ";

   	if (!empty($condicion)) {

       	$where = " where " . join(" and ", array_map(function($v) {

                           	return $v . "=:" . $v;

                       	}, array_keys($condicion)));

   	}

   	if (!$completo && !empty($this->showFields)) {

       	$campos = implode(",", $this->showFields);

   	}

   	$st = self::$conn->prepare("select $campos from " . $this->table . $where);

   	$st->execute($condicion);

   	return $st->fetchAll(PDO::FETCH_ASSOC);

}

function getById($id) {

   	$res = self::$conn->query("select * from " . $this->table . " where "

           	. $this->idField . "=" . $id);

   	return $res->fetch(PDO::FETCH_ASSOC);

}



/**

* Esta función toma como parámetro un array asociativo y nos inserta en la tabla

* un registro donde la clave del array hace referencia al campo de la tabla y

* el valor del array al valor de la tabla.

* ejemplo para la tabla alumno: insert(['nombre'=>'Ana','mail'=>'i@i.com'])

* @param type $valores

*/

function insert($valores) {

   	try {

       	$campos = join(",", array_keys($valores));

       	$parametros = ":" . join(",:", array_keys($valores));

       	$sql = "insert into " . $this->table . "($campos) values ($parametros)";

       	$st = self::$conn->prepare($sql);

       	$st->execute($valores);

   	} catch (Exception $ex) {

       	echo $ex->getMessage();

   	}

}




/**

* Modifica el elemento de la base de datos con el id que pasamos

* Con los valores del array asociativo

* @param int $id Id del elemento a modificar

* @param array $valores Array asociativo con los valores a modificar

*/

function update($id, $valores) {

   	try {

       	//Creamos el cuerpo del select con la función array_map

       	$campos = join(",", array_map(function($v) {

                   	return $v . "=:" . $v;

               	}, array_keys($valores)));

       	$sql = "update " . $this->table . " set " . $campos . " where "

               	. $this->idField . " = " . $id;

       	$st = self::$conn->prepare($sql);

       	$st->execute($valores);

   	} catch (Exception $ex) {

       	echo $ex->getMessage();

   	}

}




/**

* Elimina el registro que tenga el id que le pasamos

* @param int $id

*/

function deleteById($id) {

   	try {

       	self::$conn->exec("delete from " . $this->table . " where "

               	. $this->idField . "=" . $id);

   	} catch (Exception $ex) {

       	echo $ex->getMessage();

   	}

}








}

//Pongo dos maneras de hacerlo, una utilizando el sql normal y otra con sentencias preparadas. La idea sería usar siempre sentencias preparadas. Las dos funciones tienen dos parámetros opcionales. El primero serían las condiciones de la búsqueda (por ejemplo ‘nombre’=>’Juan’). El segundo si queremos que se muestren todos los campos o sólo aquellos definidos en showFields.


//Veamos cómo se usaría esto. Creamos el objeto:


//$alumnos = new Tabla("alumnos", "idalumno", "*", ["nombre", "mail"]);
//
//$a=$alumnos->getAllPrepare(['nombre'=>'pepe']);
//
//print_r($a);
//
//$pepe=$alumnos->getById(1);
//print_r($pepe);
//
//$alumnos->insert(['nombre'=>'Ana','mail'=>'ana@ana.com']);
//$alumnos->update(1,['nombre'=>'Juan','mail'=>'pepe@pepe.com']);
