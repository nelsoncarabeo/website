<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
    //Recuperar los datos del ID correspondiente 
    $txtID = isset($_GET['txtID']) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("SELECT * FROM tbl_cotizaciones WHERE ID=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

    $ID = $registro['ID'];
    $Nombre = $registro['Nombre'];
    $Apellido = $registro['Apellido'];
    $Fecha = $registro['Fecha'];
    $Hora = $registro['Hora'];
    $Correo_Electronico = $registro['Correo_Electronico'];
}

if($_POST){
    $Nombre = isset($_POST['nombre']) ? $_POST['nombre'] : "";
    $Apellido = isset($_POST['apellido']) ? $_POST['apellido'] : "";
    $Fecha = isset($_POST['fecha']) ? $_POST['fecha'] : "";
    $Hora = isset($_POST['hora']) ? $_POST['hora'] : "";
    $Correo_Electronico = isset($_POST['correo_electronico']) ? $_POST['correo_electronico'] : "";

    // Utilizamos REPLACE INTO en lugar de INSERT INTO para actualizar el registro existente o insertar uno nuevo
    $sentencia = $conexion->prepare("REPLACE INTO tbl_cotizaciones (ID, Nombre, Apellido, Fecha, Hora, Correo_Electronico) 
                                    VALUES (:ID, :Nombre, :Apellido, :Fecha, :Hora, :Correo_Electronico)");

    // Aquí, usamos el ID recuperado del formulario
    $sentencia->bindParam(":ID", $txtID);
    $sentencia->bindParam(":Nombre", $Nombre);
    $sentencia->bindParam(":Apellido", $Apellido);
    $sentencia->bindParam(":Fecha", $Fecha);
    $sentencia->bindParam(":Hora", $Hora);
    $sentencia->bindParam(":Correo_Electronico", $Correo_Electronico);

    $sentencia->execute();
    $mensaje = "Registro actualizado con éxito.";
    header("Location: index.php?mensaje=".$mensaje);
    exit();
}

include("../../equipo/header.php");
?>

<div class="card">
    <div class="card-header">Editando la información de Cotizaciones</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input value="<?php echo $ID;?>" readonly type="text" class="form-control" name="ID" id="txtID" aria-describedby="helpId" placeholder="ID" />
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input value="<?php echo $Nombre;?>" type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre" />
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido:</label>
                <input value="<?php echo $Apellido;?>" type="text" class="form-control" name="apellido" id="apellido" aria-describedby="helpId" placeholder="Apellido" />
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input value="<?php echo $Fecha;?>" type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Fecha" />
            </div>
            <div class="mb-3">
                <label for="hora" class="form-label">Hora:</label>
                <input value="<?php echo $Hora;?>" type="text" class="form-control" name="hora" id="hora" aria-describedby="helpId" placeholder="Hora" />
            </div>
            <div class="mb-3">
                <label for="correo_electronico" class="form-label">Correo Electrónico:</label>
                <input value="<?php echo $Correo_Electronico;?>" type="email" class="form-control" name="correo_electronico" id="correo_electronico" aria-describedby="helpId" placeholder="Correo Electrónico" />
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
</div>

<?php include("../../equipo/footer.php");?>
