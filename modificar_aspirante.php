<?php
include "conexion.php";
include_once  "notificaciones.php";

$id = $_GET["id"];
$sql = $conn->query("SELECT * FROM aspirantes WHERE id=$id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Aspirante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<form class="col-4 p-3 m-auto" method="POST" enctype="multipart/form-data">
    <h3 class="text-center text-secondary">Modificar Aspirante</h3>
    <?php if ($data = $sql->fetch_object()) { ?>

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?= $data->nombre ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Apellido</label>
            <input type="text" class="form-control" name="apellido" value="<?= $data->apellido ?>">
        </div>
        <div class="mb-3 col-4">
            <label class="form-label">DNI</label>
            <input type="number" class="form-control" name="dni" value="<?= $data->dni ?>">
        </div>
        <div class="mb-3 col-4">
            <label class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" name="fecha_nacimiento" value="<?= $data->fecha_nacimiento ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Sexo</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sexo" id="masculino" value="Masculino" <?php if ($data->sexo == "Masculino") echo "checked"; ?>>
                <label class="form-check-label" for="masculino">Masculino</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sexo" id="femenino" value="Femenino" <?php if ($data->sexo == "Femenino") echo "checked"; ?>>
                <label class="form-check-label" for="femenino">Femenino</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="sexo" id="otro" value="Otro" <?php if ($data->sexo == "Otro") echo "checked"; ?>>
                <label class="form-check-label" for="otro">Otro</label>
            </div>
        </div>
        <div class="mb-3 col-4">
            <label class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" value="<?= $data->telefono ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="hidden" name="imagen_actual" value="<?= $data->imagen ?>">
            <input class="form-control form-control-sm" type="file" name="imagen">
            <p class="mt-2">Imagen actual:</p>
            <img src="<?= $data->imagen ?>" width="100">
        </div>

    <?php } ?>
    <button type="submit" class="btn btn-primary" name="actualizar" value="ok">Actualizar</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
if (!empty($_POST["actualizar"])) {
    if (!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["dni"]) && !empty($_POST["fecha_nacimiento"]) && !empty($_POST["sexo"]) && !empty($_POST["telefono"])) {

        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $dni = $_POST["dni"];
        $fecha_nacimiento = $_POST["fecha_nacimiento"];
        $sexo = $_POST["sexo"];
        $telefono = $_POST["telefono"];
        $imagen_actual = $_POST["imagen_actual"];

        $imagen = $_FILES["imagen"]["tmp_name"];
        $nombreImagen = $_FILES["imagen"]["name"];
        $extension = strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));
        $tamañoImagen = $_FILES["imagen"]["size"];
        $directorio = "imagenes/";

        
        $rutaImagen = $imagen_actual;

        if (is_uploaded_file($imagen)) {
            
            if (($extension == "jpg" || $extension == "jpeg") && $tamañoImagen <= 512000) {
                $rutaImagen = $directorio . $id . "." . $extension;
                move_uploaded_file($imagen, $rutaImagen);
            } else {
                echo toast('Formato o tamaño de imagen incorrecto. Se mantiene la imagen anterior.', "danger");
            }
        }

        $sql = $conn->query("UPDATE aspirantes 
                             SET nombre='$nombre', apellido='$apellido', dni=$dni, fecha_nacimiento='$fecha_nacimiento', sexo='$sexo', telefono='$telefono', imagen='$rutaImagen'
                             WHERE id='$id'");

        if ($sql) {
            header("Location: index.php");
        } else {
            echo toast('Error al actualizar los datos',"danger");
        }
    } else {
        echo toast('Existen campos vacíos', "warning");
    }
}
?>

