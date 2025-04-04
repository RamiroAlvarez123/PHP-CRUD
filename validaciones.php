<?php
function validar_str($str_field){
    return strlen($str_field) >= 2 && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $str_field);
}
function validar_dni($dni){
    include "conexion.php";

    $sql = $conn->query("select id,dni from aspirantes where dni='$dni'");

    return is_numeric($dni) && strlen($dni) >= 8 && strlen($dni) <=11 && !$sql->fetch_object();
}
function validar_dni_upd($dni, $id){
    include "conexion.php";

    $sql = $conn->query("select id,dni from aspirantes where dni='$dni'");
    if($row = $sql->fetch_assoc()){
        $sql_id = $row['id'];
        if($id == $sql_id){
            return true;
        }else{
            return false;
        }

    }

    return is_numeric($dni) && strlen($dni) >= 8 && strlen($dni) <=11;

}
function validar_tel($telefono){
    return preg_match('/^\d{7,15}$/', $telefono);
}
function validar_fechaNac($fecha) {
     $timestampFecha = strtotime($fecha);
     $timestampHoy = strtotime(date("Y-m-d"));
     return $timestampFecha !== false && $timestampFecha <= $timestampHoy;
}

function validar_usuario($usuario){
    include "conexion.php";
    $sql = $conn->query("select usuario from usuarios where usuario='$usuario'");

    return !$sql->fetch_object();
}
?>