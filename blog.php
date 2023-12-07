<?php
  include('./php/bd.php');
  
  // Tabla de datos en Español
  $sentencia = $conexion->prepare("SELECT * FROM `publicaciones` ORDER BY ID DESC");
  $sentencia->execute();
  $listaPost = $sentencia->fetchAll(PDO::FETCH_ASSOC);

  // Tabla de datos en Ingles
  $sentenciaUS = $conexion->prepare("SELECT * FROM `publicacionesUS` ORDER BY ID DESC");
  $sentenciaUS->execute();
  $listaPostUS = $sentenciaUS->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../assets/img/No-background2.webp" type="image/x-icon">
  <title>ARGEC - IT Consulting </title>
  <link rel="stylesheet" href="./assets/estilos/main.css">
  <link rel="stylesheet" href="./assets/estilos/blog.css">
</head>
<body>
  <header class="header">
    <div class="header__titulo">
      <div class="header__fondo">
        <h1>Blog</h1>
      </div>
    </div>
    <div class="volver">
      <a href="/">
        <i class="fa-solid fa-arrow-left"></i>
        Volver
      </a>
    </div>
    <div class="lang-menu">
    </div>
  </header>

  <section class="blog" id="spanish">
    <div class="blog__contenedor">
      <?php foreach ($listaPost as $publicacion) { ?>
        <div class="blog__tarjeta" id="Tarjeta">
          <div class="blog__imagen">
            <img src="./assets/post-img/<?php echo $publicacion['nom_imagen'];?>" alt="<?php echo $publicacion['titulo'];?>" height="100%" width="100%">
          </div>
          <div class="blog__texto">
            <h3><?php echo $publicacion['titulo'];?></h3>
            <p>
              <?php echo $publicacion['resumen'];?>
            </p>
          </div>
          <div class="blog__botones" id="Boton">
            <a href="./post.php?txtID=<?php echo $publicacion['ID'];?>"><i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>
      <?php }?>
    </div>
  </section>

  <section class="blog" id="english">
    <div class="blog__contenedor">
      <?php foreach ($listaPostUS as $publicacionUS) { ?>
        <div class="blog__tarjeta" id="Tarjeta">
          <div class="blog__imagen">
            <img src="./assets/post-img/<?php echo $publicacionUS['nom_imagen'];?>" alt="<?php echo $publicacionUS['tituloUS'];?>" height="100%" width="100%">
          </div>
          <div class="blog__texto">
            <h3><?php echo $publicacionUS['tituloUS'];?></h3>
            <p>
              <?php echo $publicacionUS['resumenUS'];?>
            </p>
          </div>
          <div class="blog__botones" id="Boton">
            <a href="./postUS.php?txtIDUS=<?php echo $publicacionUS['ID'];?>"><i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>
      <?php }?>
    </div>
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

  <!-- Scripts -->
  <script src="https://kit.fontawesome.com/80ad4ec867.js" crossorigin="anonymous"></script>
  <script src="./assets/scripts/lang.js"></script>
</body>
</html>