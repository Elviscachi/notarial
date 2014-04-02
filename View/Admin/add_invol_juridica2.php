<?   //Para la conexion con la Base de Datos
session_start();
if(isset($_SESSION['user'])){
require_once '../../Model/cone.php';
$link = new ConexionClass();
$link->Conectado();

$cod_otor_juridica = $_REQUEST['codigo_otorgante'];

$codigo_usuario=$_SESSION['user'];
$cons1 = "SELECT CONCAT(nom_usu,' ',pat_usu,' ',mat_usu) AS Trabajor FROM usuarios WHERE cod_usu = $codigo_usuario";
$query = mysql_query($cons1);
@$dato1 = mysql_fetch_array($query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=es-iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../../css/style_ingreso.css"></link>
<link rel="stylesheet" href="../../css/normalize.css">
<title>Favorecido - ARP</title>
<style type="text/css">
<!--
.Estilo6 {color: #FFFFFF}
.Estilo5 {color: #CCCCCC}
-->
</style>
</head>

<script language="javascript" type="text/javascript">
function enviar_datos(){
    var per_juridica = document.getElementById("per_juridica").value;
	
	if( per_juridica == ""){
        alert("No ha Escrito nada en el Cuadro");
        document.getElementById("per_juridica").focus();
        return false;
    }
	if(confirm("Estas Seguro de Agregar esta Persona Juridica?")){
	   involucrados.submit();
		return true;
	}
	else
	{
		return false;
	}
}
</script>

<body>
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
<form action="../../Model/invol_juridica_save2.php" method="post" enctype="multipart/form-data" name="involucrados" id="involucrados">
  <p align="center" class="error">Agregar a: <?=$_REQUEST['nombre'];?></p>
  <div align="center">
   <table width="574" border="1" cellpadding="1" cellspacing="4" bgcolor="#CC6600">
  <tr>
       		<td colspan="3" bgcolor="#3C5E83"><div align="left"><img src="../imagenes/Pers_Juridica.jpg" width="400" height="32" /></div></td>
      </tr>
      <tr>
        <td colspan="3"><textarea name="per_juridica" id="per_juridica" cols="80" rows="4" style="text-transform:uppercase"></textarea></td>
      </tr>
      <tr>
        <td width="180"><div align="center">
          <input name="guardar" type="button" class="boton" id="guardar" value="Guardar Informaci&oacute;n" onclick="enviar_datos();"/>
        </div></td>
        <td width="183"><input type="text" name="cod_otorgante_juridica" id="cod_otorgante_juridica" value="<?=$cod_otor_juridica;?>" /></td>
        <td width="181"><input name="salir" type="button" class="boton" id="salir" value="Cancelar / Salir" /></td>
      </tr>
    </table>
  </div>
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