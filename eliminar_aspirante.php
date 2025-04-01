<?php
include "conexion.php";
include_once  "notificaciones.php";

if(!empty($_GET["id"])) {
    $id=$_GET["id"];
    $sql=$conn->query("delete from aspirantes where id='$id'");
    if($sql==1){
        echo toast('aspirante eliminado', "success");
    }else{
        echo toast('error al eliminar aspirante', "danger");
    }
}
?>