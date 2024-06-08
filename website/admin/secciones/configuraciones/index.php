<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
    // Borrar el registro con el ID correspondiente
    $txtID = isset($_GET['txtID']) ? $_GET['txtID'] : "";
    
    $sentencia = $conexion->prepare("DELETE FROM tbl_configuraciones WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    // Redirigir al usuario de vuelta a la página principal
    header("Location: index.php");
    exit();
}

// Seleccionar registros
$sentencia = $conexion->prepare("SELECT * FROM `tbl_configuraciones`");
$sentencia->execute();
$lista_configuraciones = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../equipo/header.php");
?>

<div class="card">
    <div class="card-header">
        <a class="btn btn-primary" href="crear.php" role="button">Agregar Registro</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre de la configuración</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_configuraciones as $registro){ ?>
                        <tr>
                            <td><?php echo $registro['ID']; ?></td>
                            <td><?php echo $registro['nombreconfiguracion']; ?></td>
                            <td><?php echo $registro['valor']; ?></td>
                            <td>
                                <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['ID'];?>" role="button">Editar</a>
                                <a class="btn btn-danger" href="index.php?txtID=<?php echo $registro['ID'];?>" role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../equipo/footer.php");?>
