<?php
session_start();
if(isset($_SESSION['busqueda'])){
require_once '../../Model/conexion.class.php';
$link = new conexionclass();
$link->conectarse();

//Obtener el Numero de Escritura
$cod_otor =$_REQUEST['cod_otor'];
$cod_favor = $_REQUEST['cod_favor'];
$cod_otor_ju =$_REQUEST['cod_otor_ju'];
$cod_favor_ju = $_REQUEST['cod_favor_ju'];
$cod_sct = $_REQUEST['cod_sct'];

//echo "Codigo Otorgante".$cod_otor =$_REQUEST['cod_otor'];
//echo "Codigo Favorecido".$cod_favor = $_REQUEST['cod_favor'];
//echo "Codigo Escritura".$cod_sct = $_REQUEST['cod_sct'];

$consult1 = "SELECT cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol, cod_usu FROM escrituras WHERE cod_sct = '$cod_sct';";
$query1 = mysql_query($consult1);
$dato1 = mysql_fetch_array($query1);
$ver=array("Notario"=>$dato1[0],"Escritura"=>$dato1[1],"Distrito"=>$dato1[2],"Fecha"=>$dato1[3],"SubSerie"=>$dato1[4],"NBien"=>$dato1[5],"NumFolios"=>$dato1[6],"Protocolo"=>$dato1[7],"Obs"=>$dato1[8],"Folio"=>$dato1[9],"Usuario"=>$dato1[10]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="css/busquedas2.css" />
<title>Busqueda de Escrituras - ARP</title>
</head>
<body>
<h3 align="center">Detalles de la Busqueda</h3>
<form action="" method="get" enctype="multipart/form-data" name="involucrados">
  <table width="1301" border="1" align="center">
    <tr>
      <td width="100" align="left">Otorgante</td>
      <?php
        $q_oto="SELECT Cod_inv, CONCAT(Nom_inv,' ',Pat_inv,' ',Mat_inv) AS persona FROM involucrados WHERE Cod_inv = '$cod_otor';";
        $query2=mysql_query($q_oto) or die (mysql_error()." Error Buscado Favorecido");
        $num2 = mysql_num_rows($query2);
        $r2=mysql_fetch_array($query2);
	$ver_otorgante = $r2["persona"];
        if($num2 == 0){
            $RESULT2 = "SELECT Cod_inv, Raz_inv FROM involjuridicas WHERE Cod_inv = '$cod_otor_ju';";
            $QUERY2=mysql_query($RESULT2);
            $FILA2=mysql_fetch_array($QUERY2);
	$ver_otorgante = $FILA2["Raz_inv"];
        }
	  ?>
      <td colspan="7" align="left"><input name="otor" type="text" id="otor" size="90" value='<?php echo $ver_otorgante;?>'/></td>
    </tr>
    <tr>
      <td height="24" align="left">Otros</td>
      <td colspan="7" align="left"><textarea name="otro1" cols="68" rows="" id="otro1"><?php echo $r1[2];?>
  </textarea></td>
    </tr>
    <tr>
      <?php
        $q_fav="SELECT Cod_inv, CONCAT(Nom_inv,' ',Pat_inv,' ',Mat_inv) AS persona FROM involucrados WHERE cod_inv = '$cod_favor';";
        $query3=mysql_query($q_fav) or die (mysql_error()." Error Buscado Favorecido");
	$r3=mysql_fetch_array($query3);
	$num3 = mysql_num_rows($query3);
        $ver_favorecido=$r3["persona"];
		
	if($num3 == 0){
            $RESULT3 = "SELECT Cod_inv, Raz_inv FROM involjuridicas WHERE Cod_inv = '$cod_favor_ju';";
            $QUERY3=mysql_query($RESULT3);
            $FILA3=mysql_fetch_array($QUERY3);
	    $ver_favorecido = $FILA3["Raz_inv"];
        }
      ?>
      <td height="24" align="left">Favorecido</td>
      <td colspan="7" align="left"><input name="fav" type="text" id="fav" size="90" value="<?php echo $ver_favorecido;?>"/></td>
    </tr>
    <tr>
      <td height="30" align="left">Otros</td>
      <td colspan="7" align="left"><textarea name="otros2" cols="68" rows="" id="otros2"><?php echo $r2[2];?>
  </textarea>      </td>
    </tr>
    <tr>
      <td height="33" align="left">Nombre del Bien</td>
      <td colspan="7" align="left"><input name="nbien" type="text" id="nbien" size="150" value="<?php echo $ver["NBien"];?>"/></td>
    </tr>
    <tr>
      <td height="40">Fecha</td>
      <td align="left"><label>
        <?php echo $ver["Fecha"];?>
      </label></td>
      <td align="left">Sub Serie</td>
      <?php
	  $Sr = $ver["SubSerie"];
	  $Sis="SELECT des_sub FROM subseries WHERE cod_sub = $Sr";
	  $Sis1 = mysql_query($Sis);
	  $Sto = mysql_fetch_array($Sis1);
	  ?>
      <td colspan="3" align="left"><input name="sub_serie" type="text" id="sub_serie" size="100" value="<?php echo $Sto["des_sub"];?>"/></td>
    </tr>
    <tr>
      <td height="29" align="left">Observaciones</td>
      <td colspan="7" align="left"><textarea name="obs" cols="100" rows="4" ><?php echo $ver["Obs"];?>
  </textarea></td>
    </tr>
    <tr bgcolor="#FF9900">
      <td height="26">Protocolo</td>
      <td width="149" class="style15"><label>
        <input name="pro" type="text" id="pro" size="10" value="<?php echo $ver["Protocolo"];?>"/>
      </label></td>
      <td width="58" align="right">N&ordm; Escritura</td>
      <td width="110" class="style15"><label>
        <input name="sct" type="text" id="sct" size="10" value="<?php echo $ver["Escritura"];?>"/>
      </label></td>
      <td width="79" align="right">Folio</td>
      <td width="402" class="style15"><label>
        <input name="folio" type="text" id="folio" size="10" value="<?php echo $ver["Folio"];?>" />
      </label></td>
      <td width="150" align="right">Cant.Folio</td>
      <td width="201" class="style15"><label>
        <input name="cant_fol" type="text" id="cant_fol" size="10" value="<?php echo $ver["NumFolios"];?>"/>
      </label></td>
    </tr>
    <tr>
      <td>Notario</td>
      <?php
	  $nr = $ver["Notario"];
	  $nis="SELECT CONCAT(nom_not,' ', pat_not,' ', mat_not) AS Notario FROM notarios2 WHERE cod_not = $nr";
	  $nis1 = mysql_query($nis);
	  $nto = mysql_fetch_array($nis1);
	  ?>
      <td colspan="5"><input name="notario" type="text" id="notario" size="70" value="<?php echo $nto[0];?>" />
        Distrito
        <?php
	  $dr = $ver["Distrito"];
	  $dis="SELECT des_dst FROM distritos WHERE cod_dst = '$dr';";
	  $dis1 = mysql_query($dis);
	  $dto = mysql_fetch_array($dis1);
    ?>
        <input name="dst" type="text" id="dst" size="10" value="<?php echo $dto["des_dst"];?>"/></td>
      <td class="style15" align="right">&nbsp;</td>
      <td class="style15">&nbsp;</td>
    </tr>
    <tr>
      <td height="26">Trabajador</td>
      <td colspan="5" align="center"><?php
	  $ur = $ver["Usuario"];
	  $uis="SELECT CONCAT(nom_usu,' ', pat_usu,' ', mat_usu) as Usuario FROM usuarios WHERE cod_usu = $ur";
	  $uis1 = mysql_query($uis);
	  $uto = mysql_fetch_array($uis1);
	  ?>
          <input name="textfield2" type="text" size="60" value="<?php echo $uto["Usuario"];?>" />      </td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td height="26"></td>
      <td colspan="3" align="center"><input name="button2" type="button" class="boton" id="button2" value="Regresar" onclick="javascript:history.back(-1);" /></td>
      <td><input name="btnsalir2" type="button" class="boton" id="btnsalir2" onclick="javascript:location.href='index_old.php'" value="Salir" /></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
}
else
{
	header("Location: ../../arpweb/index.php");
}
?>