<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/public_page.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Public_Page::headerTemplate('GameBridge | Carrito',null);
?>

<!-- Contenedor para mostrar el detalle del carrito de compras -->
<div class="container"><br><br>
    <!-- Título del contenido principal -->
    <br>
    <h3 class="textCenter">Carrito de compras</h3>
    <br>

    <!-- Tabla para mostrar el detalle de los productos agregados al carrito de compras -->
    <table class="table table-striped table-hover">
        <!-- Cabeza de la tabla para mostrar los títulos de las columnas -->
        <thead>
            <tr>
                <th>IMAGEN</th>
                <th>PRODUCTO</th>
                <th>PRECIO (US$)</th>
                <th>CANTIDAD</th>
                <th>SUBTOTAL (US$)</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <!-- Cuerpo de la tabla para mostrar un registro por fila -->
        <tbody id="tbody-rows">
        </tbody>
    </table>

    <!-- Fila para mostrar el monto total a pagar -->
    <div class="row alignRight">
        <p>TOTAL A PAGAR (US$) <b id="pago"></b></p>
    </div>
    
    <!-- Fila para mostrar un botón que finaliza el pedido -->

    <div class="row alignRight">
        <p>
            <button type="button" onclick="finishOrder()" class="btn btn-primary cartButtonSize">
                <i class="bi bi-credit-card-fill"></i>
            </button>
        </p>
        
        <p>
            <a class="btn btn-warning cartButtonSize" href="index.php" role="button">
                <i class="bi bi-basket-fill"></i>
            </a>
        </p>
    </div>

</div>

<!-- Componente Modal para mostrar una caja de dialogo -->
<div id="item-modal" class="modal">
    <div class="modal-content">
        <!-- Título para la caja de dialogo -->
        <h4 class="center-align">Cambiar cantidad</h4>
        <!-- Formulario para cambiar la cantidad de producto -->
        <form method="post" id="item-form">
            <!-- Campo oculto para asignar el id del registro al momento de modificar -->
            <input type="number" id="id_detalle" name="id_detalle" class="hide"/>
            <div class="row">
                <div class="input-field col s12 m4 offset-m4">
                    <i class="material-icons prefix">list</i>
                    <input type="number" id="cantidad_producto" name="cantidad_producto" min="1" class="validate" required/>
                    <label for="cantidad_producto">Cantidad</label>
                </div>
            </div>
            <div class="row center-align">
                <a href="#" class="btn waves-effect grey tooltipped modal-close" data-tooltip="Cancelar"><i class="material-icons">cancel</i></a>
                <button type="submit" class="btn waves-effect blue tooltipped" data-tooltip="Guardar"><i class="material-icons">save</i></button>
            </div>
        </form>
    </div>
</div>

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Public_Page::footerTemplate('cart.js');
?>