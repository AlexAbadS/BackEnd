<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class comentario{
    private $id;
    private $contenido;
    
    
    
    function __construct(int $id, string $contenido) {
        $this->id = $id;
        $this->contenido = $contenido;
     
             
    }
}