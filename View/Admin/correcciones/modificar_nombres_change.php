<?php 
require_once '../../../Model/cone.php';
$link = new ConexionClass();
$link->Conectado();

$Cod_inv = $_REQUEST['cod_inv'];
$Pat_inv = $_REQUEST['paterno'];
$Mat_inv = $_REQUEST['materno'];
$Nom_inv = $_REQUEST['nombres'];
$otros = $_REQUEST['otros'];

$sql = "UPDATE involucrados1 SET  Pat_inv = '$Pat_inv' , Mat_inv = '$Mat_inv' , Nom_inv = '$Nom_inv' , otros = '$otros' WHERE Cod_inv = '$Cod_inv';";
$query = mysql_query($sql) or die(mysql_error()." Error Actualizando");

print "<script type='text/javascript'>history.back(-1);</script>";
?>
