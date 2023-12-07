<?php
  include('./php/bd.php');

  $buscar = $_POST['buscar'] ? $_POST['buscar'] : '';

  $consulta = $conexion->prepare("SELECT * FROM `publicacionesUS` WHERE `tituloUS` LIKE '%".$buscar."%' OR `contenidoUS` LIKE '%".$buscar."%'");
  $consulta->execute();
  $lista = $consulta->fetchAll();
  
  if (isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID']) )?$_GET['txtID']:"";

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
  $listaPost = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./assets/img/No-background2.webp" type="image/x-icon">
  <title>Results</title>
  <link rel="stylesheet" href="./assets/estilos/main.css">
  <link rel="stylesheet" href="./assets/estilos/busqueda.css">
</head>
<body>
  <header class="header">
    <div class="header__titulo">
      <div class="header__fondo">
        <h1>Results of "<?php echo $buscar;?>"</h1>
      </div>
    </div>
    <div class="volver">
      <a href="./blog.php"><i class="fa-solid fa-arrow-left"></i>Back</a>
    </div>
  </header>
  <section class="post">
    <div class="posteos">
      <?php if (count($lista) > 0) { ?>
        <?php foreach ($lista as $publicacion) {?>
          <div class="blog__tarjeta" id="Tarjeta">
          <div class="blog__imagen">
            <img src="./assets/post-img/<?php echo $publicacion['nom_imagen'];?>" alt="<?php echo $publicacion['tituloUS'];?>" height="100%" width="100%">
          </div>
          <div class="blog__texto">
            <h3><?php echo $publicacion['tituloUS'];?></h3>
            <p>
              <?php echo $publicacion['resumenUS'];?>
            </p>
          </div>
          <div class="blog__botones" id="Boton">
            <a href="./postUS.php?txtIDUS=<?php echo $publicacion['ID'];?>"><i class="fa-solid fa-arrow-right"></i></a>
          </div>
        </div>
      <?php }?>
    <?php } else { ?>
      <?php echo "<p class='sin__resultado'>We found no results</p>"; ?>
    <?php } ?>
    </div>
    <aside>
      <form class="buscador" method="post" action="./busquedaUS.php">
        <input type="search" name="buscar" id="buscar">
        <button class="buscador-icono" type="submit" name="enviar">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </form>
      <div class="post__ultimos">
        <h4>Latest Posts</h4>
        <?php foreach ($listaPost as $publicacion) { ?>
          <div class="post__ultimos-container">
            <a href="./postUS.php?txtIDUS=<?php echo $publicacion['ID'];?>" class="card">
              <div class="first-content">
                <img src="../assets/post-img/<?php echo $publicacion['nom_imagen'];?>" alt="<?php echo $publicacion['tituloUS']?>">
                <p><?php echo $publicacion['tituloUS']?></p>
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