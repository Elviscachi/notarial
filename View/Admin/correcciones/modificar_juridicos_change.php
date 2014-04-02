<?php 
require_once '../../../Model/cone.php';
$link = new ConexionClass();
$link->Conectado();

$Cod_inv = $_REQUEST['cod_inv'];
$razon = $_REQUEST['razon'];
$otros = $_REQUEST['otros'];

$sql = "UPDATE involjuridicas1 SET Raz_inv = '$razon', otros_juri = '$otros' WHERE Cod_inv ='$Cod_inv';";
$query = mysql_query($sql) or die(mysql_error()." Error Actualizando");

print "<script type='text/javascript'>alert('Corregido Correctamente');history.back(-1);</script>";
?>
