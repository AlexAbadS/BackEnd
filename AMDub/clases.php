<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class pelicula{
    private $id;
    private $nombre;
    private $director;
    private $pais;
    private $duracion;
    private $fecha_estreno;
    private $productora;
    private $genero;
    private $imagen;
    private $tipo;
}

class comentario{
    private $id;
    private $contenido;
}

class usuarios{
    private $id;
    private $nombre_usu;
    private $pass;
    private $email;
    private $nombre;
    private $apellido;
    private $direccion;
    private $telefono;
    private $fecha_nacimiento;
    private $foto_usuario;
}

class Doblaje{
    private $id_doblaje;
    private $titulo;
    private $audio;
}

