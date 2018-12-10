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
    
    
    function __construct(int $id, string $nombre, string $director, string $pais, int $duracion,
            string $fecha_estreno, string $productora, string $genero, string $imagen, string $tipo ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->director = $director;
        $this->pais = $pais;
        $this->duracion = $duracion;
        $this->fecha_estreno = $fecha_estreno;
        $this->productora = $productora;
        $this->genero = $genero;
        $this->imagen = $imagen;
        $this->tipo = $tipo;
        
    }

}