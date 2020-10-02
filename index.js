$(document).ready(function () {
   

});

function iniciarSesion() {
   var usuario = $('#usuario').val();
   var password = $('#contrasena').val();

   if (usuario.length == '') {
      Swal.fire(
         'Avertencia!',
         'El campo Usuario se encuentra vacio',
         'warning'
      )
   } else if(password.length == '') {
      Swal.fire(
         'Avertencia!',
         'El campo Contraseña se encuentra vacio',
         'warning'
      )
   } else {
      $.ajax({
         url: 'crtindex',
         type: 'POST',
         dataType: 'html',
         data: { usuario: usuario, password: password, accion: 'acceder'},
         beforeSend: function () {
            $("#loading").html('<div id="preview-area" class=""><div class="dots-loader" id="Spinner">Loading...</div></div>');
         },
         success: function (data) {

            
              if(data == 0){
                  Swal.fire(
                     'Error!',
                     'Acceso Incorrecto',
                     'warning'
                  )
              }else{
                  location.href=('site/dashboard/dashboard')
              }
         },
         error: function () {
   
         }
      })
   }

   


}

function cerrarSesion(){
   $.ajax({
      url: '../../crtindex',
      type: 'POST',
      dataType: 'html',
      data: {  accion: 'cerrarsesion'},
      beforeSend: function () {
         $("#loading").html('<div id="preview-area" class=""><div class="dots-loader" id="Spinner">Loading...</div></div>');
      },
      success: function (data) {
         
               Swal.fire(
                  'Accion!',
                  'Cerrando Sesión',
                  'info'
               )
               
               location.href=('../../index')
           
      },
      error: function () {

      }
   })
  
}