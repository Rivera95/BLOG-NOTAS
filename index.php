<?php 
   //CONEXION BD
   require 'includes/config/database.php';
   $db = connectDB();

   //ERRORES
   $errores = [];

   //AUTENTICAR USUARIO
   if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = mysqli_real_escape_string($db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password'] );

    if(!$email){
        $errores[] = "El campo Email es obligatorio";
    }

    if(!$password){
        $errores[] = "El campo Password es obligatorio";
    }

    //VALIDAR ERRORES
    if(empty($errores)){
      //SQL PARA CONSULTAR
      $query = "SELECT * FROM usuarios WHERE email = '${email}'";
      $resultado = mysqli_query($db, $query);

    if( $resultado->num_rows ){
       //CONSULTA PASSWORD
       $registroUsuario  = mysqli_fetch_assoc($resultado);
       //VALIDAR PASSWORD
       $auth = password_verify($password, $registroUsuario['password']);

    if($auth){
         session_start();

         //ARRAY DE SESION
         $_SESSION['usuario'] = $registroUsuario['email'];
         $_SESSION['id'] = $registroUsuario['id'];
         $_SESSION['login'] = true;
         
         header('Location: /block.php');

    } else {
        $errores[] = "El password es incorrecto";
    }

    } else {
        $errores[] = "El usuario no existe";
    }
    }
   }

   //  LLAMAR EL HEADER
   include 'includes/templates/header.php';
?>

<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card mt-5">
                    <div class="card-header">Iniciar Sesión</div>
                    <div class="card-body">

                    <?php foreach($errores as $error): ?>
                       <div class="alert alert-danger" role="alert">
                          <?php echo $error; ?>
                       </div>
                    <?php endforeach; ?>
                        <form method="POST">
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
                                    Iniciar Sesión
                                </button>
                                <a href="registrar.php" class="btn btn-link">
                                    Aun no tienes una cuenta?
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