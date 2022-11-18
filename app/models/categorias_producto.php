<?php
/*
*	Clase para manejar la tabla categorias de la base de datos. Es clase hija de Validator.
*/

class Categorias extends Validator
{

    private $idcategoria=null;
    private $categoria=null;
    private $seccion=null;

    public function setIdcategoria($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->idcategoria = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setSeccion($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->seccion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCategoria($value)
    {
        if ($this->validateAlphanumeric($value, 1, 40)) {
            $this->categoria = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getIdCategoria()
    {
        return $this->idcategoria;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function getSeccion()
    {
        return $this->seccion;
    }

    //metodo para cargar las categorias
    public function readAll()
    {
        $sql = 'SELECT c.idcategoria, s.seccion, c.categoria from categorias c 
        INNER JOIN secciones s on c.seccion=s.idseccion';
        $params = null;
        return Database::getRows($sql, $params);
    }

    //metodo para buscar categorias
    public function searchRows($value)
    {
        $sql = 'SELECT c.idcategoria, s.seccion, c.categoria from categorias c 
                INNER JOIN secciones s on c.seccion=s.idseccion
                WHERE s.seccion ILIKE ? OR c.categoria ILIKE ?
                ORDER BY categoria';
        $params = array("%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }

    //metodo para crear categorias
    public function createRow()
    {
        $sql = 'INSERT INTO categorias(categoria, seccion)
                VALUES(?, ?)';
        $params = array($this->categoria, $this->seccion);
        return Database::executeRow($sql, $params);
    }

    //metodo para cargar una categoria
    public function readOne()
    {
        $sql = 'SELECT idcategoria, categoria, seccion
                FROM categorias
                WHERE idcategoria = ?';
        $params = array($this->idcategoria);
        return Database::getRow($sql, $params);
    }

    //metodo para actualizar categorias
    public function updateRow()
    {  
        $sql = 'UPDATE categorias
                SET categoria = ?, seccion = ?
                WHERE idcategoria = ?';
        $params = array($this->categoria, $this->seccion, $this->idcategoria);
        return Database::executeRow($sql, $params);
    }

    // Metodo para cargar los productos de una categoria
    public function readProductosCategoria()
    {
        $sql = 'SELECT producto,precio,m.marca,p.cantidad
        FROM productos p 
        INNER JOIN categorias c ON c.idcategoria = p.categoria
		INNER JOIN marcas m ON m.idMarca = p.marca
        WHERE idcategoria = ? AND estado = 1	
        ORDER BY producto';
        $params = array($this->idcategoria);
        return Database::getRows($sql, $params);
    }

    // Metodo para cargar la cantidad de ventas de cada categoria
    public function readVentasCategorias()
    {
        $sql = 'SELECT SUM(d.cantidad) cantidad, p.producto,p.precio,m.marca
        FROM facturas f
        INNER JOIN detallepedidos d ON d.pedido = f.idfactura 
        INNER JOIN productos p ON p.idProducto = d.producto
        INNER JOIN marcas m ON m.idMarca = p.marca
        WHERE f.estado = 2 and p.categoria = ?
        GROUP BY p.producto,p.precio,m.marca order by cantidad DESC';
        $params = array($this->idcategoria);
        return Database::getRows($sql, $params);
    }

    // Metodo para cargar las categorias
    public function readCategoria()
    {
        $sql = 'SELECT c.idcategoria, s.seccion, c.categoria from categorias c 
        INNER JOIN secciones s on c.seccion=s.idseccion where c.idcategoria = ?';
        $params = array($this->idcategoria);
        return Database::getRows($sql, $params);
    }

    //Metodo para cargar las categorias por sección
    public function readCategoriasSeccion()
    {
        $sql = 'SELECT c.idcategoria, s.seccion, c.categoria, s.idseccion from categorias c 
        INNER JOIN secciones s on c.seccion=s.idseccion where idseccion=? ';
        $params = array($this->seccion);
        return Database::getRows($sql, $params);
    }

    






}
