<?php

class Model {

    protected $conexion;

    public function __construct($dbname, $dbuser, $dbpass, $dbhost) {
        $mvc_bd_conexion = mysql_connect($dbhost, $dbuser, $dbpass);

        if (!$mvc_bd_conexion) {
            die('No ha sido posible realizar la conexión con la base de datos: ' . mysql_error());
        }
        mysql_select_db($dbname, $mvc_bd_conexion);

        mysql_set_charset('utf8');

        $this->conexion = $mvc_bd_conexion;
    }

    public function bd_conexion() {
        
    }

    public function dameAlimentos() {
        $sql = "select * from alimentos order by energia desc";

        $result = mysql_query($sql, $this->conexion);

        $alimentos = array();
        while ($row = mysql_fetch_assoc($result)) {
            $alimentos[] = $row;
        }

        return $alimentos;
    }

    public function buscarAlimentosPorNombre($nombre) {
        $nombre = htmlspecialchars($nombre);

        $sql = "select * from alimentos where nombre like '" . $nombre . "' order by energia desc";

        $result = mysql_query($sql, $this->conexion);

        $alimentos = array();
        while ($row = mysql_fetch_assoc($result)) {
            $alimentos[] = $row;
        }

        return $alimentos;
    }

    public function busquedaCombinada($parametros) {

        $where = "WHERE 1=1 ";
        foreach ($parametros as $clave => $valor) {
            if ($valor!=null) {
                if (substr(strrev($clave), 0, 3) == "xam") {
                    $where .= " AND " . substr($clave,0,strlen($clave)-4) . " <= " . $valor;
                } else {
                    $where .= " AND " . substr($clave,0,strlen($clave)-4) . " >= " . $valor;
                }
            }
        }

        $sql = "select * from alimentos " . $where . " order by energia desc";
        $result = mysql_query($sql, $this->conexion);
        $alimentos = array();
        while ($row = mysql_fetch_assoc($result)) {
            $alimentos[] = $row;
        }

        return $alimentos;
    }

    public function buscarPorEnergia($energia_min, $energia_max) {
        $sql = "select * from alimentos where energia between " . $energia_min . " and " . $energia_max . " order by energia desc";

        $result = mysql_query($sql, $this->conexion);

        $alimentos = array();
        while ($row = mysql_fetch_assoc($result)) {
            $alimentos[] = $row;
        }

        return $alimentos;
    }

    public function dameAlimento($id) {
        $id = htmlspecialchars($id);

        $sql = "select * from alimentos where id=" . $id;

        $result = mysql_query($sql, $this->conexion);

        $alimentos = array();
        $row = mysql_fetch_assoc($result);

        return $row;
    }

    public function insertarAlimento($n, $e, $p, $hc, $f, $g) {
        $n = htmlspecialchars($n);
        $e = htmlspecialchars($e);
        $p = htmlspecialchars($p);
        $hc = htmlspecialchars($hc);
        $f = htmlspecialchars($f);
        $g = htmlspecialchars($g);

        $sql = "insert into alimentos (nombre, energia, proteina, hidratocarbono, fibra, grasatotal) values ('" .
                $n . "'," . $e . "," . $p . "," . $hc . "," . $f . "," . $g . ")";

        $result = mysql_query($sql, $this->conexion);

        return $result;
    }

    public function validarDatos($n, $e, $p, $hc, $f, $g) {
        return (is_string($n) &
                is_numeric($e) &
                is_numeric($p) &
                is_numeric($hc) &
                is_numeric($f) &
                is_numeric($g));
    }

}