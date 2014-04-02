<?php
session_start();
if(isset($_SESSION['user'])){
require_once '../../Model/consultas_notarios.class.php';
require_once '../../Model/cone.php';
$link = new ConexionClass();
$link->Conectado();

$nombres = $_REQUEST['nombres'];
$paterno = $_REQUEST['paterno'];
$materno = $_REQUEST['materno'];

$consulta = new consultas_notariosclass();
$consulta->notarios($nombres, $paterno, $materno, $codigo, $nom_not, $pat_not, $mat_not);

$codigo_usuario=$_SESSION['user'];
$cons1 = "SELECT CONCAT(nom_usu,' ',pat_usu,' ',mat_usu) AS Trabajor FROM usuarios WHERE cod_usu = $codigo_usuario";
$query = mysql_query($cons1);
@$dato1 = mysql_fetch_array($query);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=es-iso-8859-1" /> 
<link rel="stylesheet" type="text/css" href="../../css/style_ingreso.css">
<link rel="stylesheet" href="../../css/normalize.css">
<title>Busqueda</title>
<style type="text/css">
<!--
.Estilo5 {color: #CCCCCC}
-->
</style>
</head>
<body >
<table width="1055" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="600" rowspan="2"><img src="../imagenes/Banner2.jpg" alt="banner" width="600" height="100" /></td>
    <td height="55">Usuario en el Sistema:<span class="Estilo5">
      <?=$dato1[0];?>
    </span></td>
  </tr>
  <tr>
    <td> Regresar - Volver atras | <a href="../../Controler/session_close.php">Salir del Sistema</a></td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="">
<table width="644" height="46" border="0" align="center" cellpadding="0" cellspacing="1" background="Fondo.jpg">
      <tr>
        <td align="center">Apellidos Paterno</td>
    	<td align="center">Apellido Materno</td>    	
    	<td align="center">Nombres</td>
  	    <td align="center">&nbsp;</td>
  	    <td align="center">&nbsp;</td>
      </tr>
  <tr>
        <td align="center"><input type="text" name="paterno" id="paterno" value="<?=$paterno;?>" /></td>
        <td align="center"><input type="text" name="materno" id="materno" value="<?=$materno;?>" /></td>
        <td align="center"><input type="text" name="nombres" id="nombres" value="<?=$nombres;?>" /></td>
        <td align="center"><input type="submit" name="button" id="button" value="Buscar" /></td>
        <td align="center"><input type="reset" name="reset" id="reset" value="reset" /></td>
</table>
</form>
<!-- AREA DE RESULTADOS DE LA BASE DE DATOS  -->
    <table width="563" height="70" align="center" cellpadding="0" cellspacing="1" background="Fondo.jpg" border="1">
    	<tr>
       	 <td width="181" align="center"></td>
       	 <td width="179" align="center"><h3><u>R e s u l t a d o</u></h3></td>
       	 <td></td>
     	</tr>
      <tr>
        <td width="181" align="center">Apellidos Paterno</td>
        <td width="179" align="center">Apellido Materno</td>
        <td width="119" align="center">Nombres</td>
      </tr>
      
          <?

          
          ?>
       <tr>   
          <td align="center">
              <input type="hidden" name="codigo" id="codigo" value="<?=$codigo;?>" />
              <?=$nom_not;?></td>
          <td align="center"><?=$pat_not;?></td>
          <td align="center"><?=$mat_not;?></td>
          <td width="62" align="center">
                <input name="enviar" type="submit" class="boton" id="enviar" value="Agregar" />
          </td>
      </tr>  
          <?
          
          ?>
     
    </table>

</body>
</html>
<?
}
else
{
	print "<meta http-equiv=Refresh content=\"0 ; url= ../../index.php\">";
}
?>