<?php 
	$conexion=mysqli_connect('localhost','root','','efiPHP');
?>

<?php
  #Compruebo que el usuario este logueado
  session_start();
  #Comparo el id del usuario con el id de la publicacion, si coinciden se borrara, de lo contrario ocurrira un error
  if (isset($_GET['id'])){
    $id = $_GET['id'];  
    $query = "DELETE FROM publicaciones WHERE id = $id";  
    $result= mysqli_query($conexion, $query);  
      if (!result){
        die('La eliminacion de su publicacion no se completo');
      }
      header("Location: myPost.php"); 
    }
?>