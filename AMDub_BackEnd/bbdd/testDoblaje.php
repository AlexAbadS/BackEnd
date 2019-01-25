


<html>
    <head>
        <meta charset="UTF-8">
        <title>TestDoblaje</title>
    </head>
    <body>
        <pre>
        <?php 
       require_once 'pelicula.php';
       require_once 'usuario.php';
       require_once 'doblaje.php';
       
       //nuevo registro
       
      $a = new Doblaje();
      $a->titulo="FUNCIONA";
      $a->idusuario=1;
      $a->idpelicula=1;
      $a->audio="audio_fake.mp3";
      $a->save();
      
      
      
      
      $a->load(1);
      
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
