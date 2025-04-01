<?php 
include "conexion.php";
include "validaciones.php";
include_once "notificaciones.php";

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

        $errores = [];
        if(!validar_str($nombre)){
            $errores[] = 'Error: Nombre invalido';
        }if (!validar_str($apellido)){
            $errores[] = 'Error: Apellido invalido';
        }if (!validar_dni($dni)){
            $errores[] = 'Error: DNI invalido';
        }if(!validar_tel($telefono)){
            $errores[] = 'Error: telefono invalido';
        }if(!validar_fechaNac($fecha_nacimiento)){
            $errores[] = 'Error: fecha de nacimiento invalida';
        }if (!empty($errores)) {
            foreach ($errores as $error) {
                echo toast($error, "danger");
            }
        }else{
                $sql=$conn->query(" insert into aspirantes(nombre, apellido, dni, fecha_nacimiento, sexo, telefono, imagen) values('$nombre', '$apellido', $dni, '$fecha_nacimiento', '$sexo', '$telefono','')");
                

                if ($sql) {
                    $id = $conn->insert_id;

                    
                    if (!is_uploaded_file($imagen)) {
                        $ruta = $directorio . "defaultimg.jpg";
                        $conn->query("UPDATE aspirantes SET imagen='$ruta' WHERE id='$id'");
                        echo toast('Aspirante registrado correctamente', "success");
                    } else {
                        
                        if (($extension == "jpg" || $extension == "jpeg") && $tamañoImagen <= 512000) {
                            $ruta = $directorio . $id . "." . $extension;
                            if (move_uploaded_file($imagen, $ruta)) {
                                $conn->query("UPDATE aspirantes SET imagen='$ruta' WHERE id='$id'");
                                echo toast('Aspirante registrado correctamente', "success");
                            } else {
                                echo toast('Error al mover la imagen', "danger");
                            }
                        } else {
                            
                            $ruta = $directorio . "defaultimg.jpg";
                            $conn->query("UPDATE aspirantes SET imagen='$ruta' WHERE id='$id'");
                            echo toast('Formato o tamaño de imagen incorrecto. Se asignó imagen predeterminada', "warning");
                        }
                    }
                } else {
                    echo toast('Error al registrar aspirante', "danger");
                }
            }
            } else {
                echo toast('Existen campos vacíos', "danger");
            }
    ?>

<script>
    history.replaceState(null,null,location.pathname)
</script>

<?php } ?> 



