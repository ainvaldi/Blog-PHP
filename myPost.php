<?php
  session_start();
  $id_user = ($_SESSION['user_id']);

 $sql = " SELECT * FROM publicaciones
  INNER JOIN users
  ON users.id = publicaciones.user_id
  INNER JOIN categorias
  ON categorias.id = publicaciones.categoria_id
  WHERE users.id = '$id_user' 
  ORDER BY publicaciones.creado DESC
    ";
?>
<?php 
	$conexion=mysqli_connect('localhost','root','','efiPHP');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Mis publicaciones</title>
</head>
<body>
    <?php require 'partials/header.php' ?>
    <br>
	<?php
	    $result=mysqli_query($conexion,$sql);
        if (mysqli_num_rows($result) < 1) { ?>
            <div class="row ">
                <div class="col-sm-8">
                    <h5><?php echo ('No has realizado ninguna publicación, cree una para ver sus publicaciones') ?></h5>
                </div>
                <div class="col-sm-4">   
                </div>
            </div>  
    <?php
    }?>
    <?php while ($row = mysqli_fetch_array($result)) { ?>
    <div class="row ">
        <div class="col-sm-8">
            <a href="detallesPost.php?id=<?php echo $row[0] ?>">
            <div class="list-group-item list-group-item-action">
                <img class="float-right" src="<?php echo ($row['avatar']) ?>"height="60" width="60">
                <h6 class="float-right"> Hecho por: <?php echo ($row['firstname']) . ' ' . ($row['lastname']) ?></h6>
                <h6 class="float-left"> Categoría: <?php echo ($row['nombre']) ?></h6>
                <br/>
                <br/>
                <h1><?php echo ($row['titulo']) ?></h1>
                <h6> Publicado: <?php echo substr(utf8_encode($row['creado']) , 0, 11) . ' a las ' . substr(utf8_encode($row['creado']) , 11, 23) ; ?></h6>
                <h6> Modificado por última vez: <?php echo substr(utf8_encode($row['actualizado']) , 0, 11) . ' a las ' . substr(utf8_encode($row['actualizado']) , 11, 23)  ?></h6>
                <h5><?php echo ($row['descripcion']) ?></h5>        
            </div>
            <br>
        </div>
        <div class="col-sm-3">
            <a href="editPost.php?id=<?php echo $row[0] ?>&id_cate=<?php echo ($row["categoria_id"]); ?>" class="btn btn-primary btn-lg btn-block"> Editar </a>
            <a onclick="return confirmarBorrado();" href="deletePost.php?id=<?php echo $row[0] ?>" class="btn btn-danger btn-lg btn-block delete"> Eliminar </a>
        </div>
    </div>
    <?php }
     ?>

    <script type="text/javascript">
        function confirmarBorrado() {
            var confirmar = confirm("¿Realmente quiere eliminar este post? ");
            if (confirmar) {
                return true;
            } else {
                return false;
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>