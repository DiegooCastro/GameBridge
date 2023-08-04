<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/public_page.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Public_Page::headerTemplate('Gamebridge | Registro','Iniciar sesión');
?>
  <br><br>
  <div class="container-fluid py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">

            <center><h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registro de clientes</h3></center>
            <form method="post" id="register-form">

              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="firstName">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="form-control form-control-lg" />
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="lastName">Apellido</label>
                    <input type="text" id="apellido" name="apellido" class="form-control form-control-lg" />
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="lastName">Correo electronico</label>
                    <input type="email" id="correo" name="correo" class="form-control form-control-lg" />
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="lastName">DUI</label>
                    <input type="text" id="dui" name="dui" class="form-control form-control-lg" />
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="lastName">Clave</label>
                    <input type="password" id="clave" name="clave" class="form-control form-control-lg" />
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <label class="form-label" for="lastName">Confirmar clave</label>
                    <input type="password" id="clave2" name="clave2" class="form-control form-control-lg" />
                  </div>
                </div>
              </div>
              <div class="mt-4 pt-2">
                <center><button onclick="registrarCliente()" class="btn btn-dark btn-lg btn-block botonRegister" type="button">Registrarse</button></center>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Public_Page::footerTemplate('register.js');
?>