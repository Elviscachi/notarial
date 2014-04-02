<?php
session_start();
require_once '../../../Model/cone.php';
$link = new ConexionClass();
$link->Conectado();
//***********************************************
//*** Recoger Datos  *****
//***********************************************

$nom_usu = $_REQUEST['nom_usu'];
$pat_usu = $_REQUEST['pat_usu'];
$mat_usu = $_REQUEST['mat_usu'];
$dir_usu= $_REQUEST['dir_usu'];
$tel_usu = $_REQUEST['tel_usu'];
$login = $_REQUEST['login'];
$clave= $_REQUEST['clave1'];
$tipo= $_REQUEST['tipo'];
$hra_ing = date("Y-m-d H:n:s");

	$query = "INSERT INTO usuarios (nom_usu, pat_usu, mat_usu, log_usu, psw_usu, niv_usu, chk_usu, dir_usu, tlf_usu) ";
	$query.= "VALUES ('$nom_usu', '$pat_usu', '$mat_usu', '$login', '$clave', '2', '1', '$dir_usu', '$tel_usu')";
	$result = mysql_query($query) or die(mysql_error());

	print "<meta http-equiv=Refresh content=\"0 ; url=../index.php\">";
	print "<script type='text/javascript'>alert('Dato Ingresado');</script>";
	exit();
?>