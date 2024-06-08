<?php
$servidor = "localhost";
$baseDeDatos = "website";
$usuario = "root";
$contraseña = "1020";

try {
    // Conectamos a la base de datos
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos", $usuario, $contraseña);
    // Configuramos PDO para que lance excepciones en caso de errores
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Verificamos si se enviaron datos por el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificamos si se recibieron los datos esperados
        if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["message"])) {
            // Recibimos los datos del formulario
            $nombre = $_POST["name"];
            $email = $_POST["email"];
            $telefono = $_POST["phone"];
            $mensaje = $_POST["message"];

            // Preparamos la consulta SQL para insertar los datos en la base de datos
            $statement = $conexion->prepare("INSERT INTO tbl_cotizaciones (nombre, email, telefono, mensaje) VALUES (:nombre, :email, :telefono, :mensaje)");

            // Ejecutamos la consulta SQL con los datos del formulario
            $statement->execute(array(':nombre' => $nombre, ':email' => $email, ':telefono' => $telefono, ':mensaje' => $mensaje));

            // Redirigimos a una página de éxito o mostramos un mensaje de éxito
            header("Location: exito.php");
            exit();
        } else {
            echo "Por favor, completa todos los campos del formulario.";
        }
    }
} catch (PDOException $error) {
    echo "Error al conectar a la base de datos: " . $error->getMessage();
}
?>
