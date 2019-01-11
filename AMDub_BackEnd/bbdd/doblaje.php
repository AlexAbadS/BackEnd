<?php

require_once 'tablaclass.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class doblaje extends Tabla {
       
   //Las propiedades mapean las existentes en la base de datos
   private $id_doblaje;
   private $titulo;
   private $audio;
   private $num_fields=3;
   private $idusuario;
   private $idpelicula;


   function __construct() {
       $show = ["nombre"];
       $fields = array_slice(array_keys(get_object_vars($this)), 0, $this->num_fields);
       
       parent::__construct("Doblaje", "$id_doblaje", $fields, $show);
   }

   //Getters

   function getId_doblaje() {
       return $this->id_doblaje;
   }

   function getTitulo() {
       return $this->titulo;
   }

   function getAudio() {
       return $this->audio;
   }

   function getIdusuario() {
       return $this->idusuario;
   }

   function getIdpelicula() {
       return $this->idpelicula;
   }

   
   //Setters
   
   function setTitulo($titulo) {
       $this->titulo = $titulo;
   }

   function setAudio($audio) {
       $this->audio = $audio;
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
       $doblaje = $this->getById($id);
                   
       if (!empty($doblaje)) {
           $this->id_doblaje = $id;
           $this->titulo = $doblaje['titulo'];
                              
       } else {
           throw new Exception("No existe ese registro");
       }
   }



function delete() {
       if (!empty($this->id_doblaje)) {
           $this->deleteById($this->id_doblaje);
           $this->id_doblaje = null;
           $this->titulo = null;
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
       $doblaje = $this->valores();
       unset($doblaje['id_doblaje']);
       if (empty($this->id_doblaje)) {
           $this->insert($doblaje);
           $this->id_doblaje = self::$conn->lastInsertId();
       } else {
           $this->update($this->id_doblaje, $doblaje);
       }
   }
}

?>