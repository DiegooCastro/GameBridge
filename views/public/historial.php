<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/public_page.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Public_Page::headerTemplate('GameBridge | Historial de compras', null);
?>

<style>
    .centrar {
        align-items: center;
        text-align: center;
        align-self: center;
        align-content: center;
        place-items: center;
        justify-content: center;
        padding-top: 45px;
        padding-bottom: 35px;
        font-size: 35px;
    }
</style>

<div class="container">

    <h1 class="centrar">Historial de compras</h1>
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Fecha pedido</th>
                <th scope="col">Estado</th>
                <th scope="col">Total</th>
                <th scope="col">Detalle pedido</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
</div>


<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Public_Page::footerTemplate('index.js');
?>