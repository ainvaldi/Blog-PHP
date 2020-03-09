<?php
  session_start();
  require 'database.php';
$conexion=mysqli_connect('localhost','root','','efiPHP');
?>

<?php
include('partials/header.php');

if (isset($_GET['id'])) {
    // si obtengo desde account.php al id lo guardo en una variable ($id)
    $id = $_GET['id'];
    // obtener las publicaciones con su categoria y datos del usuario que realizo la publicaion
    $query = "
        SELECT * FROM publicaciones
        INNER JOIN users
        ON users.id = publicaciones.user_id
        INNER JOIN categorias
        ON categorias.id = publicaciones.categoria_id
        WHERE categorias.id = $id
        ORDER BY publicaciones.creado DESC
        ";
    $result = mysqli_query($conexion, $query);
    if (mysqli_num_rows($result) >= 1) {
        ?>
        <div class="container">
            <?php
            
             
            $row2 = mysqli_fetch_array($result);
            ?>
                <h3> <?php echo  'Seccion: '.($row2['nombre']); ?> </h3>
            <?php
            $result = mysqli_query($conexion, $query);
            while ($row = $row = mysqli_fetch_array($result)) { ?>
                <a href="detallesPost.php?id=<?php echo $row[0] ?>" class="list-group-item list-group-item-action">
                    <div class="row ">
                    <div class="col md-12">						
                        <h3><?php echo ($row['titulo']) ?></h3>
                                <img  src="<?php echo ($row['image']) ?>"height="80" width="120">
                        <h6> Publicado: <?php echo substr(utf8_encode($row['creado']) , 0, 11) . ' a las ' . substr(utf8_encode($row['creado']) , 11, 23) ; ?></h6>
                        <h6> Modificado por última vez: <?php echo substr(utf8_encode($row['actualizado']) , 0, 11) . ' a las ' . substr(utf8_encode($row['actualizado']) , 11, 23)  ?></h6>
                        <h5><?php echo ($row['descripcion']) ?></h5>
                    </div>
                    </div>
                </a>
            <?php }
            } else {
                    ?>
            <div class="container text-center">
            <br/>
                    <h4>No hay publicaciones creadas para esta seccion </h4>
                    <a href="secciones.php"><button type="button" class="btn btn-primary btn-lg active">Volver a secciones</button></a>
                </form>
            </div>
        </div>
<?php
    }
}
