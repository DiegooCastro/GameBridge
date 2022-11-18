<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/categorias_producto.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    session_start();
    $categorias = new Categorias;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    if (isset($_SESSION['idusuario'])) {
        switch ($_GET['action']) {
            // Metodo para cargar todos los datos
            case 'readAll': 
                // Ejecutamos el metodo para cargar los datos 
                if ($result['dataset'] = $categorias->readAll()) {
                    $result['status'] = 1;
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay categrias registrados';
                    }
                }
                break;
                // Metodo para ejecutar la busqueda filtrada
                case 'search': 
                    $_POST = $categorias->validateForm($_POST);
                    if ($_POST['search'] != '') {
                        // Ejecutamos la funcion que realiza la busqueda filtrada
                        if ($result['dataset'] = $categorias->searchRows($_POST['search'])) {
                            $result['status'] = 1;
                            // Obtenemos el numero de filas retornadas por la consulta 
                            $rows = count($result['dataset']);
                            if ($rows > 1) {
                                $result['message'] = 'Se encontraron ' . $rows . ' coincidencias';
                            } else {
                                $result['message'] = 'Solo existe una coincidencia';
                            }
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No hay coincidencias';
                            }
                        }
                    } else {
                        $result['exception'] = 'Ingrese un valor para buscar';
                    }
                    break;
                    // Caso para ingresar registros en la base de datos
                    case 'create': 
                        // Obtenemos el form con los inputs para obtener los datos
                        $_POST = $categorias->validateForm($_POST);   
                        if ($categorias->setCategoria($_POST['txtusuario'])) {
                            if (isset($_POST['cmbTipo'])) {
                                if ($categorias->setSeccion($_POST['cmbTipo'])) {
                                    // Ejecutamos la funcion del modelo 
                                    if ($categorias->createRow()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Sección registrada correctamente';
                                    } else {
                                        $result['exception'] = Database::getException();;
                                    }                               
                                } else {
                                    $result['exception'] = 'Categoría incorrecta';
                                }
                            } else {
                                $result['exception'] = 'Seleccione una categoría';
                            }      
                        } else {
                            $result['exception'] = 'Categoría incorrecta';
                        }   
                    break;
                    // Caso para cargar los datos de un registro 
                    case 'readOne':
                        if ($categorias->setIdcategoria($_POST['txtId'])) {
                            // Ejecutamos la funcion del modelo
                            if ($result['dataset'] = $categorias->readOne()) {
                                $result['status'] = 1;
                            } else {
                                if (Database::getException()) {
                                    $result['exception'] = Database::getException();
                                } else {
                                    $result['exception'] = 'Usuario inexistente';
                                }
                            }
                        } else {
                            $result['exception'] = 'Usuario incorrecto';
                        }
                        break;
                    // Caso para modificar datos de un registro
                    case 'update': 
                        // Obtenemos el form con los inputs para obtener los datos
                        $_POST = $categorias->validateForm($_POST);
                        if ($categorias->setIdcategoria($_POST['txtId'])) {
                            if ($categorias->setSeccion($_POST['cmbTipo'])) {
                                if ($categorias->setCategoria($_POST['txtusuario'])) {
                                    // Ejecutamos la funcion del modelo
                                    if ($categorias->updateRow()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Categoria modificada correctamente';
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                } else {
                                    $result['exception'] = 'Categoría incorrecta';
                                }
                            } else {
                                $result['exception'] = 'Sección incorrecta';
                            }
                        } else {
                            $result['exception'] = 'Categoría incorrect';
                        }
                    break;
            // SI LA ACCION NO COINCIDE CON NINGUNO DE LOS CASOS MUESTRA ESTE MENSAJE
            default: 
                $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
        header('content-type: application/json; charset=utf-8');
        print(json_encode($result));
    } else {
        print(json_encode('Acceso denegado'));
    }
} else {
    print(json_encode('Recurso no disponible'));
}
