// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_PEDIDOS = '../../app/api/public/pedidos.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    readOrderDetail();
});

// Función para obtener el detalle del pedido (carrito de compras).
function readOrderDetail() {
    fetch(API_PEDIDOS + 'readHistorial', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se declara e inicializa una variable para concatenar las filas de la tabla en la vista.
                    let content = '';
                    // Se declara e inicializa una variable para guardar el numero de pedidos
                    let numero_pedidos = 0;
                    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        numero_pedidos = numero_pedidos + 1;
                        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
                        content += `
                        <tr>
                            <td>${numero_pedidos}</td>
                            <td>${row.fecha}</td>
                            <td>${row.estado}</td>
                            <td>${row.total}</td>
                            <td>
                                <a href="#" onclick="openDetail(${row.idfactura})" class="btn waves-effect btn updateButton tooltipped" data-tooltip="Actualizar"><i class="bi bi-handbag-fill"></i></a>
                            </td>
                        </tr>     
                        `;
                    });
                    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
                    document.getElementById('tb-rows').innerHTML = content;                                      
                } else {
                    sweetAlert(4, response.exception, 'index.php');
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}


// Función para abrir una caja de dialogo (modal) con el formulario de cambiar cantidad de producto.
function openDetail(id) {

    const data = new FormData();
    data.append('id_pedido', id);

    fetch(API_PEDIDOS + 'readDetailHistorial', {
        method: 'post',
        body: data
    }).then(function (request) {

        if (request.ok) {
            request.json().then(function (response) {
                
                if (response.status) {

                    // Se declara e inicializa una variable para concatenar las filas de la tabla en la vista.
                    let content = '';
                    
                    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                
                        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
                        content += `
                        <tr>
                            <td><img src="../../resources/img/productos/${row.imagen}" class="materialboxed" height="100"></td>
                            <td>${row.producto}</td>
                            <td>${row.marca}</td>
                            <td>${row.preciounitario}</td>
                            <td>${row.cantidad}</td>
                            <td>${row.subtotal}</td>
                        </tr>     
                        `;

                    });
                    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
                    document.getElementById('tb-rows2').innerHTML = content;                                      
                } else {
                    sweetAlert(4, response.exception, 'index.php');
                }

            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }

    }).catch(function (error) {
        console.log(error);
    });
}

