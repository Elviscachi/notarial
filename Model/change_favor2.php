<?php
session_start();
require_once '../Model/cone.php';
$link = new conexionclass();
$link->Conectado();

$cod_sct=$_REQUEST['escritura'];
$otorgante=$_REQUEST['otorgante'];
$favorecido=$_REQUEST['favorecido'];
$otor_juri=$_REQUEST['otor_juri'];
$favor_juri=$_REQUEST['favor_juri'];

//printf("Escritura : %d - Otorgante: %d - Favorecido:%d - Otor_juri: %d  - Favor_juri: %d",$cod_sct,$otorgante,$favorecido,$otor_juri,$favor_juri);

$q_otor = "UPDATE escriotor1 SET cod_inv = '$otorgante' WHERE escriotor1.cod_sct = $cod_sct LIMIT 1";
$q_fav = "UPDATE escrifavor1 SET cod_inv = '$favorecido' WHERE escrifavor1.cod_sct =$cod_sct LIMIT 1";
$q_ot_juri = "UPDATE escriotor1 SET cod_inv_ju = '$otor_juri' WHERE escriotor1.cod_sct =$cod_sct LIMIT 1";
$q_fav_juri = "UPDATE escrifavor1 SET cod_inv_ju = '$favor_juri' WHERE escrifavor1.cod_rel =$cod_sct LIMIT 1";

$result1 = mysql_query($q_otor) or die (mysql_error);
$result2 = mysql_query($q_fav) or die (mysql_error);
$result3 = mysql_query($q_ot_juri) or die (mysql_error);
$result4 = mysql_query($q_fav_juri) or die (mysql_error);

print "<script type='text/javascript'>history.back(-1);</script>";
?>