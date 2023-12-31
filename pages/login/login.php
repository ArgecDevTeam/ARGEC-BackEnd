<?php 
  session_start();
  if (!isset($_SESSION['intentos'])) {
    $_SESSION['intentos'] = 0; // Inicializa el contador de intentos
  }

  $maximoIntentos = 3;

  if ($_POST){
    include('../../php/bd.php');
    $usuario = (isset($_POST['usuario'])) ?$_POST['usuario'] : '';
    $password = (isset($_POST['password'])) ?$_POST['password'] : '';
    
    // Seleccionar registros
    $sentencia = $conexion->prepare("SELECT *, count(*) as usuario FROM `admin` 
    WHERE usuario = :usuario
    AND password= :password
    ");
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->execute();
    $listaUser = $sentencia->fetch(PDO::FETCH_LAZY);

    if ($listaUser['usuario'] === $usuario and $listaUser['password'] === $password){

      $_SESSION['usuario'] = $listaUser['usuario'];
      $_SESSION['logueado'] = true;
      header("Location: ../admin/index.php");
      exit();
    }else {
      // Usuario o contraseña incorrectos, incrementa el contador de intentos
      $_SESSION['intentos']++;
      
      $mensaje = 'ERROR: Usuario o contraseña incorrectos';
      // Si se excede el número máximo de intentos, redirige a otra página
      if ($_SESSION['intentos'] >= $maximoIntentos) {
        header('Location: ../../index.html');
        exit();
      }
    }

  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../../assets/img/No-background2.ico" type="image/x-icon">
  <title>ARGEC - IT Consulting</title>
  <link rel="stylesheet" href="../../assets/estilos/main.css">
  <link rel="stylesheet" href="../../assets/estilos/login.css">
</head>
<body>
  <?php if (isset($mensaje)) {?>
    <div class="alerta">
      <strong><?php echo $mensaje?></strong>
    </div>
  <?php }?>
  <section class="login">
    <div class="imagen">
      <img src="../../assets/img/argec-header-no-background.webp" alt="Logo ARGEC-It Consulting" width="100%">
    </div>
    <div class="login__contenedor">
      <h1>Login</h1>
      <form class="loginForm" action="" method="post">
        <div class="input-group">
          <input type="text" id="usuario" name="usuario" placeholder="Usuario">
        </div>
        <div class="input-group">
          <input type="password" id="password" name="password" placeholder="Contraseña">
          <i class="fa-regular fa-eye mostrar"></i>
        </div>
        <input class="btn__login" type="submit" value="Iniciar Sesion">
      </form>
    </div>
  </section>

  <script src="https://kit.fontawesome.com/80ad4ec867.js" crossorigin="anonymous"></script>
  <script src="../../assets/scripts/login.js"></script>
</body>
</html>