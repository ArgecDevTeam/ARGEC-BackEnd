<?php
  include('../../php/bd.php');
  
  if ($_POST) {
    $titulo = (isset($_POST['tituloUS']))?$_POST['tituloUS']:"";
    $nombreArchivo = (isset($_FILES["imagen"]["name"])) ?$_FILES["imagen"]["name"]:"";
    $fecha = (isset($_POST['fecha']))?$_POST['fecha']:"";
    $contenido = (isset($_POST['contenidoUS']))?$_POST['contenidoUS']:"";
    $resumen = (isset($_POST['resumenUS']))?$_POST['resumenUS']:"";

    $fechaImagen = new DateTime();
    $nom_archivo_imagen = ($nombreArchivo!="")?$fechaImagen->getTimestamp()."_".$nombreArchivo:"";

    $tmp_imagen = $_FILES["imagen"]["tmp_name"];
    if($tmp_imagen!=""){
      move_uploaded_file($tmp_imagen,"../../assets/post-img/".$nom_archivo_imagen);
    }

    $sentencia = $conexion->prepare("INSERT INTO `publicacionesUS` (`ID`, `tituloUS`, `nom_imagen`, `fecha`, `contenidoUS`, `resumenUS`) VALUES (NULL, :titulo, :nom_imagen, :fecha, :contenido, :resumen);");

    $sentencia->bindParam(":titulo", $titulo);        
    $sentencia->bindParam(":nom_imagen", $nom_archivo_imagen);
    $sentencia->bindParam(":fecha", $fecha);
    $sentencia->bindParam(":contenido", $contenido);
    $sentencia->bindParam(":resumen", $resumen);
    if($sentencia->execute()) {  
      header("Location:index.php");
    } else {
      echo "Error al crear y guardar el post en la base de datos.";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../../assets/img/No-background2.webp" type="image/x-icon">
  <title>New Post</title>
  <link rel="stylesheet" href="../../assets/estilos/main.css">
  <link rel="stylesheet" href="../../assets/estilos/dashboard.css">
  <link rel="stylesheet" href="../../assets/estilos/editar.css">
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>
<body>
  <header class="header__dashboard">
    <div class="header__dashboard-titulo">
      <a href="./index.php" style="margin-left: 40px;">Back</a>
    </div>
  </header>

  <section class="formulario">
    <div class="formulario__titulo">
      <h1>Add post</h1>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="lado-1">  
        <div class="input-group">
          <label for="imagen">Imagen</label>
          <img src="../../assets/img/cargaImagen.jpg" id="preview"></img>
          <input type="file" name="imagen" id="imagen">
        </div>
        <div class="lado-3">
          <div class="input-group">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha">
          </div>
      </div>
      </div>
      <div class="lado-2">
        <div class="input-group">
          <label for="titulo">Titulo</label>
          <input type="text" name="tituloUS" id="titulo" maxlength="150" required>
        </div>
        <div class="input-group">
          <label for="contenido">Contendio</label>
          <textarea name="contenidoUS" id="contenido"></textarea>
        </div>
        <div class="input-group">
          <label for="resumen">Resumen</label>
          <textarea type="text" name="resumenUS" id="resumen" maxlength="180" required></textarea>
        </div>
        <div class="editar__botones">
          <input type="submit" value="Enviar" class="btn-editar">
          <a href="./index.php" class="btn-cancelar">Cancelar</a>
        </div>
      </div>
    </form>
  </section>

  <script src="https://kit.fontawesome.com/80ad4ec867.js" crossorigin="anonymous"></script>
  <script src="//cdn.ckeditor.com/4.22.0/full/ckeditor.js"></script>
  <script src="../../assets/scripts/adminPost.js"></script>
</body>
</html>