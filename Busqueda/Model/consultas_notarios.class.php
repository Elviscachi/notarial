<?php
/*require_once 'conexion.class.php';
$link = new conexionclass();
$link->conectarse();
*/

class consultas_notariosclass {
        
    public function &notarios($nombres,$paterno,$materno,&$codigo,&$nom_not,&$pat_not,&$mat_not){

        $query = "SELECT cod_not, pat_not,mat_not, nom_not FROM notarios ";
        $query .= "WHERE nom_not LIKE '$nombres%' AND pat_not LIKE '$paterno%' AND mat_not LIKE '$materno%' ORDER BY pat_not";
        $result = mysql_query($query);
        
        $fila = mysql_fetch_array($result);
        
        $codigo = $fila[0];
        $nom_not = $fila[1];
        $pat_not = $fila[2];
        $mat_not = $fila[3];
        
        return true;
    }
}
?>
