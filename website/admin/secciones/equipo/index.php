<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
    //borrar dicho registro con el ID correspondiente 
    echo $_GET['txtID'];
    
    $sentencia=$conexion->prepare("DELETE FROM tbl_cotizaciones WHERE id=:id ");
    
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    }
    //Seleccionar registros
$sentencia=$conexion->prepare("SELECT * FROM `tbl_cotizaciones`");
$sentencia->execute();
$lista_cotizaciones=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../equipo/header.php");?>
<div class="card">
    <div class="card-header"> <a
        name=""
        id=""
        class="btn btn-primary"
        href="crear.php"
        role="button"
        >Agregar Registro</a>
    </div>

    <div class="card-body">
    <div
        class="table-responsive-sm"
    >
        <table
            class="table table-primary"
        >
            <thead>
                <tr>
                    <th scope="col">ID </th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email </th>
                    <th scope="col">Telefono </th>
                    <th scope="col">Mensaje </th>

                </tr>
            </thead>
            <tbody>
                    <?php foreach($lista_cotizaciones as $registros){ ?>
                <tr class="">
                    <td><?php echo $registros['ID'];?></td>
                    <td><?php echo $registros['nombre'];?></td>
                    <td><?php echo $registros['email'];?></td>
                    <td><?php echo $registros['telefono'];?></td>
                    <td><?php echo $registros['Mensaje'];?></td>


                    <td>
                        <a
                            name=""
                            id=""
                            class="btn btn-info"
                            href="editar.php?txtID=<?php echo $registros['ID'];?>"
                            role="button"
                            >Editar</a
                        >

                        <a
                            name=""
                            id=""
                            class="btn btn-danger"
                            href="index.php?txtID=<?php echo $registros['ID'];?>"
                            role="button"
                            >Eliminar</a
                        >
                        
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>
</div>


<?php include("../../equipo/footer.php");?>
