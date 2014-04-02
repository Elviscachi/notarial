<?php
require_once '../../../Model/cone.php';
$link = new ConexionClass();
$link->Conectado();
$codigo = $_REQUEST['cod_usu'];

$sql = "SELECT * FROM involucrados1 WHERE cod_inv = '$codigo'";
$query = mysql_query($sql);
$result = mysql_fetch_array($query);

$datos = array("codigo"=>$result[0], "Paterno"=>$result[1], "Materno"=>$result[2], "Nombres"=>$result[3], "Otros"=>$result[4]);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Correción de Datos - Archivo Regional de Puno</title>
</head>

<body>
<p>Modificar Nombres del Sistema</p>
<form id="form1" name="form1" method="post" action="modificar_nombres_change.php">
  <table width="481" border="1">
    <tr>
      <td width="125">Codigo del Usuario </td>
      <td width="453"><?php echo $datos['codigo'];?><input type="hidden" name="cod_inv" value="<?php echo $datos['codigo'];?>" /></td>
    </tr>
    <tr>
      <td>Nombre(s):</td>
      <td><input name="nombres" type="text" id="nombres" value="<?php echo $datos['Nombres'];?>" size="40" /></td>
    </tr>
    <tr>
      <td>Paterno:</td>
      <td><input name="paterno" type="text" id="paterno" value="<?php echo $datos['Paterno'];?>" size="40" /></td>
    </tr>
    <tr>
      <td>Materno:</td>
      <td><input name="materno" type="text" id="materno" value="<?php echo $datos['Materno'];?>" size="40"/></td>
    </tr>
    <tr>
      <td>Otros:</td>
      <td><textarea name="otros" cols="40" id="otros"><?php echo $datos['Otros'];?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Guardar Cambios" />
      <input name="Submit2" type="button" value="Cancelar Cambios" onclick="javascript:window.close();history.back(-1);" /></td>
    </tr>
  </table>
</form>
</body>
</html>
