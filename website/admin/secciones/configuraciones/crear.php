
<?php 
include("../../bd.php");

if($_POST){
    //Recepcionamos los valores del formulario
    $nombreconfiguracion=(isset($_POST['nombreconfiguracion']))?$_POST['nombreconfiguracion']:"";
    $valor=(isset($_POST['valor']))?$_POST['valor']:"";

    $sentencia=$conexion->prepare("INSERT INTO`tbl_configuraciones`(`ID`,`nombreconfiguracion`,`valor`) 
    VALUES (NULL, :nombreconfiguracion, :valor);");

$sentencia->bindParam(":nombreconfiguracion",$nombreconfiguracion);
$sentencia->bindParam(":valor",$valor);

$sentencia->execute();
$mensaje="Registro Agregado con Exito.";
header("Location:index.php?mensaje=".$mensaje);
}

include("../../equipo/header.php");?>

<div class="card">
    <div class="card-header">Configuración</div>
    <div class="card-body">
    <form action="" method="post">

    <div class="mb-3">
        <label for="nombreconfiguracion" class="form-label">Nombre:</label>
        <input
            type="text"
            class="form-control"
            name="nombreconfiguracion"
            id="nombreconfiguracion"
            aria-describedby="helpId"
            placeholder="Nombre de la configuracion"
        />
    </div>
    <div class="mb-3">
        <label for="valor" class="form-label">Valor:</label>
        <input
            type="text"
            class="form-control"
            name="valor"
            id="valor"
            aria-describedby="helpId"
            placeholder="Valor de la configuracion"
        />
    </div>
    <button type="submit" class="btn btn-success">Agregar</button>
<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

    
    </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php include("../../equipo/footer.php");?>


