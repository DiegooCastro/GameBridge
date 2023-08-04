<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/dashboard_page.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Dashboard_Page::headerLogin('Registro de usuarios');
?>

<section class="text-center text-lg-start">
  <div class="container py-4">
    <div class="row g-0 align-items-center">
      <div class="col-lg-6 mb-5 mb-lg-0">
        <div class="card cascading-right" style="background: hsla(0, 0%, 100%, 0.55); backdrop-filter: blur(30px);">
          <div class="card-body p-5 shadow-5 text-center">
            <h2 class="fw-bold mb-5">Registro de usuarios</h2>

            <form method="post" id="register-form">

                <div class="row">

                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="form3Example1">Usuario</label>
                        <input type="text" id="txtAlias" name="txtAlias" class="form-control" />
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="form3Example1">DUI</label>
                        <input type="text" id="txtDui" name="txtDui" class="form-control" />
                    </div>

                    <div class="col-md-6 mb-4">      
                        <label class="form-label" for="form3Example2">Correo electronico</label>
                        <input type="email" id="txtCorreo" name="txtCorreo" class="form-control" /> 
                    </div>

                    <div class="col-md-6 mb-4">      
                        <label class="form-label" for="form3Example2">Telefono</label>
                        <input type="text" id="txtTelefono" name="txtTelefono" class="form-control" /> 
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="form3Example1">Contraseña</label>
                        <input type="password" id="txtClave1" name="txtClave1" class="form-control" />
                    </div>

                    <div class="col-md-6 mb-4">      
                        <label class="form-label" for="form3Example2">Confirmar contraseña</label>
                        <input type="password" id="txtClave2" name="txtClave2" class="form-control" /> 
                    </div>

                </div>
            </form><br>
                <button type="submit" onclick="registrarUsuario()" class="btn btn-dark botonLogin btn-block mb-4"> Registrarse </button>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mb-5 mb-lg-0">
        <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" class="w-100 rounded-4 shadow-4" alt=""/>
      </div>
    </div>
  </div>
</section>

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerLogin('register.js');
?>