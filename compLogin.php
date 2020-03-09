<?php 
	$conexion=mysqli_connect('localhost','root','','efiPHP');
?>
<?php
    session_start();
    $message='';
    $emailUsu = $_POST['email'];
    $passUsu = $_POST['password'];
    $passwordUsu = md5($passUsu);

    $query = "SELECT * from users where email='$emailUsu' and  password='$passwordUsu'";
    $consulta = mysqli_query($conexion, $query);
    $result = mysqli_fetch_array($consulta);

    if($result['email'] == $emailUsu && $result['password'] == $passwordUsu){
        $_SESSION['email'] = $emailUsu;
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['firstname'] = $result['firstname'];
        header("location: /efiPHP");
    }else{
        echo "<script>
        alert('Datos incorrectos');
        window.location= '/efiPHP/login.php'
        </script>";  
    }
?>