<?php

require_once 'tablaclass.php';

class Comentario extends Tabla {

    private $id_comentario;
    private $id_doblaje;
    private $id_usuario;
    private $contenido;
    private $num_fields = 4;

    function __construct() {
        $show = ["nombre"];
        $fields = array_slice(array_keys(get_object_vars($this)), 0, $this->num_fields);

        parent::__construct("comentario", "id_comentario", $fields, $show);
    }

    function getId_comentario() {
        return $this->id_comentario;
    }

    function getId_doblaje() {
        return $this->id_doblaje;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getContenido() {
        return $this->contenido;
    }

    function setId_doblaje($id_doblaje) {
        $this->id_doblaje = $id_doblaje;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setContenido($contenido) {
        $this->contenido = $contenido;
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
        $comentario = $this->getById($id);

        if (!empty($comentario)) {
            $this->id_comentario = $id;
        } else {
            throw new Exception("No existe ese registro");
        }
    }

    function delete() {
        if (!empty($this->id_comentario)) {
            $this->deleteById($this->id_comentario);
            $this->id_comentario = null;
            $this->contenido = null;
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
        $comentario = $this->valores();
        unset($comentario['id_comentario']);
        if (empty($this->id_comentario)) {
            $this->insert($comentario);
            
            $this->id_comentario = self::$conn->lastInsertId();
        } else {
            $this->update($this->id_comentario, $comentario);
        }
    }

}
