<?php
require_once '../../../Model/cone.php';
$link = new ConexionClass();
$link->Conectado();

$cod_sct=$_REQUEST['escritura'];
$otorgante=$_REQUEST['otorgante'];
$favorecido=$_REQUEST['favorecido'];
$otor_juri=$_REQUEST['otor_juri'];
$favor_juri=$_REQUEST['favor_juri'];

$numeroEscritura=$_REQUEST['escritura2'];
$protocolo = $_REQUEST['protocolo'];
$numeroFolio = $_REQUEST['folio'];
$fecha=$_REQUEST['fecha'];
$bien=$_REQUEST['bien'];

$q_otor = "UPDATE escriotor1 SET cod_inv = '$otorgante' WHERE escriotor1.cod_sct = $cod_sct LIMIT 1";
$q_fav = "UPDATE escrifavor1 SET cod_inv = '$favorecido' WHERE escrifavor1.cod_sct =$cod_sct LIMIT 1";
$q_ot_juri = "UPDATE escriotor1 SET cod_inv_ju = '$otor_juri' WHERE escriotor1.cod_sct =$cod_sct LIMIT 1";
$q_fav_juri = "UPDATE escrifavor1 SET cod_inv_ju = '$favor_juri' WHERE escrifavor1.cod_sct =$cod_sct LIMIT 1";
$chageEscrituras = "UPDATE escrituras1 SET num_sct = '$numeroEscritura', fec_doc = '$fecha', cod_pro = '$protocolo', num_fol = '$numeroFolio', nom_bie = '$bien' WHERE escrituras1.cod_sct = '$cod_sct' LIMIT 1";


$result1 = mysql_query($q_otor) or die (mysql_error()."Error actualizando otorgantes");
$result2 = mysql_query($q_fav) or die (mysql_error()." Error actualizando favorecidos");
$result3 = mysql_query($q_ot_juri) or die (mysql_error(). " Error Actualizando Otorgantes Juridicos");
$result4 = mysql_query($q_fav_juri) or die (mysql_error(). " Error Actualizando favorecidos juridicos");
$result5 = mysql_query($chageEscrituras) or die (mysql_error()." Error actualizando escritura");

print "<script type='text/javascript'>history.back(-1);</script>";
?>