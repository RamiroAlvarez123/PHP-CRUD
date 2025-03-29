<?php 
include "conexion.php";

if (!empty($_POST["cargar"])){
    if(!empty($_POST["nombre"]) && !empty($_POST["apellido"]) && !empty($_POST["dni"]) && !empty($_POST["fecha_nacimiento"]) && !empty($_POST["sexo"]) && !empty($_POST["telefono"])){
        
        $nombre=$_POST["nombre"];
        $apellido=$_POST["apellido"];
        $dni=$_POST["dni"];
        $fecha_nacimiento=$_POST["fecha_nacimiento"];
        $sexo=$_POST["sexo"];
        $telefono=$_POST["telefono"];

        $imagen=$_FILES["imagen"]["tmp_name"];
        $nombreImagen=$_FILES["imagen"]["name"];
        $extension=strtolower(pathinfo($nombreImagen, PATHINFO_EXTENSION));
        $tamañoImagen=$_FILES["imagen"]["size"];
        $directorio="imagenes/";

        $sql=$conn->query(" insert into aspirantes(nombre, apellido, dni, fecha_nacimiento, sexo, telefono, imagen) values('$nombre', '$apellido', $dni, '$fecha_nacimiento', '$sexo', '$telefono','')");
        

        if ($sql) {
            $id = $conn->insert_id;

            
            if (!is_uploaded_file($imagen)) {
                $ruta = $directorio . "defaultimg.jpg";
                $conn->query("UPDATE aspirantes SET imagen='$ruta' WHERE id='$id'");
                echo '<div class="alert alert-success">Aspirante registrado con imagen predeterminada</div>';

            } else {
                
                if (($extension == "jpg" || $extension == "jpeg") && $tamañoImagen <= 512000) {
                    $ruta = $directorio . $id . "." . $extension;
                    if (move_uploaded_file($imagen, $ruta)) {
                        $conn->query("UPDATE aspirantes SET imagen='$ruta' WHERE id='$id'");
                        echo '<div class="alert alert-success">Aspirante registrado correctamente con imagen</div>';
                    } else {
                        echo '<div class="alert alert-warning">Error al mover la imagen</div>';
                    }
                } else {
                    
                    $ruta = $directorio . "defaultimg.jpg";
                    $conn->query("UPDATE aspirantes SET imagen='$ruta' WHERE id='$id'");
                    echo '<div class="alert alert-warning">Formato o tamaño de imagen incorrecto. Se asignó imagen predeterminada</div>';
                }
            }
        } else {
            echo '<div class="alert alert-warning">Error al registrar aspirante</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Existen campos vacíos</div>';
    }
    ?>

<script>
    history.replaceState(null,null,location.pathname)
</script>

<?php } ?> 



