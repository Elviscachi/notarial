<?php
class ConexionClass {

    private $_usuariobd;
    private $_passworddb;
    private $_hostdb;
    private $_baseDatos;
    private $conexion;
    private $total_consultas;
    public $consulta;

    function __construct() {
        $this->_usuariobd = "root";
        $this->_passworddb = "admin";
        $this->_hostdb = "localhost";
        $this->_baseDatos = "dbarp";
    }

    public function Conectado() {
        $this->conexion = mysql_connect($this->_hostdb, $this->_usuariobd, $this->_passworddb) or die(mysql_error());
        $this->_baseDatos = mysql_select_db($this->_baseDatos, $this->conexion) or die(mysql_error());
        @mysql_query("SET NAMES 'utf8'");
        //echo "Conexion Establecida, con Base de datos ".$this->_baseDatos." en el Servidor ".$this->_hostdb;
    }

    public function consulta($consulta) {
        $this->total_consultas++;
        $resultado = mysql_query($consulta, $this->conexion);
        if (!$resultado) {
            echo 'MySQL Error en la Consulta: ' . mysql_error();
            exit;
        }
        return $resultado;
    }
	
	public function insertar($sql) {
        $this->total_consultas++;
        $resultado = mysql_query($sql, $this->conexion);
        if (!$resultado) {
            echo 'MySQL Error Insertando: ' . mysql_error();
            exit;
        }
        return $resultado;
    }
	
	public function actualizar($sql) {
        $this->total_consultas++;
        $resultado = mysql_query($sql, $this->conexion);
        if (!$resultado) {
            echo 'MySQL Error Actualizando: ' . mysql_error();
            exit;
        }
        return $resultado;
    }
	
    public function fetch_array($consulta) {
        return mysql_fetch_array($consulta);
    }

    public function num_rows($consulta) {
        return mysql_num_rows($consulta);
    }

    public function getTotalConsultas() {
        return $this->total_consultas;
    }

    public function cerrarConexion() {
        return mysql_close();
    }

    public function CrearProyecto($personal, $notario, $libro, $numLibro, $folioInicial, $foliofinal, $obs) {
        $fechaCreacion = date("Y-m-d"); //Fecha actual del sistema
        $fechaCierre = 'NULL';
        $cerrado = 0; // 0=Proyecto Abierto  1=Proyecto Cerrado
        //SQL para Insertar los Datos del Proyecto a la Tabla


        $insertar = "INSERT INTO  proyectos(codProyecto ,codUsuario ,codNotario ,libro ,numLibro ,folioInicial ,folioFinal ,fechaCreacion ,fechaCierre ,cerrado ,observaciones) ";
        $insertar .="VALUES (NULL , '$personal', '$notario',  '$libro',  '$numLibro',  '$folioInicial',  '$foliofinal',  '$fechaCreacion', NULL ,  '0',  '$obs');";
        $query = mysql_query($insertar, $this->conexion) or die(mysql_error());
        echo "Proyecto creado";
        return $query;
    }

}
?>
