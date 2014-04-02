<?php
require_once '../Model/conexion.class.php';
$link = new conexionclass();
$link->conectarse();
//***********************************************
//*** Recoger el Codigo de la Escritura *****
//***********************************************

$raz_inv = strtoupper($_REQUEST['per_juridica']);

//*************************************************************
//*************************************************************
//****** Registra en TABLA : ESCRITURAS   *********************
//******                          		  *********************
//*************************************************************
//*************************************************************

$query = "INSERT INTO involjuridicas1 (Cod_inv, Raz_inv) VALUES ('', '$raz_inv')";
$result = mysql_query($query) or die(mysql_error());

$consulta1 = "SELECT * FROM involjuridicas1";
$eject = mysql_query($consulta1);
while($last = mysql_fetch_array($eject)){
   $r = $last[0];
}
//*** ingreso de Datos ****
$cod_inv_juridicas = $r+1;

print "<meta http-equiv=Refresh content=\"0 ; url=../View/Personal/favorecidos.php?codigo_otorgante=$cod_inv_juridicas\">";
echo "<script language=javascript type=text/javascript> alert('Ingresado Correctamente.'); </script>";
exit();
?>
