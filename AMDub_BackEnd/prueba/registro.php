<!DOCTYPE html>

<html><head>
        <meta name="viewport" content="initial-scale=1.0, width=device-width" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
        <title>Registrar usuarios</title>
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <h1>Registrar usuarios</h1>
            </div>
            <form method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                </div>
                <div class="form-group">
                    <label for="email">Mail:</label>
                    <input type="text" class="form-control" id="email"  name="email">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <?php
            $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
            require_once 'tabla.php';
            $usuarios_t = new Tabla("usuarios", "idusuario","*", ["nombre","email"]);
            
            try {
                if (!empty($nombre) && !empty($mail)) {
                    $usuarios_t->insert(['nombre'=>$nombre,'email'=>$email])
                        ?>
                        <div class="alert alert-success">
                            <strong>Correcto: </strong> Usuario insertado con éxito.
                        </div>
                        <?php
                    }
                
                    if (!empty($id) ) {
                    $usuarios_t->deleteById($id);
                        ?>
                        <div class="alert alert-success">
                            <strong>Correcto: </strong> Usuario eliminado con id <?= $id ?>.
                        </div>
                        <?php
                    }
                
                $usuarios = $usuarios_t->getAll();
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Mail</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($usuarios as $usuario) {
                            ?>
                            <tr>
                                <td><?= $usuarios['idusuario'] ?></td>
                                <td><?= $usuarios['nombre'] ?></td>
                                <td><?= $usuarios['email'] ?></td>
                                <td><a class="btn btn-primary " href="?id=<?= $usuario['idusuario'] ?>">Borrar</a>
                                <a class="btn btn-primary " href="editar.php?id=<?= $usuario['idusuario'] ?>">Editar</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            ?>
        </div>
    </body>
</html>