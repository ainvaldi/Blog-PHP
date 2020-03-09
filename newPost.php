<?php
  session_start();
  require 'database.php';
    $message='';
    if (!empty($_POST['titulo'])&& !empty($_POST['descripcion'])&& !empty($_POST['image'])){
        $sql ="INSERT INTO publicaciones(titulo, descripcion, image, user_id, categoria_id)VALUES(:titulo, :descripcion, :image, :user_id,  :categoria_id)";
        $stmt=$conn->prepare($sql);
        $stmt->bindParam(':titulo',$_POST['titulo']);
        $stmt->bindParam(':descripcion',$_POST['descripcion']);
        $stmt->bindParam(':image',$_POST['image']);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->bindParam(':categoria_id',$_POST['categoria_id']);
        if($stmt->execute()){
            $message='Post creado satisfactoriamente';
        }else{
            $message='Ha ocurrido un error creando el post';
        }
    }
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
    <title>Nueva publicación</title>
</head>
<body>
    <?php require 'partials/header.php' ?>
    <?php if(!empty($message)):?>
        <p><?= $message ?></p>
    <?php endif;?>
    <div class="row">
        <div class="col-sm-12">
            <h1>Cree su propio post, que espera?</h1>
            <form action="newPost.php" method="post">
                <input type="text" name="titulo" placeholder="ingrese nombre de la noticia">
                <input type="text" name="descripcion" placeholder="ingrese descripción">
                <input type="text" name="image" placeholder="ingrese link de la imagen">
                <p>Seleccione la categoria</p>
                <br/>
                <div class="form-group">
                    <label>Categoría: </label>
                        <select name="categoria_id">
                        <?php
                        $query = " SELECT * FROM categorias ";
                        $result = mysqli_query($conexion, $query);  
                        while ($row = mysqli_fetch_array($result)) { ?>
                            <?php $contador= ($contador+1) ;?>    
                            <option value="<?php echo $row['id'] ?>" >
                            <?php echo  (utf8_encode($row['nombre'])) ; ?></option>
                            <?php } ?>
                        </select>
                </div>
                <input type="submit" value="Crear Post">
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>