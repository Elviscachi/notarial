<?php 
require_once '../../../Model/cone.php';
$link = new ConexionClass();
$link->Conectado();

$cod_sct=$_REQUEST['escritura3'];
$obs=addslashes($_REQUEST['obs']);

$observaciones = "UPDATE escrituras1 SET obs_sct = '$obs' WHERE cod_sct = '$cod_sct' LIMIT 1";

$result1 = mysql_query($observaciones) or die (mysql_error()."Error actualizando otorgantes");

print "<script type='text/javascript'>history.back(-1);</script>";
?>
