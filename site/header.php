<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Extreme Technologies | Prueba PHP</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
   <link rel="stylesheet" href="../../assets/css/generalStyle.css">
   <link rel="stylesheet" href="../../assets/plugins/font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="../../assets\plugins\sweetalert2\dist/sweetalert2.min.css">
</head>
<body>
   <header class="barramenu">
         <div class="row">
            <div class="col-md-2">
               <img width="200" src="https://www.extreme.com.co/web/wp-content/uploads/2020/02/cropped-logo-extreme.png" alt="">
            </div>
            <div class="col-md-7">
                  <div class="mt-3">
                     EJ Apis:
                     <a href="../apis/pqr" target="_blank" >Listado_PQRs</a>
                     <a href="../apis/usuarios" target="_blank" >Listado_Usuarios</a>
                  </div>
            </div>
            <div class="col-md-1">

               <label class="usuarioSesion float-right mt-3" for=""><i class="fa fa-user"></i> <?= Ucwords($_SESSION['usuario'])?></label>
            </div>
            <div class="col-md-2 ">
               <button class="btn btn-info float-right mt-2" onclick="cerrarSesion()">
                     Cerrar&nbsp;Sesión
               </button>
            </div>
         </div>
   </header>
   
   