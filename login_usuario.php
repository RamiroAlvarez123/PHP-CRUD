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
              <p class="text-white-50 mb-5">Ingresa tu usuario y contraseña!</p>

              <div data-mdb-input-init class="form-outline form-white mb-4">
                <input type="text" class="form-control form-control-lg" name="usuario"/>
                <label class="form-label" for="typeEmailX">Usuario</label>
              </div>

              <div data-mdb-input-init class="form-outline form-white mb-4">
                <input type="password" class="form-control form-control-lg" name="password"/>
                <label class="form-label" for="typePasswordX">Contraseña</label>
              </div>

              <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit" name="ingresar" value="ok">Ingresar</button>


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
 <?php
 session_start();
 include "conexion.php";
    if(!empty($_POST["ingresar"])){
        if(!empty($_POST["usuario"]) && !empty($_POST["password"])){
            $usuario = $_POST["usuario"];
            $password = $_POST["password"];

            $sql = $conn->prepare("select * from usuarios where usuario = ? and password = ?");
            $sql->bind_param("ss", $usuario, $password);
            $sql->execute();
            $result = $sql->get_result();

            if($data = $result->fetch_assoc()){

              $_SESSION['id'] = $data["id"];
              $_SESSION['usuario'] = $data["usuario"];
              $_SESSION['privilegio'] = $data["privilegio"];
              header('Location: index.php');
              exit();

            }else{ echo 'el usuario o contraseña son incorrectos';}
        }else {echo 'campo vacio';}
    }
 ?>