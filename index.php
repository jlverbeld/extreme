<?php
   include 'class/clsConnectDB.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://getbootstrap.com/docs/4.5/examples/sign-in/signin.css">
    <link rel="stylesheet" href="assets/css/generalStyle.css">
   <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="assets\plugins\sweetalert2\dist/sweetalert2.min.css">

</head>

<body style="text-align:center" >
    <header >
            <div class="lineacabecera"></div>
    </header>
    
    <section class="w-100">


            <form class="form-signin">
                <img class="mb-4" width="auto" src="https://www.extreme.com.co/web/wp-content/uploads/2020/02/cropped-logo-extreme.png" alt="" width="72" height="72">
                <h1 class="h3 mb-3 font-weight-normal">INICIO DE SESIÓN</h1>
                <label for="inputEmail" class="sr-only">Usuario</label>
                <input type="text" id="usuario" class="form-control" placeholder="Usuario" required autofocus>
                <label for="contrasena" class="sr-only">Contraseña</label>
                <input type="password" id="contrasena" class="form-control" placeholder="Contraseña" required>
                
                <button class="btn btn-lg btn-primary btn-block" 
                type="button" onclick="iniciarSesion()" >Ingresar</button>
                <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
            </form>
            

    </section>

    <footer>
        <script src="assets\plugins\sweetalert2\dist/sweetalert2.min.js"></script>
        <script src='assets/plugins/jquery/jquery.js'></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
            integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
        </script>
        <script src="index.js"></script>
    </footer>
</body>


</html>
