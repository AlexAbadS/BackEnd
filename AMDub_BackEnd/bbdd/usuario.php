<?php

require_once 'doblaje.php';
require_once 'tablaclass.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Usuario extends Tabla {

   //Las propiedades mapean las existentes en la base de datos
   private $idusuario;
   private $nombre_usuario;
   private $passw;
   private $email;
   private $nombre;
   private $apellido;
   private $direccion;
   private $telefono;
   private $fecha_nac;
   private $foto_usuario;
   private $num_fields=10;



   function __construct() {
       $show = ["nombre"];
       $fields = array_slice(array_keys(get_object_vars($this)), 0, $this->num_fields);
       parent::__construct("usuarios", "idusuario", $fields, $show);
   }

   //Getters

   function getIdusuario() {
       return $this->idusuario;
   }

   function getNombre_usuario() {
       return $this->nombre_usuario;
   }

   function getPassw() {
       return $this->passw;
   }

   function getEmail() {
       return $this->email;
   }

   function getNombre() {
       return $this->nombre;
   }

   function getApellido() {
       return $this->apellido;
   }

   function getDireccion() {
       return $this->direccion;
   }

   function getTelefono() {
       return $this->telefono;
   }

   function getFecha_nac() {
       return $this->fecha_nac;
   }

   function getFoto_usuario() {
       return $this->foto_usuario;
   }
   

  //Setters
      
   function setNombre_usuario($nombre_usuario) {
       $this->nombre_usuario = $nombre_usuario;
   }

   function setPassw($passw) {
       $this->passw = $passw;
   }

   function setEmail($email) {
       $this->email = $email;
   }

   function setNombre($nombre) {
       $this->nombre = $nombre;
   }

   function setApellido($apellido) {
       $this->apellido = $apellido;
   }

   function setDireccion($direccion) {
       $this->direccion = $direccion;
   }

   function setTelefono($telefono) {
       $this->telefono = $telefono;
   }

   function setFecha_nac($fecha_nac) {
       $this->fecha_nac = $fecha_nac;
   }

   function setFoto_usuario($foto_usuario) {
       $this->foto_usuario = $foto_usuario;
   }

      


function __get($name) {
       $metodo = "get$name";
       if (method_exists($this, $metodo)) {
           return $this->$metodo();
       } else {
           throw new Exception("Propiedad no encontrada");
       }
   }

   function __set($name, $value) {
       $metodo = "set$name";
       if (method_exists($this, $metodo)) {
           return $this->$metodo($value);
       } else {
           throw new Exception("Propiedad no encontrada");
       }
   }


//function getUsuarioByDoblaje($id){
//    $alumnos = $this->getAll(['id_doblaje'=>$id]);
//    //Convertirlo en una array de objetos Usuario
//    $obj_al=[];
//    foreach($usuarios as $a){
//    $alumno=new Alumno();
//    $usuario->load($a['idusuario'],true);
//    $obj_al[]=$usuario;
//    }
//    return $obj_al;
//}

function load($id) {
       $usuario = $this->getById($id);

       if (!empty($usuario)) {
           $this->idusuario = $id;
           $this->nombre_usuario = $usuario['nombre_usuario'];
           $this->passw = $usuario['passw'];
           $this->email = $usuario['email'];
           $this->nombre = $usuario['nombre'];
           $this->apellido = $usuario['apellido'];
           $this->direccion = $usuario['direccion'];
           $this->telefono = $usuario['telefono'];
           $this->fecha_nac = $usuario['fecha_nac'];
           $this->foto_usuario = $usuario['foto_usuario'];
                     
       } else {
           throw new Exception("No existe ese registro");
       }
   }



function delete() {
       if (!empty($this->idusuario)) {
           $this->deleteById($this->idusuario);
           $this->idusuario = null;
           $this->nombre_usuario = null;
           $this->passw = null;
           $this->email = null;
           $this->nombre = null;
           $this->apellido = null;
           $this->direccion = null;
           $this->telefono = null;
           $this->foto_usuario = null;

           
       } else {
           throw new Exception("No hay registro para borrar");
       }
   }



private function valores() {

       $valores = array_map(function($v) {
           return $this->$v;
       }, $this->fields);
       return array_combine($this->fields, $valores);
   }


   function save() {
       $usuario = $this->valores();
       unset($usuario['idusuario']);
       if (empty($this->idusuario)) {
           $this->insert($usuario);
           $this->idusuario = self::$conn->lastInsertId();
       } else {
           $this->update($this->idusuario, $usuario);
       }
   }
}

?>