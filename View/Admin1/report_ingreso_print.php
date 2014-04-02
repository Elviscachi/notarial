<?php
session_start();
if(isset($_SESSION['user'])){
require_once '../../Model/cone.php';
$link = new ConexionClass();
$link->Conectado();

$fec_act = date("d-M-Y");
$file_type="vnd.ms-excel";

header("Content-type: application/$file_type");
header("Content-disposition: attachment; filename=Reporte_".$fec_act.".xls");
header("Pragma: no-cache");
header("Expires: 0");

$cod_usu = $_REQUEST['trab'];
$fec_ini = $_REQUEST['fecha_ini'];
$fec_fin = $_REQUEST['fecha_fin'];

if($fec_fin == ""){
   $text = "SELECT hra_ing,cod_usu,cod_sct,num_sct FROM escrituras1 ";
   $text .=" where hra_ing LIKE '$fec_ini%' ";
   $text .= "and cod_usu like '$cod_usu' order by hra_ing";

   $query = mysql_query($text);
   }
   else{
   	if($fec_ini == $fec_fin){
	
	$text = "SELECT hra_ing,cod_usu,cod_sct,num_sct FROM escrituras1 ";
    $text .=" where hra_ing LIKE '$fec_ini%' ";
    $text .= "and cod_usu like '$cod_usu' order by hra_ing";
	
    $query = mysql_query($text);
	}
	else{
	   $text = "SELECT hra_ing,cod_usu,cod_sct,num_sct FROM escrituras1 ";
	   $text .=" where hra_ing between '$fec_ini 00:00:00' and '$fec_fin 23:59:59' ";
	   $text .= "and cod_usu like '$cod_usu' order by hra_ing";
	   
	   $query = mysql_query($text);
   	}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<link rel="stylesheet" href="../../css/normalize.css">
<title>Busqueda</title>
</head>
<body >
   <h3>Reportes Diarios de Ingreso a la Base de Datos</h3>
   <table border="1">
     <tr>
       <td colspan="4">Total de Escrituras: <b>
         <?php $n = mysql_num_rows($query); echo $n;?></b></td>
     </tr>
     <tr>
       <td>Hra_Ing</td>
       <td>Usuario</td>
       <td>Cod_sct</td>
       <td>Num_Sct</td>
     </tr>
     <?php
            while($fila= mysql_fetch_array($query)){
            $datos = array("hora"=>$fila[0],"usuario"=>$fila[1],"escritura"=>$fila[2],"num_sct"=>$fila[3]);
            ?>
     <tr>
       <td><?php echo $datos["hora"];?></td>
       <td><?php echo $datos["usuario"];?></td>
       <td><?php echo $datos["escritura"];?></td>
       <td><?php echo $datos["num_sct"];?></td>
     </tr>
     <?php
            }
            ?>
   </table>
   </body>
</html>
<?php
}
else
{
    print "<meta http-equiv=Refresh content=\"0 ; url= ../../index.php\">";
}
?>
