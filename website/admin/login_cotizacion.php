<?php
session_start();
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
header('Pragma: no-cache');

$mensaje = ""; // Inicializar la variable de mensaje

// Usuario y contraseña predefinidos
$usuario_predefinido_cotizaciones = "Nelson";
$password_predefinido_cotizaciones = "Nelson123";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("./bd.php");

    $formulario = isset($_POST['formulario']) ? $_POST['formulario'] : "";
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    // Verificar que los campos no estén vacíos
    if (empty($usuario) || empty($password)) {
        $mensaje = "Error: Por favor, ingresa el usuario y la contraseña.";
    } else {
        // Verificar usuario predefinido
        if (
            ($formulario == 'administrar' && $usuario == $usuario_predefinido_admin && $password == $password_predefinido_admin) ||
            ($formulario == 'cotizaciones' && $usuario == $usuario_predefinido_cotizaciones && $password == $password_predefinido_cotizaciones)
        ) {
            // Iniciar sesión y redirigir
            $_SESSION['usuario'] = $usuario;
            $_SESSION['logueado'] = true;

            if ($formulario == 'administrar') {
                header("Location: admin/index.php");
            } elseif ($formulario == 'cotizaciones') {
                header("Location: cotizaciones.php");
            }
            exit;
        }

        // Determinar la consulta según el formulario
        if ($formulario == 'administrar') {
            $query = "SELECT COUNT(*) as n_usuario FROM `tbl_usuarios` WHERE usuario=:usuario AND password=:password";
        } elseif ($formulario == 'cotizaciones') {
            $query = "SELECT COUNT(*) as n_usuario FROM `login_cotizaciones` WHERE usuario=:usuario AND password=:password";
        } else {
            $mensaje = "Error: Formulario no reconocido.";
            $query = "";
        }

        if (!empty($query)) {
            // Preparar y ejecutar la consulta
            $sentencia = $conexion->prepare($query);
            $sentencia->bindParam(":usuario", $usuario);
            $sentencia->bindParam(":password", $password);
            $sentencia->execute();

            // Obtener el resultado
            $lista_usuarios = $sentencia->fetch(PDO::FETCH_ASSOC);

            if ($lista_usuarios['n_usuario'] > 0) {
                // El usuario existe, iniciar sesión y redirigir
                $_SESSION['usuario'] = $usuario;
                $_SESSION['logueado'] = true;

                if ($formulario == 'administrar') {
                    header("Location: admin/index.php");
                } elseif ($formulario == 'cotizaciones') {
                    header("Location: cotizaciones.php");
                }
                exit;
            } else {
                // El usuario no existe
                $mensaje = "Error: Usuario o Contraseña Inválido";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            background: linear-gradient(120deg, #89f7fe, #66a6ff);
        }
        .card {
            width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background: white;
            margin: 10px;
        }
        .card-header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .btn-login {
            background: #66a6ff;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .btn-login:hover {
            background: #5591ff;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            Inicio de Sesión - Cotizaciones
        </div>
        <?php if (!empty($mensaje) && $formulario == 'cotizaciones') { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $mensaje ?>
            </div>
        <?php } ?>
        <form method="post" action="">
            <input type="hidden" name="formulario" value="cotizaciones">
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" />
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" />
            </div>
            <div class="text-center">
                <button type="submit" class="btn-login">Iniciar Sesión</button>
            </div>
        </form>
    </div>
</body>
</html>
