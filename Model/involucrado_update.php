<?php
require_once '../Model/cone.php';
$link = new conexionclass();
$link->conectarse();
//***********************************************
//*** Recoger el Codigo de la Escritura *****
//***********************************************
$cod_inv = $_REQUEST['codigo_otor'];
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

$query = "UPDATE involucrados1 SET otros = '$otros' WHERE cod_inv = $cod_inv";
$result = mysql_query($query) or die(mysql_error());

print "<meta http-equiv=Refresh content=\"0 ; url=../View/Personal/favorecidos.php?codigo_otorgante=$cod_inv\">";
echo "<script language=javascript type=text/javascript> alert('Dato: Agregado/Modificado Correctamente.'); </script>";
exit();
?>
