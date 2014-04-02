<?php
session_start();
if(isset($_SESSION['user'])){
require_once '../../Model/cone.php';
$link = new ConexionClass();
$link->Conectado();

$nombres = $_REQUEST['nombres'];
$paterno = $_REQUEST['paterno'];
$materno = $_REQUEST['materno'];
if($nombres =="" and $paterno =="" and $materno =="")
{
    $error = "No hay Registros que mostrar";
}
else{
$query = "SELECT cod_not, pat_not,mat_not, nom_not FROM notarios ";
$query .= "WHERE nom_not LIKE '$nombres%' AND pat_not LIKE '$paterno%' AND mat_not LIKE '$materno%' ORDER BY pat_not";
$result = mysql_query($query);
$num = mysql_num_rows($result);

    if($num == 0){
        $error = "El notario que Busca no se encuentra en la Base de Datos";
    }
}

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
<title>Busqueda</title><script language="javascript" type="text/javascript">
    function pasar_datos(){
        var paterno = document.getElementById("nom_not").value;
        alert("Notario " + paterno);
    }
</script>
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
<form id="notarios" name="notarios" method="post" action="">
    <table width="580" height="51" border="0" align="center" cellpadding="0" cellspacing="1" background="Fondo.jpg">
        <tr>
            <td width="147" align="center">Apellidos Paterno</td>
          <td width="168" align="center">Apellido Materno</td>
          <td width="168" align="center">Nombres:</td>
          <td width="168" align="center">&nbsp;</td>
          <td width="168" align="center">&nbsp;</td>
      </tr>
        <tr>
            <td align="center"></td>
            <td align="center"></td>
  	        <td align="center"></td>
  	        <td align="center"></td>
            <td align="center"></td>
      </tr>
  <tr>
        <td align="center"><input type="text" name="paterno" id="paterno" value="<?=$paterno;?>" /></td>
        <td align="center"><input type="text" name="materno" id="materno" value="<?=$materno;?>" /></td>
        <td align="center"><input type="text" name="nombres" id="nombres" value="<?=$nombres;?>" /></td>
        <td align="center"><input type="submit" class="boton"name="btnbuscar" id="btnbuscar" value="Buscar" /></td>
        <td align="center"><input type="button" class="boton" name="btnsalir" id="btnsalir" value="Salir" onclick="javascript:self.close();" /></td>
  </tr>
</table>
</form>
    <!-- AREA DE RESULTADOS DE LA BASE DE DATOS  -->
    <form name="datos" id="datos">
    <table width="508" height="70" align="center" cellpadding="1" cellspacing="2" background="Fondo.jpg" border="0">
<tr>
            <td align="center" colspan="4"><h3><u>R e s u l t a d o</u></h3></td>
     	</tr>
      <tr>
          <div class="error"><?=$error;?></div>
        <td width="181" align="center">Apellidos Paterno</td>
        <td width="179" align="center">Apellido Materno</td>
        <td width="119" align="center">Nombres</td>
      </tr>
      
          <?
          while (@$fila = mysql_fetch_array($result)){
          ?>
       <tr>   
          <td align="center">
              <input type="hidden" name="cod_not" id="cod_not" value="<?=$fila[0];?>" readonly />
              <input type="text" name="nom_not" id="nom_not" value="<?=$fila[1];?>" readonly /></td>
           <td align="center"><input type="text" name="pat_not" id="pat_not" value="<?=$fila[2];?>" readonly /></td>
           <td align="center"><input type="text" name="mat_not" id="mat_not" value="<?=$fila[3];?>" readonly /></td>
          <td width="62" align="center">
          	<a href="ingreso.php?cod_not=<?=$fila[0];?>&nom_not=<?=$fila[3];?> <?=$fila[2];?> <?=$fila[1];?>">Mandar</a>
              <input type="button" class="boton" name="enviar" id="enviar" value="Agregar" onclick="pasar_datos()" />
          </td>
         </tr>  
          <?
          }
          ?>
     
    </table>
</form>
</body>
</html>
<?
}
else
{
	print "<meta http-equiv=Refresh content=\"0 ; url= ../../index.php\">";
}
?>