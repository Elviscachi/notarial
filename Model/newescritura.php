<?
require_once '../Model/cone.php';
$link = new conexionclass();
$link->Conectado();

	$last_sct =mysql_query("SELECT codsct FROM contador ORDER BY codsct DESC");
	$num_sct1=mysql_fetch_array($last_sct);
	$cod_sct2 =  $num_sct1[0] + 1;

    /*$sql="INSERT INTO contador VALUES('$cod_sct2')";
	$insert = mysql_query($sql) or die (mysql_error);
	$_SESSION['codigo_escritura'] = $cod_sct2;*/
	header("Location:../View/Personal/otorgantes.php");
?>