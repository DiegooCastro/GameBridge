<?php
/*
*	Clase para manejar la tabla categorias de la base de datos. Es clase hija de Validator.
*/
class Categorias extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $nombre = null;
    private $imagen = null;
    private $descripcion = null;
    private $ruta = '../../../resources/img/categorias/';

    /*
    *   Métodos para asignar valores a los atributos.
    */
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombre($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->nombre = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setImagen($file)
    {
        if ($this->validateImageFile($file, 500, 500)) {
            $this->imagen = $this->getImageName();
            return true;
        } else {
            return false;
        }
    }

    public function setDescripcion($value)
    {
        if ($value) {
            if ($this->validateString($value, 1, 250)) {
                $this->descripcion = $value;
                return true;
            } else {
                return false;
            }
        } else {
            $this->descripcion = null;
            return true;
        }
    }

    /*
    *   Métodos para obtener valores de los atributos.
    */
    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value,$value2,$value3,$value4)
    {
        $sql = 'SELECT idProducto as id,c.categoria,e.estado,m.marca,producto,precio,descripcion, imagen
                FROM productos p
                INNER JOIN categorias c ON c.idCategoria = p.Categoria
                INNER JOIN estadoProductos e ON e.idEstado = p.estado
                INNER JOIN marcas m ON m.idMarca = p.marca
                WHERE c.categoria = ? AND p.estado = 1 AND p.precio BETWEEN ? AND ? and c.seccion = ?
                order by p.precio';
        $params = array($value, $value2, $value3, $value4);
        return Database::getRows($sql, $params);
    }

    //Método para crear una categoría
    public function createRow()
    {
        $sql = 'INSERT INTO categorias(nombre_categoria, imagen_categoria, descripcion_categoria)
                VALUES(?, ?, ?)';
        $params = array($this->nombre, $this->imagen, $this->descripcion);
        return Database::executeRow($sql, $params);
    }

    //Método para crear la sección software
    public function readAllHardware()
    {
        $sql = 'SELECT idcategoria as id, seccion,categoria
        FROM categorias 
		WHERE seccion = 1
        ORDER BY idcategoria';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Método para crear la sección software
    public function readAllPerifericos()
    {
        $sql = 'SELECT idcategoria as id, seccion,categoria
        FROM categorias 
		WHERE seccion = 2
        ORDER BY idcategoria';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Método para crear la sección accesorios
    public function readAllAccesorios()
    {
        $sql = 'SELECT idcategoria as id, seccion,categoria
        FROM categorias 
		WHERE seccion = 3
        ORDER BY idcategoria';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //Método para cargar los datos de un producto seleccionado
    public function readOne()
    {
        $sql = 'SELECT idProducto as id,c.categoria,e.estado,m.marca,producto,precio,descripcion, imagen ,cantidad 
        FROM productos p
        INNER JOIN categorias c ON c.idCategoria = p.Categoria
        INNER JOIN estadoProductos e ON e.idEstado = p.estado
        INNER JOIN marcas m ON m.idMarca = p.marca
        WHERE idProducto = ? AND p.estado = 1';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    //Método para cargar los datos de un producto seleccionado
    public function updateRow($current_image)
    {
        // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
        if ($this->imagen) {
            $this->deleteFile($this->getRuta(), $current_image);
        } else {
            $this->imagen = $current_image;
        }

        $sql = 'UPDATE categorias
                SET imagen_categoria = ?, nombre_categoria = ?, descripcion_categoria = ?
                WHERE id_categoria = ?';
        $params = array($this->imagen, $this->nombre, $this->descripcion, $this->id);
        return Database::executeRow($sql, $params);
    }

    //Metodo para eliminar una categoria
    public function deleteRow()
    {
        $sql = 'DELETE FROM categorias
                WHERE id_categoria = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    //Metodo para cargar los productos de una categoria
    public function readProductosCategoria()
    {
        $sql = 'SELECT idProducto as id,c.categoria as cat,e.estado,m.marca,producto,precio,descripcion, imagen,c.idcategoria
        FROM productos p
        INNER JOIN categorias c ON c.idCategoria = p.Categoria
        INNER JOIN estadoProductos e ON e.idEstado = p.estado
        INNER JOIN marcas m ON m.idMarca = p.marca
        WHERE c.idCategoria = ? AND p.estado = 1
        order by c.categoria';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }
}
