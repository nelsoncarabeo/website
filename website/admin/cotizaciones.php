<?php
session_start();
if (isset($_GET['logout'])) {
    // Destruir la sesión
    session_destroy();
    // Redirigir al usuario a la página de inicio de sesión
    header('Location: login_cotizacion.php');
    exit();
}

// Incluir el archivo db.php para establecer la conexión a la base de datos
include 'C:\xampp\htdocs\website\admin\bd.php';

if (isset($_POST['eliminar'])) {
    $idParaEliminar = $_POST['id']; // Asegúrate de que 'id' es el nombre del campo que contiene el ID de la fila a eliminar

    // Preparar la consulta SQL para eliminar la fila
    $consulta = $conexion->prepare("DELETE FROM datos WHERE id = :id");
    $consulta->bindParam(':id', $idParaEliminar, PDO::PARAM_INT);

    // Ejecutar la consulta
    if ($consulta->execute()) {
        // Redirigir a la misma página para ver los cambios reflejados
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $error_message = "Error al eliminar la fila.";
    }
}

// Consulta SQL para obtener todas las cotizaciones
$sentencia = $conexion->prepare("SELECT * FROM datos");
$sentencia->execute();
$lista_cotizaciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizaciones</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            position: relative; /* Para posicionar el botón de cerrar sesión */
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }

        /* Estilos para el botón de cerrar sesión */
        .logout-btn {
            padding: 10px 20px;
            background-color: #4CAF50; /* Verde */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            position: absolute; /* Posición absoluta */
            top: 20px; /* Espacio desde el top del viewport */
            right: 20px; /* Espacio desde el right del viewport */
            text-decoration: none; /* Quitar subrayado de enlaces */
            transition: background-color 0.3s; /* Transición suave para el color de fondo */
        }

        .logout-btn:hover {
            background-color: #367c39; /* Verde oscuro al pasar el mouse */
        }
    </style>
    </head>
<body>

<!-- Botón de cerrar sesión -->
<a href="?logout=true" class="logout-btn">Cerrar Sesión</a>

<h2>Cotizaciones</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo electrónico</th>
        <th>Teléfono</th>
        <th>Mensaje</th>
        <th>Acción</th>
    </tr>
    <?php foreach($lista_cotizaciones as $cotizacion) { ?>
    <tr>
        <td><?php echo $cotizacion['id']; ?></td>
        <td><?php echo $cotizacion['nombre']; ?></td>
        <td><?php echo $cotizacion['correo']; ?></td>
        <td><?php echo $cotizacion['telefono']; ?></td>
        <td><?php echo $cotizacion['mensaje']; ?></td>
        <td>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="id" value="<?php echo $cotizacion['id']; ?>">
                <input type="submit" name="eliminar" value="Eliminar">
            </form>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
