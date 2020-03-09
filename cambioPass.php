<?php
    require 'email/PHPMailer/PHPMailerAutoload.php';
    $conexion=mysqli_connect('localhost','root','','efiPHP');
    #Gracias al metodo POST puedo traer el mail de la pestaña recuperar contraseña
    $emailUs=$_POST['email'];

    $newPass=substr((uniqid()), 0, 10);
    $newPassmd5 = ($newPass);

    $mail=new PHPMailer();
    #Este sera el gmail que mandara los datos
    $mail->isSMTP();
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='tls';
    $mail->Host='smtp.gmail.com';
    $mail->Port='587';
    $mail->Username='tecnoblogphp@gmail.com';
    $mail->Password='Tecnoblog2014';
    #Mail al cual sera llegado el mensaje
    $mail->setFrom('@gmail.com','Recuperacion de contraseña');
    $mail->addAddress($emailUs);
    $mail->Subjet='Hola';
    $mail->Body='<b>Bienvenido</b><br>esta es su nueva contraseña';
    $mail->Body='Contrasenia '.$newPass.'';
    $mail->IsHTML(true);

    $sqlUpdate="UPDATE users set password='$newPass' Where email='$emailUs'";
    $resultUpdate=mysqli_query($conexion,$sqlUpdate);

    if($mail->send()){
        require 'partials/header.php';
        echo 'El mail para recuperar la contraseña ha sido enviado';
    }else{
        echo 'Error';
    }
?>
