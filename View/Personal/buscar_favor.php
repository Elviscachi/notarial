<?php
session_start();
if (isset($_SESSION['personal'])) {
    require_once '../../Model/cone.php';
    $link = new ConexionClass();
    $link->conectarse();

$nombres = $_POST['nombres'];
$paterno = $_POST['paterno'];
$materno = $_POST['materno'];
$otros = $_POST['otros'];

if(isset ($_REQUEST["btnbuscar"])){
    $query = "SELECT cod_inv, CONCAT(nom_inv,' ',pat_inv,' ', mat_inv) as otorgante, otros FROM involucrados1 WHERE ";
    $query .= "nom_inv LIKE '%$nombres%' AND pat_inv LIKE '%$paterno%' AND mat_inv LIKE '%$materno%' AND otros LIKE '%$otros%' LIMIT 0,30";
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
<link rel="stylesheet" type="text/css" href="../../css/style_ingreso.css" />
<link rel="stylesheet" href="../../css/normalize.css">
<title>Busqueda</title>

</head>
<body>
<p><img src="../imagenes/Banner2.jpg" width="600" height="100" /></p>
<form id="busqueda" name="busqueda" method="post" action="">
  <table width="766" height="47" border="0" cellpadding="0" cellspacing="1" background="Admin/Fondo.jpg" bgcolor="#990000">
<tr>
          <td width="115" height="19" align="center"><h3>&nbsp;</h3></td>
          <td width="162" align="center"><h3>Nombre(s)</h3></td>
          <td width="154" align="center"><h3>Apellidos Paterno</h3></td>
          <td width="167" align="center"><h3>Apellido Materno</h3></td>
</tr>
        <tr>
            <td align="center"></td>
            <td align="center"></td>
  	        <td align="center"></td>
  	        <td colspan="2" align="center"></td>
      </tr>
        <tr>
          <td align="center" class="error">FAVORECIDO</td>
          <td align="center"><input type="text" name="nombres" id="nombres" value="<?php echo $nombres;?>" /></td>
          <td align="center"><input type="text" name="paterno" id="paterno" value="<?php echo $paterno;?>" /></td>
          <td align="center"><input type="text" name="materno" id="materno" value="<?php echo $materno;?>" /></td>
          <td width="162" align="center"><input type="submit" name="btnbuscar" value="Buscar" id="btnbuscar" /></td>
        </tr>
    <tr>
        <td align="center">&nbsp;</td>
        <td colspan="3" align="center"><div align="left">
          <span class="error">Otros</span>
          <input type="text" name="otros" id="otros" value="" size="70"/>
        </div></td>
        <td align="center">&nbsp;</td>
  </tr>
</table>
</form>
<table width="774" border="1">
  <tr>
    <td width="339" class="error">Otorgante</td>
    <td width="323" class="error">Otros</td>
    <td width="90" class="error">&nbsp;</td>
  </tr>
  <?php
  while($Dat = mysql_fetch_array($result)){
	$otor = array("codigo"=>$Dat[0], "nombres"=>$Dat[1],"otros"=>$Dat[2]);
  ?>
  <tr>
    <td bgcolor="#FFFFFF"><?php echo $Dat[1];?></td>
    <td bgcolor="#FFFFFF"><?php echo $Dat[2];?></td>
    <td bgcolor="#FFFFFF" class="Estilo1"><a href="buscar_sct_fav.php?cod_favor=<?php echo $otor["codigo"];?>">Ver Detalles</a></td>
  </tr>
  <?php
  }
  ?>
</table>
</body>
</html>
<?php
} else {
    header("Location: ../../index.php");
}
?>