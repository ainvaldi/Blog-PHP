<?php
include('partials/header.php'); 
$conexion=mysqli_connect('localhost','root','','efiPHP');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql="SELECT * from publicaciones INNER JOIN users ON users.id = publicaciones.user_id  INNER JOIN categorias ON categorias.id = publicaciones.categoria_id
    WHERE users.id = $id ORDER BY creado";
    $result = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($result) >= 1) {
        ?>
        <div class="container"> 
        <?php
        $row = mysqli_fetch_array($result);
        ?>
        <pre></pre>
            <h3> <?php echo  'Publicaciones de '.($row[9]).' '.($row[10]); ?> </h3>
        <?php
        
        $result = mysqli_query($conexion, $sql);
        while ($row = $row = mysqli_fetch_array($result)) { ?>
            <pre></pre>
            <a href="detallesPost.php?id=<?php echo $row[0] ?>" class="list-group-item list-group-item-action">
            <div class="row ">
                <div class="col md-8">
                    <h6> Categoria: <?php echo utf8_encode($row['nombre']) ?></h6>
                    <h3><?php echo ($row['titulo']) ?></h3>
                    <h6> Publicado: <?php echo substr(utf8_encode($row['creado']) , 0, 11) . ' a las ' . substr(utf8_encode($row['creado']) , 11, 23) ; ?></h6>
                    <h6> Modificado por última vez: <?php echo substr(utf8_encode($row['actualizado']) , 0, 11) . ' a las ' . substr(utf8_encode($row['actualizado']) , 11, 23)  ?></h6>
                    <h5><?php echo ($row['descripcion']) ?></h5>
                </div>
                <div class="col md-4">
                    <img class="float-right avatar" src="<?php echo utf8_encode($row['avatar']) ?>" width="50">
                    <h6 class="float-right"> By: <?php echo utf8_encode($row['firstname']) .' '. utf8_encode($row['lastname']) ?></h6>
                </div>
            </div>
        </a>
        <?php }
            } else {
                ?>
        <div class="container text-center">
            <pre></pre>
            <form class="p-3 mb-2 bg-light text-dark card card-body ">
                <pre></pre>
                <h4>No hay publicaciones del autor seleccionado</h4>
                <a href="index.php"><button type="button" class="btn btn-primary btn-lg btn-block"> Volver </button></a>
            </form>
            </div>

        </div>
<?php
    }
}

