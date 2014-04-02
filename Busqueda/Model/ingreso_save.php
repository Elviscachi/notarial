<?php
session_start();
require_once '../Model/conexion.class.php';
$link = new conexionclass();
$link->conectarse();
//***********************************************
//*** Recoger el Codigo de la Escritura *****
//***********************************************

$cod_inv_ot = $_REQUEST['codigo_otorgantes'];
$cod_inv_f = $_REQUEST['codigo_favorecidos'];

$num_sct = $_REQUEST['nescritura'];
$cod_pro = $_REQUEST['protocolo'];
$num_fol = $_REQUEST['nfolios'];
$can_fol = $_REQUEST['tfolios'];
$cod_sub = $_REQUEST['subserie'];
$cod_dst = $_REQUEST['distritos'];
$nom_bie = strtoupper($_REQUEST['nbien']);
//Fecha
$dia = $_REQUEST['dia'];
$mes = $_REQUEST['mes'];
$year = $_REQUEST['year'];

$fec_doc = $year."/".$mes."/".$dia;
$cod_not = $_REQUEST['notario'];
$obs_sct = strtoupper($_REQUEST['obs']);
$cod_usu = $_SESSION['user'];
//Fecha Actual de la PC
$hra_ing = date("Y-m-d H:n:s");

//*************************************************************
//*************************************************************
//****** Registra en TABLA : ESCRITURAS   *********************
//******                          		  *********************
//*************************************************************
//*************************************************************

$query = "INSERT INTO escrituras1 (cod_sct, cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol, cod_usu, hra_ing)  ";
$query.= "VALUES ('', '$cod_not', '$num_sct', '$cod_dst', '$fec_doc', '$cod_sub', '$nom_bie', '$can_fol', '$cod_pro', '$obs_sct','$num_fol', '$cod_usu','$hra_ing')";
$result = mysql_query($query) or die(mysql_error());

//***********************************************************
//***********************************************************
//****** Registra en TABLA: ESCRIOTOR   *********************
//******                          		*********************
//***********************************************************
//***********************************************************

$query2 = "INSERT INTO escriotor1 (cod_rel, cod_sct, cod_inv, cod_per)  VALUES ('', '$cod_sct', '$cod_inv_ot', '$cod_usu')";
$result2 = mysql_query($query2) or die (mysql_error);
//***********************************************************
//***********************************************************
//****** Registra en TABLA: ESCRIFAVOR  *********************
//******                          		*********************
//***********************************************************
//***********************************************************

$query3 = "INSERT INTO escrifavor1 (cod_rel, cod_sct, cod_inv, cod_per) VALUES ('', '$cod_sct', '$cod_inv_f', '$cod_usu')";
$result3 = mysql_query($query3) or die (mysql_error);

print "<meta http-equiv=Refresh content=\"0 ; url=../View/Personal/index.php\">";
print "<script type='text/javascript'>alert('Dato Ingresado');</script>";
exit();
?>