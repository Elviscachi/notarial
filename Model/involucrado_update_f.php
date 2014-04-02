<?php
require_once '../Model/cone.php';
$link = new conexionclass();
$link->Conectado();
//***********************************************
//*** Recoger el Codigo de la Escritura *****
//***********************************************
$cod_otor = $_REQUEST['codigo_otor'];
$cod_favor = $_REQUEST['codigo_favor'];

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

$query = "UPDATE involucrados1 SET otros = '$otros' WHERE cod_inv = $cod_favor";
$result = mysql_query($query) or die(mysql_error());

print "<meta http-equiv=Refresh content=\"0 ; url=../View/Personal/ingreso.php?Codigo_otorgante=$cod_otor;&Codigo_favorecido=$cod_favor;\">";
echo "<script language=javascript type=text/javascript> alert('Dato: Agregado/Modificado Correctamente.'); </script>";
exit();
?>
