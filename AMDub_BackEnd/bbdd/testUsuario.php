<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>TestUsuario</title>
    </head>
    <body>
        <pre>
        <?php
       require_once 'usuario.php';
       require_once 'doblaje.php';
       
       //nuevo registro
       
      $a = new Usuario();
      $a->nombre_usuario="Juan777";
      $a->passw="1234";
      $a->email="mario@gmail.com";
      $a->nombre="juan";
      $a->apellido="Juan";
      $a->direccion="calle walllaby";
      $a->telefono="123456789";
      $a->fecha_nac="30-02-1789";
      $a->save();
      
      
      
      
       $a->save();

  
      
      //update
//      $a->load(1);
//      $a->nombre_usuario="Juan";
//      $a->save();
      
      //para borrar
       
//      $a->delete();
      
      
      
        ?>
</pre>        
    </body>
</html>
