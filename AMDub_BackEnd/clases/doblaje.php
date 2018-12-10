<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Doblaje{
    private $id_doblaje;
    private $titulo;
    private $audio;
    
    function __construct(int $id_doblaje, string $titulo,string $audio ) {
        $this->id_doblaje = $id_doblaje;
        $this->titulo = $titulo;
        $this->audio = $audio;
           
    }

    
}
