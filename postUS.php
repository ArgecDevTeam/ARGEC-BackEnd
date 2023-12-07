<?php
  include('./php/bd.php');
    
  if (isset($_GET['txtIDUS'])){
    $txtID = (isset($_GET['txtIDUS']) )?$_GET['txtIDUS']:"";

    $sentencia = $conexion->prepare("SELECT * FROM `publicacionesUS` WHERE ID= :ID");
    $sentencia->bindParam(':ID',$txtID);
    $sentencia->execute();
    $lista = $sentencia->fetch(PDO::FETCH_LAZY);

    $titulo = $lista['tituloUS'];    
    $nombreArchivo = $lista["nom_imagen"];
    $fecha = $lista['fecha'];
    $contenido = $lista["contenidoUS"];
    $resumen = $lista['resumenUS'];  
  }
  
  $sentencia = $conexion->prepare("SELECT * FROM `publicacionesUS` ORDER BY ID DESC LIMIT 3");
  $sentencia->execute();
  $listaPostUS = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./assets/img/No-background2.webp" type="image/x-icon">
  <title><?php echo $titulo;?></title>
  <link rel="stylesheet" href="./assets/estilos/main.css">
  <link rel="stylesheet" href="./assets/estilos/post.css">
</head>
<body>
  <header class="header">
    <div class="header__titulo">
      <div class="header__fondo">
        <h1><?php echo $titulo;?></h1>
      </div>
    </div>
    <div class="volver">
      <a href="./blog.php"><i class="fa-solid fa-arrow-left"></i>Volver</a>
    </div>
  </header>

  <section class="post">
    <div class="posteos">
      <div class="post__imagen">
        <img src="./assets/post-img/<?php echo $nombreArchivo?>" alt="<?php echo $titulo?>">
        <div class="epigrafe">
          <span><?php echo $fecha?></span>
        </div>
      </div>
      <div class="post__contenido">
        <?php echo $contenido;?>
      </div>
    </div>
    <aside>
      <form class="buscador" method="post" action="./busquedaUS.php">
        <input type="search" name="buscar" id="buscar">
        <button class="buscador-icono" type="submit" name="enviar">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </form>
      <div class="post__ultimos">
        <h4>Ultimos Posteos</h4>
        <?php foreach ($listaPostUS as $publicacionUS) { ?>
          <div class="post__ultimos-container">
            <a href="./postUS.php?txtIDUS=<?php echo $publicacionUS['ID'];?>" class="card">
              <div class="first-content">
                <img src="../assets/post-img/<?php echo $publicacionUS['nom_imagen'];?>" alt="<?php echo $publicacion['tituloUS']?>">
                <p><?php echo $publicacionUS['tituloUS']?></p>
              </div>
            </a>
          </div>
        <?php }?>
      </div>
    </aside>
  </section>

  <footer class="footer">
    <img src="./assets/img/argec-header-no-background.webp" alt="ARGEC - IT Consulting" class="footer__logo">
    <div class="footer__redes">
      <a href="https://www.linkedin.com/company/argec-itconsulting/" target="_blank" rel="noopener noreferrer">
        <i class="fa-brands fa-linkedin"></i>
      </a>
      <a href="https://www.instagram.com/argec_itconsulting/" target="_blank" rel="noopener noreferrer">
        <i class="fa-brands fa-instagram"></i>
      </a>
      <a href="https://www.facebook.com/argecitconsulting/" target="_blank" rel="noopener noreferrer">
        <i class="fa-brands fa-facebook"></i>
      </a>
      <a href="mailto:rrhh@argec.net" target="_blank" rel="noopener noreferrer">
        <i class="fa-solid fa-envelope"></i>
      </a>
    </div>
  </footer>

  <script src="https://kit.fontawesome.com/80ad4ec867.js" crossorigin="anonymous"></script>
</body>
</html>