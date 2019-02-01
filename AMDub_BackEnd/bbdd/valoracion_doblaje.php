<?php

require_once 'tablaclass.php';

class Valoracion_doblaje extends Tabla {

    private $id_valoracion;
    private $puntuacion;
    private $id_doblaje;
    private $id_usuario;
    private $num_fields = 4;

    function __construct() {
        $show = ["nombre"];
        $fields = array_slice(array_keys(get_object_vars($this)), 0, $this->num_fields);

        parent::__construct("valoracion_doblaje", "id_valoracion", $fields, $show);
    }

    function getId_valoracion() {
        return $this->id_valoracion;
    }

    function getPuntuacion() {
        return $this->puntuacion;
    }

    function getId_doblaje() {
        return $this->id_doblaje;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function setPuntuacion($puntuacion) {
        $this->puntuacion = $puntuacion;
    }

    function setId_doblaje($id_doblaje) {
        $this->id_doblaje = $id_doblaje;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
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
            $this->id_valoracion = $id;
        } else {
            throw new Exception("No existe ese registro");
        }
    }

    function delete() {
        if (!empty($this->id_valoracion)) {
            $this->deleteById($this->id_valoracion);
            $this->id_valoracion = null;
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
        $valoracion_doblaje = $this->valores();
        unset($valoracion_doblaje['id_valoracion']);
        if (empty($this->id_valoracion)) {
            $this->insert($valoracion_doblaje);
            
            $this->id_valoracion = self::$conn->lastInsertId();
        } else {
            $this->update($this->id_valoracion, $valoracion_doblaje);
        }
    }

}
