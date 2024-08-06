<?php
class MySQL {
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli("127.0.0.1", "root", "", "prueba_tecnica");

        if ($this->conexion->connect_error) {
            die("Connection failed: " . $this->conexion->connect_error);
        }

        $this->conexion->set_charset("utf8");
    }

    public function query($consulta) {
        $resultado = $this->conexion->query($consulta);

        if (!$resultado) {
            throw new Exception('MySQL Error: ' . $this->conexion->error);
        }

        return $resultado;
    }

    public function fetch_array($consulta) {
        return $consulta->fetch_array();
    }

    public function fetch_associative_array($consulta) {
        return $consulta->fetch_assoc();
    }

    public function escape_string($string) {
        return $this->conexion->real_escape_string($string);
    }

    public function HallaValorUnico($consulta) {
        $val = $this->query($consulta);
        $data = $this->fetch_array($val);
        return $data[0];
    }

    public function Totalregistros($consulta) {
        $val = $this->query($consulta);
        $row_cnt = $val->num_rows;
        return $row_cnt;
    }
}
?>