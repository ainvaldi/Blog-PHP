<?php
    session_start();
    $conexion=mysqli_connect('localhost','root','','efiPHP');
?>

<?php
#Comparo id del usuario dentro de la tabla publicaciones y el id de la tabla de usuarios, si coinciden podra editar la publicacion
if (isset($_GET['id'])) {
    $id_cate = $_GET['id_cate'];
    $id = $_GET['id']; 
    $query = "SELECT * FROM publicaciones WHERE id = $id";
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result); 
        $titulo = $row['titulo'];         
        $descripcion = $row['descripcion'];
        $imagen = $row['image'];
        $categ = $row['categoria_id'];
    }

    if (isset($_POST['update'])) {
        $id = $_GET['id']; 
        $titulo = $_POST['titulo']; 
        $descripcion = $_POST['descripcion'];
        $imagen = $_POST['imagen'];
        $categ = $_POST['categoria'];
        date_default_timezone_set('America/Buenos_Aires');
        $fecha_actual=date("Y-m-d H:i:s");
        $query = "UPDATE publicaciones set titulo = '$titulo' , descripcion ='$descripcion', image = '$imagen', categoria_id='$categ', actualizado='$fecha_actual' WHERE id = $id"; 
        mysqli_query($conexion, $query);  
        header('Location: myPost.php');
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
    <title>Editar publicacion</title>
</head>
<body>
    <?php
    include('partials/header.php');  
    ?>
    <div class="container p-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card card-body">
                    <form action="editPost.php?id=<?php echo $_GET['id']; ?> " method="POST">
                        <div class="form-group">
                            Título: <input maxlength="55" type="text" name="titulo" id="" value='<?php echo $titulo ?>' class="form-control" placeholder="Editar">
                            <pre></pre>
                            Descripción: <input maxlength="244" type="text" name="descripcion" id="" value='<?php echo $descripcion ?>' class="form-control" placeholder="Editar">
                            <pre></pre>
                            Imagen: <input maxlength="244" type="text" name="imagen" id="" value='<?php echo $imagen ?>' class="form-control" placeholder="Editar">
                            <pre></pre>
                        </div>
                        <div class="form-group">
                            <label>Categoria</label>
                            <select name= 'categoria'>
                            <?php
                                $query = " SELECT * FROM categorias ";
                                $resultCate = mysqli_query($conexion, $query); 
                                while($row = mysqli_fetch_array($resultCate)){?>
                                    <option value="<?php echo $row['id'] ?>" <?php echo ($row['id']== $categ) ? 'selected': ''; ?> > <?php echo utf8_encode($row['nombre'])?> </option>
                            <?php } ?>
                            </select>
                        </div>
                        <button class="btn btn-success btn-lg btn-block " name="update">
                            Guardar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>