<?php 
include("../../bd.php");

if($_POST){
    // Recuperar los datos del formulario
    $Nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
    $Apellido = isset($_POST['apellido']) ? $_POST['apellido'] : "";
    $Fecha = isset($_POST['fecha']) ? $_POST['fecha'] : "";
    $Hora = isset($_POST['hora']) ? $_POST['hora'] : "";
    $Correo_Electronico = isset($_POST['correo_electronico']) ? $_POST['correo_electronico'] : "";

    // Preparar la consulta para insertar los datos en la base de datos
    $sentencia = $conexion->prepare("INSERT INTO `tbl_cotizaciones` (`Nombre`, `Apellido`, `Fecha`, `Hora`, `Correo_Electronico`) VALUES (:Nombre, :Apellido, :Fecha, :Hora, :Correo_Electronico)");

    // Bind parameters
    $sentencia->bindParam(":Nombre", $Nombre);
    $sentencia->bindParam(":Apellido", $Apellido);
    $sentencia->bindParam(":Fecha", $Fecha);
    $sentencia->bindParam(":Hora", $Hora);
    $sentencia->bindParam(":Correo_Electronico", $Correo_Electronico);

    // Ejecutar la consulta
    $sentencia->execute();

    // Redirigir con mensaje de éxito
    $mensaje = "Registro agregado con éxito.";
    header("Location: index.php?mensaje=" . $mensaje);
    exit();
}

include("../../equipo/header.php");
?>
<div class="card">
    <div class="card-header">Crear Cotización</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre" />
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido:</label>
                <input type="text" class="form-control" name="apellido" id="apellido" aria-describedby="helpId" placeholder="Apellido" />
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Fecha" />
            </div>
            <div class="mb-3">
                <label for="hora" class="form-label">Hora:</label>
                <input type="text" class="form-control" name="hora" id="hora" aria-describedby="helpId" placeholder="Hora" />
            </div>
            <div class="mb-3">
                <label for="correo_electronico" class="form-label">Correo Electrónico:</label>
                <input type="email" class="form-control" name="correo_electronico" id="correo_electronico" aria-describedby="helpId" placeholder="Correo Electrónico" />
            </div>
            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
</div>

<?php include("../../equipo/footer.php");?>
