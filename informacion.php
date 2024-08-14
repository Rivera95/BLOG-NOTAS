<?php 
    require 'includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth){
       header('Location: /');
    }

    //CONEXION BD
    require 'includes/config/database.php';
    $db = connectDB();

    //SQL PARA CONSULTAR
    $query = "SELECT * FROM notas";
    $resultadoConsulta = mysqli_query($db, $query);
  
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
                        <h1 class="mt-4">Información detallada</h1>
                           <ol class="breadcrumb mb-4">
                             <li class="breadcrumb-item active">Bienvenido</li>
                           </ol>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <i class="fas fa-table me-1"></i>
                                                     Tabla de información
                                            </div>
                                                <div class="card-body">
                                                    <table id="datatablesSimple">
                                                        <thead>
                                                            <tr>
                                                                <th>Titulo</th>
                                                                <th>Descripcion</th>
                                                                <th>Fecha Creada</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php while( $notas = mysqli_fetch_assoc($resultadoConsulta)): ?>
                                                            <tr>
                                                               <td><?php echo $notas['titulo']; ?></td>
                                                               <td><?php echo $notas['descripcion']; ?></td>
                                                               <td><?php echo $notas['fecha_creada']; ?></td>
                                                               <td>
                                                                  <input type="submit" class="btn btn-danger" value="Eliminar">
                                                                  <input type="submit" class="btn btn-success" value="Actualizar">
                                                               </td>
                                                            </tr>
                                                            <?php endwhile; ?>
                                                        </tbody>
                                                    </table>
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