<?php

require_once 'tablaclass.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class valoracion_doblaje extends Tabla {

   //Las propiedades mapean las existentes en la base de datos
   private $id_doblaje;
   private $id_usuario;
   private $puntuacion;
   private $num_fields=3;
   


   function __construct() {
       $show = ["nombre"];
       $fields = array_slice(array_keys(get_object_vars($this)), 0, $this->num_fields);
       
       parent::__construct("valoracion_doblaje", "id_usuario", $fields, $show);
   }

   function getId_doblaje() {
       return $this->id_doblaje;
   }

   function getId_usuario() {
       return $this->id_usuario;
   }

   function getPuntuacion() {
       return $this->puntuacion;
   }

   function setId_doblaje($id_doblaje) {
       $this->id_doblaje = $id_doblaje;
   }

   function setId_usuario($id_usuario) {
       $this->id_usuario = $id_usuario;
   }

   function setPuntuacion($puntuacion) {
       $this->puntuacion = $puntuacion;
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


function load($id) {
       $valoracion_doblaje = $this->getById($id);
                   
       if (!empty($valoracion_doblaje)) {
           $this->id_usuario = $id;
           $this->puntuacion = $valoracion_doblaje['puntuacion'];
                              
       } else {
           throw new Exception("No existe ese registro");
       }
   }



function delete() {
       if (!empty($this->id_usuario)) {
           $this->deleteById($this->id_usuario);
           $this->id_usuario = null;
           $this->puntuacion = null;
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
       $pelicula = $this->valores();
       unset($pelicula['idpelicula']);
       if (empty($this->idpelicula)) {
           $this->insert($pelicula);
           $this->idpelicula = self::$conn->lastInsertId();
       } else {
           $this->update($this->idpelicula, $pelicula);
       }
   }
}
