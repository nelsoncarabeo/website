<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
    //Recuperar los datos del ID correspondiente 
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";

    $sentencia=$conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $usuario=$registro['usuario'];
    $correo=$registro['correo'];
    $password=$registro['password'];
}

if($_POST){
    // Obtener los datos del formulario
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $usuario=(isset($_POST['usuario']))?$_POST['usuario']:"";
    $correo=(isset($_POST['correo']))?$_POST['correo']:"";
    $password=(isset($_POST['password']))?$_POST['password']:"";

    // Preparar la consulta SQL de actualización
    $sentencia=$conexion->prepare("UPDATE tbl_usuarios
    SET usuario=:usuario, correo=:correo, password=:password 
    WHERE id=:id ");
    // Vincular los parámetros
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":id", $txtID);
    // Ejecutar la consulta SQL de actualización
    $sentencia->execute();
    $mensaje="Registro Modificado con Exito.";
    header("Location:index.php?mensaje=".$mensaje);
}
include("../../equipo/header.php");
?>

<div class="card">
    
    <div class="card-header">Usuario</div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input
                    readonly
                    type="text"
                    class="form-control"
                    name="txtID"
                    id="txtID"
                    aria-describedby="helpId"
                    placeholder="ID"
                    value="<?php echo $txtID;?>"
                />
            </div>
            
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del usuario</label>
                <input
                    type="text"
                    class="form-control"
                    name="usuario"
                    id="usuario"
                    aria-describedby="helpId"
                    placeholder="Nombre del usuario"
                    value="<?php echo $usuario;?>"
                />
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    id="password"
                    aria-describedby="helpId"
                    placeholder="Password"
                    value="<?php echo $password;?>"
                />
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input
                    type="email"
                    class="form-control"
                    name="correo"
                    id="correo"
                    aria-describedby="emailHelpId"
                    placeholder="Correo"
                    value="<?php echo $correo;?>"
                />
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>






<?php include("../../equipo/footer.php");?>



<?php include("../../equipo/footer.php");?>
