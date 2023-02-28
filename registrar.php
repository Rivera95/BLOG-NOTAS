<?php  
   //CONEXION BD
   require 'includes/config/database.php';
   $db = conectarDB();

   //ARREGLO DE ERRORES
   $errores = [];

   //SANITIZAR LOS DATOS QUE VAMOS A INGRESAR
   if($_SERVER['REQUEST_METHOD'] === 'POST'){
      
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    //IF PARA HACER LAS VALIDACIONES DE LOS CAMPOS
    if(!$email){
        $errores[] = "Debes insertar un email";
    }

    if(!$password){
         $errores[] = "Debes ingresar una contraseña";
    }

    //HASHEAR LA CONTRASEÑA
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    // var_dump($passwordHash);

    //SI LA VALIDACION ESTA VACIA ME HAGA LA CONSULTA
    if(empty($errores)){
        
        //QUERY PARA INSERTAR LOS DATOS
        $query = "INSERT INTO usuarios (email, password) VALUES ( '${email}', '${passwordHash}');";
        // echo $query;
        $resultado = mysqli_query($db, $query);

    //CONFIRMAR QUE INSERTO EL USUARIO
    if($resultado){
         header('Location: /block.php');
    }
    }
   
   }

   
   //LLAMAR EL HEADER
   include 'includes/templates/header.php';

?>
<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card mt-5">
                    <div class="card-header">Registrarse</div>
                    <div class="card-body">

                    <?php foreach($errores as $error): ?>
                       <div class="alert alert-danger" role="alert">
                          <?php echo $error; ?>
                       </div>
                    <?php endforeach; ?>

                        <form method="POST" action="registrar.php">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                                <div class="col-md-6">
                                    <input type="email" id="email" class="form-control" name="email" autofocus>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password" >
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4 mt-3">
                                <button type="submit" class="btn btn-primary">
                                    Registrarme
                                </button>
                                <a href="index.php" class="btn btn-link">
                                    ya tengo una cuenta
                                </a>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>