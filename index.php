<?php

session_start();
if(!isset($_SESSION['id'])){
    header('Location: login_usuario.php');
    exit;
}else{
    $privilegio = $_SESSION['privilegio'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body>
<ul class="nav justify-content-end">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="cerrar_sesion.php">Cerrar Sesion</a>
  </li>
</ul>
<div class="container-fluid">
    <div class="row">
    <?php
    include "conexion.php";
     include "eliminar_aspirante.php";

    ?>
    <?php if($privilegio == "cargar" || $privilegio == "editar-eliminar"): ?>

        <div class="col-md-4">
            <form method="POST" enctype="multipart/form-data">
                <h3 class="text-center text-secondary">Registro de Aspirantes</h3>
               <?php
                include "crear_aspirante.php";
                ?>

            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Nombre" name="nombre" aria-label="First name">
                </div>

                <div class="col">
                    <input type="text" class="form-control" placeholder="Apellido" name="apellido"aria-label="Last name">
                </div>
            </div>
            
                

          <div class="row mb-3">
                

                <div class="col">
                    <input type="text" class="form-control" placeholder="DNI" name="dni" aria-label="Last name">
                </div>

                <div class="col">

                    <input type="text" class="form-control" placeholder="telefono" name="telefono" aria-label="Last name">
                </div>
             </div>
             <div class="col-4">
                    <label class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" name="fecha_nacimiento">
                </div>
                <div class="col">
                    <label class="form-label">Sexo</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" id="masculino" value="Masculino">
                        <label class="form-check-label" for="masculino">Masculino</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" id="femenino" value="Femenino">
                        <label class="form-check-label" for="femenino">Femenino</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" id="otro" value="Otro">
                        <label class="form-check-label" for="otro">Otro</label>
                    </div>
                </div> 
                <div class="mb-3">
                    <label class="form-label">Imagen(opcional)</label>
                    <input class="form-control form-control-sm" type="file" name="imagen" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary" name="cargar" value="ok">Cargar</button>
            </form>
        </div>
        <?php endif; ?>

        <div class="col-md-8 p-4">
            <table class="table" id="myTable">
                <thead class="bg-info">
                    <tr>
                        <!--<th scope="col">ID</th>-->   
                        <th scope="col">Foto</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">DNI</th>
                        <th scope="col">Fecha de Nacimiento</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Telefono</th>
                        <?php if($privilegio == "editar-eliminar"){echo '<th scope="col">funciones</th>';} ?>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                    include "conexion.php";
                    $sql = $conn->query("select * from aspirantes");

                    while($data = $sql->fetch_object()){ ?>               

                    <tr>
                        <!--<td><?//=$data->id ?>--> 
                        <td><img width="80" src="<?=$data->imagen?>" alt=""></td>                                           
                        <td><?= $data->nombre ?></td>
                        <td><?= $data->apellido ?></td>
                        <td><?= $data->dni ?></td>
                        <td><?= $data->fecha_nacimiento ?></td>
                        <td><?= $data->sexo ?></td>
                        <td><?= $data->telefono ?></td>
                        
                            
                        <?php if($privilegio == "editar-eliminar"): ?>
                            <td>
                                <a href="modificar_aspirante.php?id=<?= $data->id ?>" class="btn btn-small btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="index.php?id=<?= $data->id ?>" class="btn btn-small btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        <?php endif; ?>
                            
                            
                    </tr>

                    <?php } 
                    ?>
                    

                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/67c88b53b0.js" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

</body>
</html>