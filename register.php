
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Registrarse</title>
</head>
<body>
    <?php require 'partials/header.php' ?>
    <?php if(!empty($message)):?>
        <p><?= $message ?></p>
    <?php endif;?>
<h1>Bienvenido, ingrese sus datos para registrarse</h1>
    <form action="newUser.php" method="POST">
        <input type="text" name="firstname" placeholder="ingrese su nombre">
        <input type="text" name="lastname" placeholder="ingrese su apellido">
        <input type="text" name="email" placeholder="ingrese su email">
        <p>Selecciona tu avatar</p>
        <input type="radio" name="avatar" id="avatar" value="https://image.freepik.com/vector-gratis/perfil-avatar-hombre-icono-redondo_24640-14046.jpg">
        <img src="img/avatarmasc.jpg"  height="60" width="60"> 
        <img src="img/avatarfem.jpg"  height="60" width="60">
        <input type="radio" name="avatar" id="avatar" value="https://image.freepik.com/vector-gratis/perfil-avatar-mujer-icono-redondo_24640-14042.jpg">
        <input type="password" name="password" placeholder="ingrese su contraseña">
        <input type="submit" value="Registrarse">
    </form>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>