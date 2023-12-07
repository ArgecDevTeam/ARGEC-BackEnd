<?php
  include('../../php/bd.php');

  if (isset($_GET['txtID'])){
    // Borrar registros con el ID correspondiente
    $txtID = (isset($_GET['txtID']) )?$_GET['txtID']:"";

    $sentencia = $conexion->prepare("SELECT nom_imagen FROM publicaciones WHERE ID = :ID");
    $sentencia->bindParam(':ID',$txtID);
    $sentencia->execute();
    $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen['nom_imagen'])){
      if (file_exists('../../assets/post-img/'.$registro_imagen['nom_imagen'])){
        unlink('../../assets/post-img/'.$registro_imagen['nom_imagen']);
      }
    }

    $sentencia = $conexion->prepare("DELETE FROM publicaciones WHERE ID = :ID");
    $sentencia->bindParam(':ID',$txtID);
    $sentencia->execute();
  }

  // Seleccionar registros
  $sentencia = $conexion->prepare("SELECT * FROM `publicaciones`");
  $sentencia->execute();
  $listaPost = $sentencia->fetchAll(PDO::FETCH_ASSOC);

  if (isset($_GET['txtIDUS'])){
    // Borrar registros con el ID correspondiente
    $txtIDUs = (isset($_GET['txtIDUS']) )?$_GET['txtIDUS']:"";

    $sentenciaUS = $conexion->prepare("SELECT nom_imagen FROM publicacionesUS WHERE ID = :ID");
    $sentenciaUS->bindParam(':ID',$txtIDUs);
    $sentenciaUS->execute();
    $registro_imagenUS = $sentenciaUS->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagenUS['nom_imagen'])){
      if (file_exists('../../assets/post-img/'.$registro_imagenUS['nom_imagen'])){
        unlink('../../assets/post-img/'.$registro_imagenUS['nom_imagen']);
      }
    }

    $sentenciaUS = $conexion->prepare("DELETE FROM publicacionesUS WHERE ID = :ID");
    $sentenciaUS->bindParam(':ID',$txtIDUs);
    $sentenciaUS->execute();
  }

  // Seleccionar registros
  $sentenciaUS = $conexion->prepare("SELECT * FROM `publicacionesUS`");
  $sentenciaUS->execute();
  $listaPostUS = $sentenciaUS->fetchAll(PDO::FETCH_ASSOC);


  session_start();
  if (!isset($_SESSION['usuario'])){
    header("Location:../login/login.php");
  }

?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../../assets/img/No-background2.ico" type="image/x-icon">
  <title>Dashboard - ARGEC</title>
  <link rel="stylesheet" href="../../assets/estilos/main.css">
  <link rel="stylesheet" href="../../assets/estilos/dashboard.css">
</head>
<body>
  <header class="header__dashboard">
    <div class="header__dashboard-titulo">
      <img src="../../assets/img/No-background2.webp" alt="" height="100%">
      <a href="./index.php">Dashboard - ARGEC</a>
    </div>
    <div class="header__dashboard-logout">
      <a href="../../php/cerrar.php">Cerrar Sesión<i class="fa-solid fa-right-from-bracket"></i></a>
    </div>
  </header>

  <section class="dashboard spanish">
    <div class="dashboard__contenido">
      <h2>Publicaciones en Español</h2>
      <a href="./agregar.php"><i class="fa-solid fa-plus"></i>Agregar Publicacion</a>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th style="width: 500px;">Titulo</th>
          <th>Imagen</th>
          <th>Fecha</th>
          <th>-</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($listaPost as $publicacion) { ?>
          <tr>
            <td><?php echo $publicacion['ID'];?></td>
            <td><?php echo $publicacion['titulo'];?></td>
            <td><img src="../../assets/post-img/<?php echo $publicacion['nom_imagen'];?>" width="50px" alt="Imagen"></td>
            <td><?php echo $publicacion['fecha'];?></td>
            <td>
              <a href="index.php?txtID=<?php echo $publicacion['ID'];?>"><i class="fa-solid fa-trash"></i></a>|<a href="editar.php?txtID=<?php echo $publicacion['ID'];?>"><i class="fa-solid fa-file-pen"></i></a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </section>

  <section class="dashboard english">
    <div class="dashboard__contenido">
      <h2>English posts</h2>
      <a href="./agregarUS.php"><i class="fa-solid fa-plus"></i>Add post</a>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th style="width: 500px;">Title</th>
          <th>Image</th>
          <th>Date</th>
          <th>-</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($listaPostUS as $publicacionUS) { ?>
          <tr>
            <td><?php echo $publicacionUS['ID'];?></td>
            <td><?php echo $publicacionUS['tituloUS'];?></td>
            <td><img src="../../assets/post-img/<?php echo $publicacionUS['nom_imagen'];?>" width="50px" alt="Imagen"></td>
            <td><?php echo $publicacionUS['fecha'];?></td>
            <td>
              <a href="index.php?txtIDUS=<?php echo $publicacionUS['ID'];?>"><i class="fa-solid fa-trash"></i></a>|<a href="editarUS.php?txtID=<?php echo $publicacionUS['ID'];?>"><i class="fa-solid fa-file-pen"></i></a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </section>

  <script src="https://kit.fontawesome.com/80ad4ec867.js" crossorigin="anonymous"></script>
</body>
</html>