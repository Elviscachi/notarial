<?php
	require_once '../../../Model/cone.php';
	$link= new ConexionClass();
	$link->Conectado();
	
	//Recoger el Valor dlel combobox;
	$new_subserie=$_REQUEST['subserie'];
	$cod_sct = $_REQUEST['escritura'];
	
	$sql="UPDATE escrituras1 SET cod_sub = $new_subserie WHERE cod_sct=$cod_sct LIMIT 1;";
	$link->actualizar($sql);
	print "<script type='text/javascript'>history.back(-1);</script>";
?>
