// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CLIENTES= '../../app/api/dashboard/clientes.php?action=';
const API_TIPOUSUARIO = '../../app/api/dashboard/usuarios.php?action=readUserType';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    readRows(API_CLIENTES);
});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) {
    let content = '';
    let icon = '';
    let accion = '';
    let estado = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        if(row.estado == true)
        {
            icon = 'lock'
            accion = false;
            estado = 'Activo';
        } else {
            icon  = 'lock_open';
            accion = true;
            estado = 'Inactivo';
        }
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr>
                <td>${row.idcliente}</td>
                <td>${estado}</td>
                <td>${row.nombres}</td>
                <td>${row.apellidos}</td>
                <td>${row.dui}</td>
                <td>${row.correo_electronico}</td>
                <td>
                    <a href="#" onclick="openDeleteDialog(${row.idcliente},${accion})" class="btn waves-effect waves-orange btn deleteButton tooltipped" data-tooltip="Eliminar"><i class="material-icons">${icon}</i></a>
                    <a href="#" onclick="openUpdateModal(${row.idcliente})" class="btn waves-effect btn updateButton tooltipped" data-tooltip="Actualizar"><i class="material-icons">update</i></a>
                </td>
            </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;
}

// Funcion para busqueda filtrada 
function searchUser() {
    searchRows(API_CLIENTES, 'search-form');
}

// Función para preparar el formulario al momento de insertar un registro.
function openCreateModal() {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    document.getElementById('txtClave').disabled = false;
    document.getElementById('txtClave2').disabled = false;
    document.getElementById('txtDui').disabled = false;
    // Ocultamos el input que contiene el ID del registro
    document.getElementById('auxId').style.display = 'none';
    // Abrimos el modal con JQuery
    $('#modalDatos').modal('show');
}

// Funcion para guardar o modificar datos (se llama en el boton guardar del modal)
function saveData() {
    if (document.getElementById("txtClave").value != '') {
        if (document.getElementById("txtClave").value == document.getElementById("txtClave2").value) {
            let action = '';
            if (document.getElementById('auxId').value) {
                action = 'update';
            } else {
                action = 'create';
            }
            saveRow(API_CLIENTES, action, 'save-form', 'modalDatos');
        } else {
            sweetAlert(3, 'Las claves ingresadas no coinciden', null,'Confirme su contraseña');
        }
    } else {
        sweetAlert(3, 'Complete todos los campos solicitados', null,'No dejes campos vacios');
    }
}

// Función para preparar el formulario al momento de modificar un registro.
function openUpdateModal(id) {
    // Se restauran los elementos del formulario.
    document.getElementById('save-form').reset();
    // Mandamos a llamar el modal desde JS
    var myModal = new bootstrap.Modal(document.getElementById('modalDatos'));
    myModal.show();
    document.getElementById('modal-title').textContent = 'ACTUALIZAR USUARIO';
    // Ocultamos el input que contiene el ID del registro
    document.getElementById('auxId').style.display = 'none';
    // Se deshabilitan los campos de alias y contraseña.
    document.getElementById('txtClave').disabled = true;
    document.getElementById('txtClave2').disabled = true;
    document.getElementById('txtDui').disabled = true;
    document.getElementById('auxId').value = id;
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('txtId', id);
    // Realizamos una peticion a la API indicando el caso a utilizar y enviando la direccion de la API como parametro
    fetch(API_CLIENTES + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('auxId').value = id;
                    document.getElementById('txtNombre').value = response.dataset.nombres;
                    document.getElementById('txtApellido').value = response.dataset.apellidos;
                    document.getElementById('txtDui').value = response.dataset.dui;
                    document.getElementById('txtCorreo').value = response.dataset.correo_electronico;
                    document.getElementById('txtClave').value = response.dataset.clave;
                    document.getElementById('txtClave2').value = response.dataset.clave;
                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

// Función para establecer el registro a eliminar y abrir una caja de dialogo de confirmación.
function openDeleteDialog(id,accion) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('txtId', id);
    data.append('txtAccion', accion);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_CLIENTES, data);
}
