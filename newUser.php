<?php 
	$conexion=mysqli_connect('localhost','root','','efiPHP');
?>
<?php


$nombreUsu = $_POST['firstname'];
$apeUsu = $_POST['lastname'];
$emailUsu = $_POST['email'];
$avatarUsu = $_POST['avatar'];
$passUsu = $_POST['password'];


        // verificar si el email ingresado para registrarse ya ha sido utilizado
        $query = "SELECT * from users where email='$emailUsu'";
        $consult = mysqli_query($conexion, $query);
        $result = mysqli_fetch_array($consult);

        if ($result['email'] == $emailUsu) {  
            echo "<script>
                       alert('El email ya esta en uso');
                       window.location= '/efiPHP/register.php'
                    </script>";
        } else {
            $passwordUsu = md5($passUsu);
            $query = "INSERT INTO users (firstname, lastname, password, avatar, email) values('$nombreUsu','$apeUsu','$passwordUsu','$avatarUsu', '$emailUsu')";
            $consulta = mysqli_query($conexion, $query);
    require 'email/PHPMailer/PHPMailerAutoload.php';
    $conexion=mysqli_connect('localhost','root','','efiPHP');
    $mail=new PHPMailer();

    $mail->isSMTP();
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='tls';
    $mail->Host='smtp.gmail.com';
    $mail->Port='587';
    $mail->Username='tecnoblogphp@gmail.com';
    $mail->Password='Tecnoblog2014';

    $mail->setFrom('@gmail.com','Datos de la cuenta');
    $mail->addAddress($emailUsu);
    $mail->Subjet='Estos son sus datos de la cuenta';
    $mail->Body=('<b>Bienvenido</b><br>Estos son los datos de su cuenta <br>'.'Email: ' .$emailUsu.'<br>'.'Contraseña: '.$passUsu);

    $mail->IsHTML(true);
    require 'partials/header.php';
    if($mail->send()){
        echo 'Se ha registrado correctamente, inicie sesión';
    }else{
        echo 'Error';
    }
    }
?>