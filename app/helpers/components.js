function readRows(api) {
    fetch(api + 'readAll', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    data = response.dataset;
                } else {
                    sweetAlert(4, response.exception, null);
                }
                // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                fillTable(data);
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function readRows2(api, form) {
    fetch(api + 'readAllParam', {
        method: 'post',
        body: new FormData(document.getElementById(form))
    }).then(function (request) {
        if (request.ok) {
            request.json().then(function (response) {
                if (response.status) {
                    fillTableParam(response.dataset);
                } else {
                    DeleteTable();
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


function searchRows(api, form) {
    fetch(api + 'search', {
        method: 'post',
        body: new FormData(document.getElementById(form))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                    fillTable(response.dataset);
                    sweetAlert(1, response.message, null);
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

function onlySaveRow(api, action, form, modal) {
    fetch(api + action, {
        method: 'post',
        body: new FormData(document.getElementById(form))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se cierra la caja de dialogo (modal) del formulario.
                    let instance = M.Modal.getInstance(document.getElementById(modal));
                    instance.close();
                    // Se cargan nuevamente las filas en la tabla de la vista después de agregar o modificar un registro.
                    sweetAlert(1, response.message, null);
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


function saveRow(api, action, form, modal) {
    fetch(api + action, {
        method: 'post',
        body: new FormData(document.getElementById(form))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se cierra la caja de dialogo (modal) del formulario.
                    $(`#${modal}`).modal('hide');
                    // Se cargan nuevamente las filas en la tabla de la vista después de agregar o modificar un registro.
                    readRows(api);
                    sweetAlert(1, response.message, null);
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

function confirmDelete(api, data) {
    swal({
        title: 'Advertencia',
        text: '¿Desea cambiar el estado?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
        if (value) {
            fetch(api + 'delete', {
                method: 'post',
                body: data
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            // Se cargan nuevamente las filas en la tabla de la vista después de borrar un registro.
                            readRows(api);
                            sweetAlert(1, response.message, null);
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
    });
}

function onlyConfirmDelete(api, data) {
    swal({
        title: 'Advertencia',
        text: '¿Desea eliminar el registro?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
        if (value) {
            fetch(api + 'delete', {
                method: 'post',
                body: data
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            // Se cargan nuevamente las filas en la tabla de la vista después de borrar un registro.
                            sweetAlert(1, response.message, null);
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
    });
}

function sweetAlert(type, text, url) {
    // Se compara el tipo de mensaje a mostrar.
    switch (type) {
        case 1:
            title = 'Éxito';
            icon = 'success';
            break;
        case 2:
            title = 'Error';
            icon = 'error';
            break;
        case 3:
            title = 'Advertencia';
            icon = 'warning';
            break;
        case 4:
            title = 'Aviso ';
            icon = 'info';
    }
    // Si existe una ruta definida, se muestra el mensaje y se direcciona a dicha ubicación, de lo contrario solo se muestra el mensaje.
    if (url) {
        swal({
            title: title,
            text: text,
            icon: icon,
            button: 'Aceptar',
            closeOnClickOutside: false,
            closeOnEsc: false
        }).then(function () {
            location.href = url
        });
    } else {
        swal({
            title: title,
            text: text,
            icon: icon,
            button: 'Aceptar',
            closeOnClickOutside: false,
            closeOnEsc: false
        });
    }
}

function fillSelect(endpoint, select, selected) {
    fetch(endpoint, {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let content = '';
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Si no existe un valor para seleccionar, se muestra una opción para indicarlo.
                    if (!selected) {
                        content += '<option disabled selected>Seleccione una opción</option>';
                    }
                    // Se recorre el conjunto de registros devuelto por la API (dataset) fila por fila a través del objeto row.
                    response.dataset.map(function (row) {
                        // Se obtiene el dato del primer campo de la sentencia SQL (valor para cada opción).
                        value = Object.values(row)[0];
                        // Se obtiene el dato del segundo campo de la sentencia SQL (texto para cada opción).
                        text = Object.values(row)[1];
                        // Se verifica si el valor de la API es diferente al valor seleccionado para enlistar una opción, de lo contrario se establece la opción como seleccionada.
                        if (value != selected) {
                            content += `<option value="${value}">${text}</option>`;
                        } else {
                            content += `<option value="${value}" selected>${text}</option>`;
                        }
                    });
                } else {
                    content += '<option>No hay opciones disponibles</option>';
                }
                // Se agregan las opciones a la etiqueta select mediante su id.
                document.getElementById(select).innerHTML = content;
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

/*
*   Función para generar una gráfica de barras verticales. Requiere el archivo chart.js para funcionar.
*
*   Parámetros: canvas (identificador de la etiqueta canvas), xAxis (datos para el eje X), yAxis (datos para el eje Y), legend (etiqueta para los datos) y title (título de la gráfica).
*
*   Retorno: ninguno.
*/
function barGraph(canvas, xAxis, yAxis, legend, title) {
    // Se declara un arreglo para guardar códigos de colores en formato hexadecimal.
    let colors = ["#0a1733", "#0a1733", "#11295c", "#183b85", "#2151b8"]
    // Se establece el contexto donde se mostrará el gráfico, es decir, se define la etiqueta canvas a utilizar.
    const context = document.getElementById(canvas).getContext('2d');
    // Se crea una instancia para generar la gráfica con los datos recibidos.
    const chart = new Chart(context, {
        type: 'bar',
        data: {
            labels: xAxis,
            datasets: [{
                label: legend,
                data: yAxis,
                borderColor: '#220e5e',
                borderWidth: 1,
                backgroundColor: colors
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: false
            },
            title: {
                display: true,
                text: title
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        precision: 0
                    }
                }]
            }
        }
    });
}

/*
*   Función para generar una gráfica de pastel. Requiere el archivo chart.js para funcionar.
*
*   Parámetros: canvas (identificador de la etiqueta canvas), legends (valores para las etiquetas), values (valores de los datos) y title (título de la gráfica).
*
*   Retorno: ninguno.
*/
function pieGraph(canvas, legends, values, title) {
    // Se declara un arreglo para guardar códigos de colores en formato hexadecimal.
    let colors = ["#0a1733", "#0a1733", "#11295c", "#183b85", "#2151b8"]
    // Se establece el contexto donde se mostrará el gráfico, es decir, se define la etiqueta canvas a utilizar.
    const context = document.getElementById(canvas).getContext('2d');
    // Se crea una instancia para generar la gráfica con los datos recibidos.
    const chart = new Chart(context, {
        type: 'pie',
        data: {
            labels: legends,
            datasets: [{
                data: values,
                backgroundColor: colors
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: title
            }
        }
    });
}

/*
*   Función para generar una gráfica de doughnut. Requiere el archivo chart.js para funcionar.
*
*   Parámetros: canvas (identificador de la etiqueta canvas), legends (valores para las etiquetas), values (valores de los datos) y title (título de la gráfica).
*
*   Retorno: ninguno.
*/
function doughnutGraph(canvas, legends, values, title) {
    // Se declara un arreglo para guardar códigos de colores en formato hexadecimal.
    let colors = ["#0a1733", "#0a1733", "#11295c", "#183b85", "#2151b8"]
    // Se establece el contexto donde se mostrará el gráfico, es decir, se define la etiqueta canvas a utilizar.
    const context = document.getElementById(canvas).getContext('2d');
    // Se crea una instancia para generar la gráfica con los datos recibidos.
    const chart = new Chart(context, {
        type: 'doughnut',
        data: {
            labels: legends,
            datasets: [{
                data: values,
                backgroundColor: colors
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: title
            }
        }
    });
}


/*
*   Función para generar una gráfica de area polar. Requiere el archivo chart.js para funcionar.
*
*   Parámetros: canvas (identificador de la etiqueta canvas), legends (valores para las etiquetas), values (valores de los datos) y title (título de la gráfica).
*
*   Retorno: ninguno.
*/
function polarGraph(canvas, legends, values, title) {
    // Se declara un arreglo para guardar códigos de colores en formato hexadecimal.
    let colors = ["#0a1733", "#0a1733", "#11295c", "#183b85", "#2151b8"]
    // Se establece el contexto donde se mostrará el gráfico, es decir, se define la etiqueta canvas a utilizar.
    const context = document.getElementById(canvas).getContext('2d');
    // Se crea una instancia para generar la gráfica con los datos recibidos.
    const chart = new Chart(context, {
        type: 'polarArea',
        data: {
            labels: legends,
            datasets: [{
                data: values,
                backgroundColor: colors
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: title
            }
        }
    });
}

/*
*   Función para generar una gráfica de lineas verticales. Requiere el archivo chart.js para funcionar.
*
*   Parámetros: canvas (identificador de la etiqueta canvas), xAxis (datos para el eje X), yAxis (datos para el eje Y), legend (etiqueta para los datos) y title (título de la gráfica).
*
*   Retorno: ninguno.
*/
function lineGraph(canvas, xAxis, yAxis, legend, title) {
    // Se establece el contexto donde se mostrará el gráfico, es decir, se define la etiqueta canvas a utilizar.
    const context = document.getElementById(canvas).getContext('2d');
    // Se crea una instancia para generar la gráfica con los datos recibidos.
    const chart = new Chart(context, {
        type: 'line',
        data: {
            labels: xAxis,
            datasets: [{
                label: legend,
                data: yAxis,
                borderColor: '#170a59',
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            legend: {
                display: false
            },
            title: {
                display: true,
                text: title
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        precision: 0
                    }
                }]
            }
        }
    });
}

function searchCards(api, form) {
    fetch(api + 'search', {
        method: 'post',
        body: new FormData(document.getElementById(form))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                    fillCards(response.dataset);
                    sweetAlert(1, response.message, null);
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


function CheckPassword(inputtxt) {
    var inputtxt = document.getElementById(input);
    var decimal = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
    if (inputtxt.value.match(decimal)) {
        inputtxt.classList.remove("success");
        return true;
    }
    else {
        inputtxt.classList.remove("error");
        return false;
    }
}