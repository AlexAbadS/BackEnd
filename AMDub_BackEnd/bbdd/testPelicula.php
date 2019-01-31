
<html>
    <head>
        <meta charset="UTF-8">
        <title>TestPelicula</title>
    </head>
    <body>
        <pre>
        <?php
       
       require_once 'pelicula.php';
       
       //nuevo registro
       
      $a = new Pelicula();
      $a->nombre_pelicula="Piratas del Caribe";
      $a->director="yo";
      $a->pais="Caribe";
      $a->duracion="145";
      $a->fecha_estreno="2009-03-21";
      $a->productora="Disney";
      $a->genero="Accion";
      $a->tipo="1";
      $a->save();
      
      
      