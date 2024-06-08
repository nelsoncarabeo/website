<?php
session_start();
if ($_POST) {
    include("./bd.php");

    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    // Verificar que los campos no estén vacíos
    if (empty($usuario) || empty($password)) {
        $mensaje = "Error: Por favor, ingresa el usuario y la contraseña.";
    } else {
        // Preparar y ejecutar la consulta
        $sentencia = $conexion->prepare("SELECT COUNT(*) as n_usuario FROM `tbl_usuarios` WHERE usuario=:usuario AND password=:password");
        $sentencia->bindParam(":usuario", $usuario);
        $sentencia->bindParam(":password", $password);
        $sentencia->execute();

        // Obtener el resultado
        $lista_usuarios=$sentencia->fetch(PDO::FETCH_LAZY);

        if ($lista_usuarios['n_usuario'] > 0) {
            // El usuario existe, iniciar sesión y redirigir
            $_SESSION['usuario'] = $usuario;
            $_SESSION['logueado'] = true;
            header("Location: index.php");
            exit;
        } else {
            // El usuario no existe
            $mensaje = "Error: Usuario o Contraseña Invalido";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INICIO DE SESIÓN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #1DD5CC;
            font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background: linear-gradient(150deg, purple, #3BCE00);
            height: 100vh;
        }
        .login-container {
            margin-top: 100px;
        }
        .login-card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .login-header {
            background-color: #FFFFFF;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            color: black;
            padding: 20px;
            text-align: center;
        }
        .login-form {
            padding: 20px;
        }
        .form-control {
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .btn-login {
            width: 100%;
        height: 50px;
        border: 2px solid;
        background: #6C3483;
        border-radius: 25px;
        font-size: 18px;
        color:white;
        cursor: pointer;
        outline: none;
        }
        .btn-login:hover [type="submit"]:hover {
    border-color: purple;
    transition: .5s;}
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center login-container">
            <div class="col-md-4">
                <div class="card login-card">
                    <div class="card-header login-header">
                        <h4>Inicio de Sesión</h4>
                    </div>
                    <div class="card-body login-form">
                        <?php if (isset($mensaje)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $mensaje ?>
                            </div>
                        <?php } ?>
                        <form action="" method="post">
                            <div class="mb-3">
                                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" />
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" />
                            </div>
                            <button type="submit" class="btn btn-primary btn-login">Iniciar Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
