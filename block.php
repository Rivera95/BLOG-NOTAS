<?php 
    require 'includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth){
       header('Location: /');
    }
    
    //CERRAR SESSION
    $auth = $_SESSION['login'] ?? false;

    //CONEXION BD
    require 'includes/config/database.php';
    $db = conectarDB();

    //ARREGLO DE ERRORES
    $errores = [];

    //SANITIZAR LOS DATOS QUE VAMOS A INGRESA
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
      $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
      $fecha_creada = date('Y/m/d');
      $id_usuario = $_SESSION['id'];


      if(!$titulo){
        $errores[] = "Debes ingresar un titulo";
      }

      if(!$descripcion){
        $errores[] = "Debes ingresar una descripcion";
      }

      //VALIDAR EL ARREGLO DE ERRORES SI ESTA VACIO ME HAGA LA FUINCION
      if(empty($errores)){
         //QUERY PARA INSERTAR
         $query = "INSERT INTO notas (titulo, descripcion, fecha_creada, id_usuario) VALUES ( '${titulo}', '${descripcion}', '${fecha_creada}', '${id_usuario}');";
         $resultado = mysqli_query($db, $query);
        //  echo $query;

         //CONFIRMAR QUE INSERTO
         if($resultado){
            header('Location: /block.php');
         }
      }
    }



    //LLAMAR EL HEADER
    include 'includes/templates/header.php';



?>

<body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Bloc de notas</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <?php if($auth): ?>
                        <li><a class="dropdown-item" href="cerrar_se.php">Cerrar Sesión</a></li>
                    <?php endif; ?>
                        
                    </ul>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="block.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Crear Bloc
                            </a>
                            <a class="nav-link" href="informacion.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Detalles
                            </a>
                        </div>
                    </div>
                </nav>
            </div>

            
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Crear un bloc de notas</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Puedes guardar toda tu información para que no se te olvide nada</li>
                        </ol>
                        <?php foreach($errores as $error): ?>
                       <div class="alert alert-danger" role="alert">
                          <?php echo $error; ?>
                       </div>
                       <?php endforeach; ?>

                                    <div class="row">
                                        <div class="col-xl-10">
                                            <div class="card">
                                                <form  method='POST' action="block.php">
                                                    <div class="card-header">
                                                    <button type="submit" class="btn btn-primary">
                                                      Crear nota
                                                    </button>
                                                    </div>
                                                     <div class="card-body">
                                                        <div class="row">
                                                        <div class="col-xl-12">
                                                        <div class="mb-3">
                                                            <label for="titulo" class="form-label">Titulo:</label>
                                                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Por favor ingresa un titulo">
                                                            </div>
                                                            <div class="mb-3">
                                                            <label for="descripcion" class="form-label">Descripcion:</label>
                                                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                                                        </div>
                                                     </div>     
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="assets/js/datatables-simple-demo.js"></script>
            </div>
        </div>
</body>

