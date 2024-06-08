<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_portafolio WHERE id=:id ");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $titulo=$registro['titulo'];
    $subtitulo=$registro['subtitulo'];
    $imagen=$registro['imagen'];
    $descripcion=$registro['descripcion'];
    $cliente=$registro['cliente'];
    $categoria=$registro['categoria'];
    $url=$registro['url'];

}
if($_POST){

    //Recepcionamos los valores del formulario
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $titulo=(isset($_POST['titulo']))?$_POST['titulo']:"";
    $subtitulo=(isset($_POST['subtitulo']))?$_POST['subtitulo']:"";    
    $descripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    $cliente=(isset($_POST['cliente']))?$_POST['cliente']:"";
    $categoria=(isset($_POST['categoria']))?$_POST['categoria']:"";
    $url=(isset($_POST['url']))?$_POST['url']:"";

    $sentencia=$conexion->prepare("UPDATE tbl_portafolio
    SET 
    titulo=:titulo, 
    subtitulo=:subtitulo, 
    descripcion=:descripcion,
    cliente=:cliente, 
    categoria=:categoria,
    url=:url
    WHERE id=:id ");

    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":subtitulo", $subtitulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":cliente", $cliente);

    $sentencia->bindParam(":categoria", $categoria);
    $sentencia->bindParam(":url", $url);

    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    if($_FILES["imagen"]["tmp_name"]!=""){
        $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES[ "imagen" ][ "name" ]:"";

        $fecha_imagen=new DateTime();
        $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen :"";
        $tmp_imagen=$_FILES["imagen"]["tmp_name"];

        move_uploaded_file($tmp_imagen, "../../../assets/img/portfolio/".$nombre_archivo_imagen);

// Borrado del archivo jpg
$sentencia=$conexion->prepare("SELECT imagen FROM tbl_portafolio WHERE id=:id ");
$sentencia->bindParam(":id", $txtID);
$sentencia->execute();
$registro_imagen=$sentencia->fetch(PDO::FETCH_ASSOC); // Utiliza FETCH_ASSOC en lugar de FETCH_LAZY para obtener un array asociativo

if(isset($registro_imagen["imagen"])){
    if(file_exists("../../../assets/img/portfolio/".$registro_imagen["imagen"])){
        unlink("../../../assets/img/portfolio/".$registro_imagen["imagen"]);
    }
}

        
    $sentencia=$conexion->prepare("UPDATE tbl_portafolio SET imagen=:imagen WHERE id=:id ");
    $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    }
    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen=($imagen!="")? $fecha_imagen->getTimestamp()."_".$imagen :"";
    $tmp_imagen=$_FILES["imagen"]["tmp_name"];
    if($tmp_imagen!=""){
        move_uploaded_file($tmp_imagen, "../../../assets/img/portfolio/".$nombre_archivo_imagen);
    }
    $mensaje="Registro Agregado con Exito.";
    header("Location:index.php?mensaje=".$mensaje);
}

include("../../equipo/header.php");?>

<div class="card">
    <div class="card-header">Producto del portafolio</div>
    <div class="card-body">
    <form action="" enctype="multipart/form-data" method="post">

    <div class="mb-3">
        <label for="" class="form-label">ID</label>
        <input
            type="text"
            class="form-control"
            readonly
            name="txtID"
            id="txtID"
            value="<?php echo $txtID;?>"
            aria-describedby="helpId"
            placeholder=""      
        />
    </div>
    



    <div class="mb-3">
    <label for="" class="form-label">Título:</label>
    <input
        type="text"
        class="form-control"
        value="<?php echo $titulo;?>"
        name="titulo"
        id="titulo"
        aria-describedby="helpId"
        placeholder="Título"
    />
</div>
<div class="mb-3">
    <label for="subtitulo" class="form-label">Subtitulo:</label>
    <input
        type="text"
        class="form-control"
        value="<?php echo $subtitulo;?>"
        name="subtitulo"
        id="subtitulo"
        aria-describedby="helpId"
        placeholder="Subtitulo"
    />
</div>

<div class="mb-3">
    <label for="imagen" class="form-label">Imagen:</label>
    <?php if (!empty($imagen)) : ?>
        <img src="../../../assets/img/portfolio/<?php echo $imagen; ?>" alt="Imagen" width="75px" height="100px">
    <?php else : ?>
        <p>No hay imagen seleccionada.</p>
    <?php endif; ?>
    <input
        type="file"
        class="form-control"
        name="imagen"
        id="imagen"
        placeholder="Imagen"
        aria-describedby="fileHelpId"
    />
</div>


<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción:</label>
    <input
        type="text"
        class="form-control"
        value="<?php echo $descripcion;?>"
        name="descripcion"
        id="descripcion"
        aria-describedby="helpId"
        placeholder="Descripcion"
    />
</div>

<div class="mb-3">
    <label for="cliente" class="form-label">Cliente:</label>
    <input
        type="text"
        class="form-control"
        value="<?php echo $cliente;?>"
        name="cliente"
        id="cliente"
        aria-describedby="helpId"
        placeholder="Cliente"
    />
</div>
<div class="mb-3">
    <label for="categoría" class="form-label">Categoría:</label>
    <input
        type="text"
        class="form-control"
        value="<?php echo $categoria;?>"
        name="categoria"
        id="categoría"
        aria-describedby="helpId"
        placeholder="Categoría"
    />
</div>

<div class="mb-3">
    <label for="url" class="form-label">URL:</label>
    <input
        type="text"
        class="form-control"
        value="<?php echo $url;?>"
        name="url"
        id="url"
        aria-describedby="helpId"
        placeholder="URL del proyecto"
    />
</div>

<button type="submit" class="btn btn-success">Actualizar</button>
<a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

</form>


</div>
</div>




<?php include("../../equipo/footer.php");?>
