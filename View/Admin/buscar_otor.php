<?php
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
else
    {
$query = "SELECT Cod_inv, Pat_inv, Mat_inv, Nom_inv FROM involucrados ";
$query .= "WHERE Nom_inv LIKE '$nombres%' AND Pat_inv LIKE '$paterno%' AND Mat_inv LIKE '$materno%' ORDER BY Pat_inv";
$result = mysql_query($query);
$num = mysql_num_rows($result);

    if($num == 0){
        $error = "El Otorgante que Busca, no se encuentra en la Base de Datos";
        }
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=es-iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/style_ingreso.css"></link>
<link rel="stylesheet" href="../../css/normalize.css">

<title>Busqueda</title>
<style type="text/css">

body {
	background-color: #669999;
}
</style>
<script language="javascript" type="text/javascript">
    function pasar_datos(){
        var paterno = document.getElementById("cod_not").value;
        alert("Otorgante" + paterno);
    }
</script>
</head>
<body >
<form id="notarios" name="notarios" method="post" action="">
  <table width="699" height="47" border="0" cellpadding="0" cellspacing="1" background="Admin/Fondo.jpg">
<tr>
            <td width="144" height="19" align="center">Apellidos Paterno</td>
          <td width="144" align="center">Apellido Materno</td>
          <td width="144" align="center">Nombres:</td>
          <td width="117" align="center">&nbsp;</td>
      <td width="144" align="center">&nbsp;</td>
</tr>
        <tr>
            <td align="center"></td>
            <td align="center"></td>
  	        <td align="center"></td>
  	        <td colspan="2" align="center"></td>
      </tr>
  <tr>
        <td align="center"><input type="text" name="paterno" id="paterno" value="<?=$paterno;?>" /></td>
        <td align="center"><input type="text" name="materno" id="materno" value="<?=$materno;?>" /></td>
        <td align="center"><input type="text" name="nombres" id="nombres" value="<?=$nombres;?>" /></td>
        <td align="center"><input type="submit" class="boton"name="btnbuscar" id="btnbuscar" value="Buscar" /> </td>
        <td align="center"><a href="nuevo_otor.php" target="_self" onclick="javascript:location.href='./buscar_otor.php';return true;" />Nuevo Otorgante</td>
  </tr>
</table>
</form>
<!-- AREA DE RESULTADOS DE LA BASE DE DATOS  -->
    <form name="datos" id="datos">
    <table width="591" height="70" cellpadding="1" cellspacing="2" background="Admin/Fondo.jpg" border="0">
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
          <td align="center"><input type="hidden" name="cod_not" id="cod_not" value="<?=$fila[0];?>" readonly />
          <input type="text" name="nom_not" id="nom_not" value="<?=$fila[1];?>" readonly /></td>
         <td align="center"><input type="text" name="pat_not" id="pat_not" value="<?=$fila[2];?>" readonly /></td>
           <td align="center"><input type="text" name="mat_not" id="mat_not" value="<?=$fila[3];?>" readonly /></td>
          <td width="62" align="center"><input type="button" class="boton" name="enviar" id="enviar" value="Agregar" onclick="pasar_datos()" />          </td>
         </tr>  
          <?
          }
          ?>
    </table>
    </form>
</body>
</html>
