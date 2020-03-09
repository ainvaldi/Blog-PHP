<?php
  session_start();
	$conexion=mysqli_connect('localhost','root','','efiPHP');
?>

<?php
#Realizo un inner join en el cual comparo el id de la publicacion y el id del usuario, si los dos coinciden se veran las publicaciones. 
#Tambien puede que no se vea nada ya que el usuario no posteo nada
if (isset($_GET['id'])) {
    $id = $_GET['id']; 
    $query = "
      SELECT * FROM publicaciones  
      INNER JOIN categorias 
      ON categorias.id = publicaciones.categoria_id
      INNER JOIN users
      ON users.id = publicaciones.user_id
      WHERE publicaciones.id = $id   
      ";
    $result = mysqli_query($conexion, $query);
    #Si coinciden me mostrara los siguientes datos
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result); 
        $titulo = $row['titulo'];           
        $descripcion = $row['descripcion'];
        $imagen = $row['image'];
        $fecha = $row['creado'];
        $categ = $row['nombre'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];        
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Publicación</title>
</head>
<body>
  <?php
  include('partials/header.php');  
  ?>
  <div class="container">
    <div class="row ">
      <div class="col-sm-12">
        <h6 class="float-right"> Categoría: <?php echo ($row['nombre']) ?></h6>
        <div class="col-sm-9">
        </div>
        <div class="col-sm-1">
          <a href="pubAutor.php?id=<?php echo $row[6] ?>" >
          <img  src="<?php echo utf8_encode($row['avatar']) ?>" width="50">
          <h6 > Hecho por: <?php echo utf8_encode($row['firstname']) . ' ' . utf8_encode($row['lastname']) ?></h6>
          </a>
        </div>
        <div class="row">
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
            <h3><?php echo ($row['titulo']) ?></h3>
            <img  src="<?php echo ($row['image']) ?>"height="80" width="120">
            <h6> Publicado: <?php echo substr(utf8_encode($row['creado']) , 0, 11) . ' a las ' . substr(utf8_encode($row['creado']) , 11, 23) ; ?></h6>
            <h6> Modificado por última vez: <?php echo substr(utf8_encode($row['actualizado']) , 0, 11) . ' a las ' . substr(utf8_encode($row['actualizado']) , 11, 23)  ?></h6>
            <h5><?php echo ($row['descripcion']) ?></h5>
          </div>
          <div class="col-sm-4"></div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>