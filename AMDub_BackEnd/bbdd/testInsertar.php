
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
       require_once 'valoracion_doblaje.php';
       
       
       
      $a = new Valoracion_doblaje();
      $a->puntuacion=5;
      $a->id_doblaje=1;
      $a->id_usuario=1;
      $a->save();

       
       
       
       /*
      //Doblaje
      $a = new Doblaje();
      $a->titulo="FUNCIONA";
      $a->idusuario=1;
      $a->idpelicula=1;
      $a->audio="audio_fake.mp3";
      $a->save();
      */  
      
       
        /*
      //Usuario
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
      */ 
        
       
      
       /*
      //Pelicula
      $a->nombre_pelicula="Piratas del Caribe";
      $a->director="yo";
      $a->pais="Caribe";
      $a->duracion="145";
      $a->fecha_estreno="2009-03-21";
      $a->productora="Disney";
      $a->genero="Accion";
      $a->tipo="1";
      $a->save();
      */ 
       
       
       
      /*
      //Comentario
      $a = new Comentario();
      $a->id_doblaje=1;
      $a->id_usuario=1;
      $a->contenido="prueba comentario2";
      $a->save();
      */
      

      /*
        update
        $a->load(1);
        $a->nombre_usuario="Juan";
        $a->save();
      
        para borrar
        $a->delete();
      */
      
      
        ?>
</pre>        
    </body>
</html>
