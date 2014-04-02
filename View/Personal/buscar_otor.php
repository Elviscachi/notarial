<?php
session_start();
if (isset($_SESSION['personal'])) {
    require_once '../../Model/cone.php';
    $link = new ConexionClass();
    $link->conectarse();

$nexo1 = "%";
$nomb = trim($_REQUEST['nombres']);
$datos1 = explode(" ",$nomb);
$nombres = trim(implode($nexo1, $datos1));
//$nombres = $_GET['nombres'];
$paterno = trim($_GET['paterno']);
$materno = trim($_GET['materno']);
$otros = trim($_GET['otros']);

if(isset ($_REQUEST["btnbuscar"])){
	$query = "SELECT cod_inv, CONCAT(nom_inv,' ',pat_inv,' ', mat_inv) as otorgante, otros FROM involucrados1 WHERE ";
	$query .= "nom_inv LIKE '%$nombres%' AND pat_inv LIKE '$paterno%' AND mat_inv LIKE '$materno%' AND otros LIKE '%$otros%' LIMIT 0,30";
	$result = mysql_query($query);
	$num = mysql_num_rows($result);
	if($num > 0){
	}else{
            $error = "El nombre que esta Buscando no se encuentra en la Base de Datos";
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../../css/tablas.css" />
<link rel="stylesheet" href="../../css/normalize.css">
<title>Busqueda</title>
</head>
<body>
<img src="../imagenes/Banner2.jpg" width="600" height="100" alt=""/>
<form id="busqueda" name="busqueda" method="get" action="">
  <table width="650" border="0" cellpadding="0" cellspacing="1">
      <caption>Buscar Otorgante - Persona Natural</caption>
      <thead>
        <tr>
          <th width="162" height="19" align="center">Nombre(s)</th>
          <th width="154" align="center">Apellidos Paterno</th>
          <th width="167" align="center">Apellido Materno</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td align="center"></td>
            <td align="center"></td>
            <td colspan="2" align="center"></td>
        </tr>
        <tr>
          <td align="center"><input type="text" name="nombres" id="nombres" /></td>
          <td align="center"><input type="text" name="paterno" id="paterno" /></td>
          <td align="center"><input type="text" name="materno" id="materno" /></td>
          <td width="162" align="center"><input name="btnbuscar" type="submit" class="boton" id="btnbuscar" value="Buscar Otorgante" /></td>
        </tr>
        <tr>
            <td colspan="3" align="center">Otros
              <div align="left">
                    <input type="text" name="otros" id="otros" size="70" value="<?php echo $otros;?>" /></div></td>
            <td></td>
        </tr>
      </tbody>
</table>
  </form>
<table width="774" border="1">
    <caption>Resultados</caption>
    <tr>
        <td width="339" class="error">Otorgante</td>
        <td width="323" class="error">Otros</td>
        <td width="90" class="error">&nbsp;</td>
    </tr>
          <?php
          while(@$Dat = mysql_fetch_array($result)){
          $otor = array("codigo"=>$Dat[0], "nombres"=>$Dat[1],"otros"=>$Dat[2]);
          ?>
    <tr>
        <td bgcolor="#FFFFFF"><?php echo $Dat[1];?></td>
        <td bgcolor="#FFFFFF"><?php echo $Dat[2];?></td>
        <td bgcolor="#FFFFFF"><a href='./buscar_otor_detail.php?cod_otor=<?php echo $otor["codigo"];?>&nombre=<?php echo $otor["nombres"];?>'>Ver Detalles</a></td>
    </tr>
        <?php
        }
        ?>
</table>
<?php echo $error;?>
</body>
</html>
<?php
} else {
    header("Location: ../../index.php");
}
?>