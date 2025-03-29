<?php
include "conexion.php";
if(!empty($_GET["id"])) {
    $id=$_GET["id"];
    $sql=$conn->query("delete from aspirantes where id='$id'");
    if($sql==1){
        echo '<div class="alert alert-success">aspirante eliminado</div>';
    }else{echo '<div class="alert alert-danger>error al eliminar aspirante</div>';}
}
?>