<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class usuario{
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
    
    
    function __construct(int $id, string $nombre_usu, string $pass, string $email, string $nombre,
            string $apellido, string $direccion, int $telefono, string $fecha_nacimiento, string $foto_usuario ) {
        $this->id = $id;
        $this->nombre_usu = $nombre_usu;
        $this->pass = $pass;
        $this->email = $email;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->foto_usuario = $foto_usuario;
             
    }

}
