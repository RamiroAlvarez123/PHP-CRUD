<?php
 session_start();
 include "conexion.php";
 include_once "validaciones.php";
    if(!empty($_POST["registrar"])){
        if(!empty($_POST["usuario"]) && !empty($_POST["password"]) && !empty($_POST["privilegio"])){
            $usuario = $_POST["usuario"];
            $password = $_POST["password"];
            $privilegio = $_POST["privilegio"];

            $error = '';
            if(strlen($password) < 8){
                $error = 'la contraseña debe tener mas de 8 caracteres';
            }if(!validar_usuario($usuario)){
              $error = 'el usuario ya se encuentra registrado';
            }if(!$error){
            $sql = $conn->prepare("insert into usuarios (usuario, password, privilegio) values(?,?,?)");
            $sql->bind_param("sss", $usuario, $password, $privilegio);
            $sql->execute();

            if($sql){
              header('Location: login_usuario.php');
              exit();

            }else{ $error = 'el usuario o contraseña son incorrectos';}
        }
        }else { $error = 'existen campos vacios';}
    }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<form class="vh-100 gradient-custom" method="POST">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">sistema aspirantes</h2>
              <p class="text-white-50 mb-5">Registra tu usuario y contraseña</p>

              <div data-mdb-input-init class="form-outline form-white mb-4">
                <input type="text" class="form-control form-control-lg" name="usuario"/>
                <label class="form-label" for="typeEmailX">Usuario</label>
              </div>

              <div data-mdb-input-init class="form-outline form-white mb-4">
                <input type="password" class="form-control form-control-lg" name="password"/>
                <label class="form-label" for="typePasswordX">Contraseña</label>
              </div>
            
              <div class="col">
              <div data-mdb-input-init class="form-outline form-white mb-4">
                     <select class="form-select" aria-label="Default select example" name="privilegio">
                        <option value="visualizar">Visualizar</option>
                        <option value="cargar">Cargar</option>
                        <option value="editar-eliminar">editar-eliminar</option>
                    </select>
                    <label class="form-label" >Privilegios</label>
                    </div>
                </div> 

              <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit" name="registrar" value="ok">Registrar</button>
              <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

 <script src="https://kit.fontawesome.com/67c88b53b0.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>