<?php
class MySQL
{
    protected $conexion;
    protected $total_consultas;
    

    public function MySQL(){
        if(!isset($this->conexion)){
            $this->conexion = (mysql_connect("localhost","root","admin")) or die(mysql_error());
            $db = mysql_select_db("dbarp",$this->conexion) or die(mysql_error());
            }
    }  
    public function consulta($consulta){
        $this->total_consultas++;  
        $resultado = mysql_query($consulta,$this->conexion);  
        if(!$resultado){  
            echo 'MySQL Error: ' . mysql_error();  
            exit;  
            }  
           
        return $resultado;
     }  
     
     public function fetch_array($consulta){   
         return mysql_fetch_array($consulta);  
     }  
     
     public function num_rows($consulta){   
         return mysql_num_rows($consulta);  
     }  
     
     public function getTotalConsultas(){  
         return $this->total_consultas;  
     }  
}
?>
