<?php
require_once '../Model/conexion.class.php';
$link = new conexionclass();
$link->conectarse();
//***********************************************
//*** Recoger el Codigo de la Escritura *****
//***********************************************

$nombre = strtoupper($_REQUEST['nombres']);
$paterno = strtoupper($_REQUEST['paterno']);
$materno = strtoupper($_REQUEST['materno']);
$otros = strtoupper($_REQUEST['otros']);
//*************************************************************
//*************************************************************
//****** Registra en TABLA : ESCRITURAS   *********************
//******                          		  *********************
//*************************************************************
//*************************************************************

$query = "INSERT INTO involucrados1 (Cod_inv, Pat_inv, Mat_inv, Nom_inv, otros) ";
$query.= "VALUES ('', '$paterno', '$materno', '$nombre', '$otros')";
$result = mysql_query($query) or die(mysql_error());

$consulta1 = "SELECT * FROM involucrados1";
$eject = mysql_query($consulta1);
while($last = mysql_fetch_array($eject)){
   $r = $last[0];
}
//*** ingreso de Datos ****
$cod_inv = $r+1;

print "<meta http-equiv=Refresh content=\"0 ; url=../View/Personal/favorecidos.php?codigo_otorgante=$cod_inv\">";
echo "<script language=javascript type=text/javascript> alert('Ingresado Correctamente.'); </script>";
exit();
?>
