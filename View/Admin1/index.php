<?php 
session_start();
if(isset($_SESSION['user'])){

require_once '../../Model/cone.php';
$link = new ConexionClass();
$link->Conectado();

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
<title>Inicio - ARP</title>
<style type="text/css">
<!--
body {
	background-image: url(imagenes/fondo.jpg);
	background-color: #3c5e83;	
}
.Estilo3 {color: #0066FF}
.Estilo4 {
	font-size: 24px
}
-->
</style>
</head>
<body bgproperties="fixed">
<img src="../imagenes/banner_sup.jpg" width="750" height="114" />
<table width="751" height="310" border="0" align="center">
  <tr>
    <td width="776"><div align="center">
      <div align="center"><br />
        <table width="480" border="0" >
          <tr>
            <td colspan="3"><img src="../imagenes/escrituras.png" alt="" width="480" height="32" /></td>
          </tr>
          <tr height="50">
            <td width="152" align="center"><img src="../imagenes/ingreso.png" alt="" width="66" height="50" /></td>
            <td width="153" align="center"><img src="../imagenes/buscar.png" alt="" width="63" height="50" /></td>
            <td width="153" align="center"><img src="../imagenes/modificar.jpg" alt="" width="63" height="50" /></td>
          </tr>
          <tr>
            <td align="center"><input name="Buscar" type="button" class="boton" value="Ver Ingreso a Base de Datos" onclick="javascript:location.href='./report_ingreso.php'"/></td>
            <td align="center"><input name="Busca2"  type="button" class="boton" onclick="busca()" value="Buscar"/></td>
            <td align="center"><input name="Busca"  type="button" class="boton" onclick="busca()" value="Modificar"/></td>
          </tr>
        </table>
        <br />
        <table width="480" border="0" >
          <tr>
            <td colspan="3" align="center"><img src="../imagenes/notarios.png" alt="" width="480" height="32" /></td>
          </tr>
          <tr>
            <td width="153" align="center"><img src="../imagenes/notario.gif" width="89" height="50" /></td>
            <td width="153" align="center"><img src="../imagenes/buscar2.png" alt="" width="71" height="50" /></td>
            <td width="152" align="center"><img src="../imagenes/notario.gif" alt="" width="89" height="50" /></td>
          </tr>
          <tr>
            <td align="center"><input name="Ingreso2" type="button" class="boton" value="Agregar Mensual" onclick="javascript:location.href='./report_ingreso_mensual.php'"/></td>
            <td align="center"><input name="Ingreso" type="button" class="boton" onclick="ingreso()" value="Buscar"/></td>
            <td align="center"><p>
              <input name="Ingreso4" type="button" class="boton" onclick="ingreso()" value="Lista de Notarios"/>
            </p>
              <p>&nbsp; </p></td>
          </tr>
          </table>
        <br />
      </div></td>
  </tr>
</table>
</body>
</html>
<?php
}
else
{
	print "<meta http-equiv=Refresh content=\"0 ; url= ../../index.php\">";
}
?>
