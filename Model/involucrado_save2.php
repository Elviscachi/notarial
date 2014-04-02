<?php
require_once '../Model/cone.php';
$link = new conexionclass();
$link->Conectado();
//***********************************************
//*** Recoger el Codigo de la Escritura *****
//***********************************************

$codigo_otorgante = $_REQUEST['codigo_otorgante'];
$cod_otor_juri = $_REQUEST['cod_otor_juri'];

$nombre = strtoupper(trim($_REQUEST['nombres']));
$paterno = strtoupper(trim($_REQUEST['paterno']));
$materno = strtoupper(trim($_REQUEST['materno']));
$otros = strtoupper(trim($_REQUEST['otros']));
$nulo = $_REQUEST['nulo'];

//*************************************************************
//****** Registra en TABLA : ESCRITURAS   *********************
//*************************************************************

$query = "INSERT INTO involucrados1 (Pat_inv, Mat_inv, Nom_inv, otros) ";
$query.= "VALUES ('$paterno', '$materno', '$nombre', '$otros')";
$result = mysql_query($query) or die(mysql_error());

$consulta1 = "SELECT * FROM involucrados1";
$eject = mysql_query($consulta1);
while($last = mysql_fetch_array($eject)){
   $r = $last[0];
}
//*** ingreso de Datos ****
$cod_inv = $r;
print "<meta http-equiv=Refresh content=\"0 ; url=../View/Personal/ingreso.php?codigo_otorgante=".$codigo_otorgante."&codigo_favorecido=".$cod_inv."&cod_otor_juri=".$cod_otor_juri."\">";
echo "<script language=javascript type=text/javascript> alert('Ingresado Correctamente.'); </script>";
?>