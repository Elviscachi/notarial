<?php
require_once '../../../Model/cone.php';
$link = new ConexionClass();
$link->Conectado();
$codigo = $_REQUEST['cod_ju'];

$sql = "SELECT * FROM involjuridicas1 WHERE Cod_inv = '$codigo'";
$query = mysql_query($sql);
$result = mysql_fetch_array($query);

$datos = array("codigo"=>$result[0], "razon"=>$result[1], "otros"=>$result[2]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=es-iso-8859-1" />
<title>Correción de Datos - Archivo Regional de Puno</title>
</head>

<body>
<form action="modificar_juridicos_change.php" name="corre" method="get">
<table width="874" border="1">
  <tr>
    <td width="139">codigo</td>
    <td width="719"><input name="cod_inv" type="hidden" id="cod_inv" value='<?php echo $datos["codigo"];?>' />
    <?php echo $datos["codigo"];?></td>
  </tr>
  <tr>
    <td>Persona Juridica </td>
    <td><input name="razon" type="text" id="razon" value='<?php echo $datos["razon"];?>' size="100" /></td>
  </tr>
  <tr>
    <td>Otros</td>
    <td><input name="otros" type="text" id="otros" value='<?php echo $datos["otros"];?>' /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Enviar" /></td>
  </tr>
</table>
</form>
</body>
</html>
