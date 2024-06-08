<?php include("admin/bd.php");

//Seleccionar registros de servicios
$sentencia=$conexion->prepare("SELECT * FROM `tbl_servicios`");
$sentencia->execute();
$lista_Servicios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//Seleccionar registros de usuarios
$sentencia=$conexion->prepare("SELECT * FROM `tbl_usuarios`");
$sentencia->execute();
$lista_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//Seleccionar registros de portafolio
$sentencia=$conexion->prepare("SELECT * FROM `tbl_portafolio`");
$sentencia->execute();
$lista_portfolio=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//Seleccionar registros de configuraciones
$sentencia=$conexion->prepare("SELECT * FROM `tbl_configuraciones`");
$sentencia->execute();
$lista_configuraciones=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Servicios Eléctricos Carabeo</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" type="assets/icono.png" href="assets/logo.png">
</head>
<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#page-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ms-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                <li class="nav-item"><a class="nav-link" href="#page-top">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">Servicios</a></li>
                <li class="nav-item"><a class="nav-link" href="#portfolio">Trabajos</a></li>
                <li class="nav-item"><a class="nav-link" href="#cotizaciones">Cotizaciones</a></li>
            </ul>
        </div>
    </div>
</nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading"><?php echo $lista_configuraciones[0]['valor']; ?></div>
            <div class="masthead-heading text-uppercase"><?php echo $lista_configuraciones[1]['valor']; ?></div>
            <a class="btn btn-primary btn-xl text-uppercase" href="#services"><?php echo $lista_configuraciones[2]['valor']; ?></a>
        </div>
    </header>
    <!-- Services-->
    <section class="page-section" id="services">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase"><?php echo $lista_configuraciones[3]['valor']; ?></h2>
                <h3 class="section-subheading text-muted"><?php echo $lista_configuraciones[4]['valor']; ?></h3>
            </div>
            <div class="row text-center">
                <?php foreach($lista_Servicios as $registros) { ?>            
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas <?php echo $registros["icono"]; ?> fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3"><?php echo $registros["titulo"]; ?></h4>
                    <p class="text-muted"><?php echo $registros["descripcion"]; ?></p>
                </div>
                <?php } ?> 
            </div>
        </div>
    </section>
    <!-- Portfolio Grid-->
    <section class="page-section bg-light" id="portfolio">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase"><?php echo $lista_configuraciones[5]['valor']; ?></h2>
                <h3 class="section-subheading text-muted"><?php echo $lista_configuraciones[6]['valor']; ?></h3>
            </div>
            <div class="row">
                <?php foreach($lista_portfolio as $registros) { ?>            
                <div class="col-lg-4 col-sm-6 mb-4">
                    <!-- Portfolio item 1-->
                    <div class="portfolio-item">
                        <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1<?php echo $registros["ID"]; ?>">
                            <div class="portfolio-hover">
                                <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="assets/img/portfolio/<?php echo $registros["imagen"]; ?>"/>
                        </a>
                        <div class="portfolio-caption">
                            <div class="portfolio-caption-heading"><?php echo $registros["titulo"]; ?></div>
                            <div class="portfolio-caption-subheading text-muted"><?php echo $registros["subtitulo"]; ?></div>
                        </div>
                    </div>
                </div>
                <div class="portfolio-modal modal fade" id="portfolioModal1<?php echo $registros["ID"]; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="modal-body">
                                            <!-- Project details-->
                                            <h2 class="text-uppercase"><?php echo $registros["titulo"]; ?></h2>
                                            <p class="item-intro text-muted"><?php echo $registros["subtitulo"]; ?></p>
                                            <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/<?php echo $registros["imagen"]; ?>" alt="..." />
                                            <p><?php echo $registros["descripcion"]; ?></p>
                                            <ul class="list-inline">
                                                <li><strong>Cliente:</strong> <?php echo $registros["cliente"]; ?></li>
                                                <li><strong>Categoría:</strong> <?php echo $registros["categoria"]; ?></li>
                                                <li><strong>URL:</strong> <?php echo $registros["url"]; ?></li>
                                            </ul>
                                            <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                                <i class="fas fa-xmark me-1"></i> Cerrar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Cotizaciones Section -->
    <section class="page-section" id="cotizaciones">
        <div class="container">
            <div class="text-center">
            <meta charset="UTF-8">
    <title>Cotización</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .cotizaciones-box {
            max-width: 500px; /* Ajusta el ancho según prefieras */
            margin: 0 auto;
            text-align: center;
            background-color: #f0f0f0;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-control {
            width: 90%;
            margin: 10px auto;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 5px;
        }
        .btn-info {
            background-color: #17a2b8;
            color: white;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

<div class="cotizaciones-box">
    <h2>Cotizaciones</h2>
    <form action="" name="website" method="post">
        <div class="mb-3">
            <input
                type="text"
                class="form-control"
                name="nombre"
                id="nombre"
                placeholder="Nombre"
            />
        </div>
        <div class="mb-3">
            <input
                type="email"
                class="form-control"
                name="correo"
                id="correo"
                placeholder="Correo"
            />
        </div>
        <div class="mb-3">
            <input
                type="text"
                class="form-control"
                name="telefono"
                id="telefono"
                placeholder="Teléfono"
            />
        </div>
        <div class="mb-3">
            <textarea
                class="form-control"
                name="mensaje"
                id="mensaje"
                rows="3"
                placeholder="Mensaje"
            ></textarea>
        </div>
        <button type="submit" name="registro" class="btn btn-info">Enviar</button>
        <a href="admin/login_cotizacion.php" class="btn btn-info">Ver Cotizaciones</a>

    </form>
</div>

</body>
</html>
    <!-- Footer-->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Derechos Reservados &copy; Servicios Carabeo 2024</div>
                <div class="col-lg-4 my-3 my-lg-0"></div>
                <div class="col-lg-4 text-lg-end">
                    <a class="link-dark text-decoration-none me-3" href="#!">Privacidad de Política</a>
                    <a class="link-dark text-decoration-none" href="#!">Condiciones de</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- SB Forms JS-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>

<?php 
$servidor = "localhost";
$usuario = "root";
$contraseña = "1020";
$baseDeDatos = "website";

// Conexión a la base de datos
$enlace = mysqli_connect($servidor, $usuario, $contraseña, $baseDeDatos);

// Verificar la conexión
if (!$enlace) {
    die("Error: No se pudo conectar a la base de datos. " . mysqli_connect_error());
}

// Verificar si se envió el formulario
if(isset($_POST['registro'])){
    // Validar y sanitizar los datos del formulario
    $nombre = mysqli_real_escape_string($enlace, $_POST['nombre']);
    $correo = mysqli_real_escape_string($enlace, $_POST['correo']);
    $telefono = mysqli_real_escape_string($enlace, $_POST['telefono']);
    $mensaje = mysqli_real_escape_string($enlace, $_POST['mensaje']);

    // Verificar que todos los campos estén completos
    if(empty($nombre) || empty($correo) || empty($telefono) || empty($mensaje)) {
        echo "Por favor, complete todos los campos.";
    } else {
        // Preparar la consulta SQL con una consulta preparada
        $insertarDatos = "INSERT INTO datos (nombre, correo, telefono, mensaje) VALUES (?, ?, ?, ?)";
        
        // Preparar la declaración
        $stmt = mysqli_prepare($enlace, $insertarDatos);
        
        // Vincular los parámetros
        mysqli_stmt_bind_param($stmt, "ssss", $nombre, $correo, $telefono, $mensaje);
        
        // Ejecutar la declaración
        if(mysqli_stmt_execute($stmt)) {
            echo " ";
        } else {
            echo "Error al insertar datos: " . mysqli_error($enlace);
        }
        
        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    }
}

// Cerrar la conexión
mysqli_close($enlace);
?>