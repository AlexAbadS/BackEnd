
<html>
    <head>
        <meta charset="UTF-8">
        <title>TestComentario</title>
    </head>
    <body>
        <pre>
        <?php 
       require_once 'comentario.php';
       require_once 'usuario.php';
       require_once 'doblaje.php';
       require_once 'pelicula.php';
       
       //nuevo registro
       
      $a = new Comentario();
      $a->id_doblaje=1;
      $a->id_usuario=1;
      $a->contenido="prueba comentario2";
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
