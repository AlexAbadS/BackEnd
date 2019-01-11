<?php

require_once 'tablaclass';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Pelicula extends Tabla {

   //Las propiedades mapean las existentes en la base de datos
   private $idpelicula;
   private $nombre_pelicula;
   private $director;
   private $pais;
   private $duracion;
   private $fecha_estreno;
   private $productora;
   private $genero;
   private $imagen;
   private $tipo;
   private $num_fields=10;
   


   function __construct() {
       $show = ["nombre"];
       $fields = array_slice(array_keys(get_object_vars($this)), 0, $this->num_fields);
       
       parent::__construct("pelicula", "$idpelicula", $fields, $show);
   }

   //Getters

   
   function getIdpelicula() {
       return $this->idpelicula;
   }

   function getNombre_pelicula() {
       return $this->nombre_pelicula;
   }

   function getDirector() {
       return $this->director;
   }

   function getPais() {
       return $this->pais;
   }

   function getDuracion() {
       return $this->duracion;
   }

   function getFecha_estreno() {
       return $this->fecha_estreno;
   }

   function getProductora() {
       return $this->productora;
   }

   function getGenero() {
       return $this->genero;
   }

   function getImagen() {
       return $this->imagen;
   }

   function getTipo() {
       return $this->tipo;
   }

   
   
   //Setters
   
   function setNombre_pelicula($nombre_pelicula) {
       $this->nombre_pelicula = $nombre_pelicula;
   }

   function setDirector($director) {
       $this->director = $director;
   }

   function setPais($pais) {
       $this->pais = $pais;
   }

   function setDuracion($duracion) {
       $this->duracion = $duracion;
   }

   function setFecha_estreno($fecha_estreno) {
       $this->fecha_estreno = $fecha_estreno;
   }

   function setProductora($productora) {
       $this->productora = $productora;
   }

   function setGenero($genero) {
       $this->genero = $genero;
   }

   function setImagen($imagen) {
       $this->imagen = $imagen;
   }

   function setTipo($tipo) {
       $this->tipo = $tipo;
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
       $pelicula = $this->getById($id);
                   
       if (!empty($pelicula)) {
           $this->idpelicula = $id;
           $this->nombre_pelicula = $pelicula['nombre_pelicula'];
                              
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
