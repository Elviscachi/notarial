<?   //Para la conexion con la Base de Datos
session_start();
if(isset($_SESSION['busqueda'])){
require_once '../../Model/conexion.class.php';
$link = new conexionclass();
$link->conectarse();

//Obtener el Numero de Escritura
$cod_otor =$_REQUEST['cod_otor'];
$cod_favor = $_REQUEST['cod_favor'];
$cod_sct = $_REQUEST['cod_sct'];

//echo "Codigo Otorgante".$cod_otor =$_REQUEST['cod_otor'];
//echo "Codigo Favorecido".$cod_favor = $_REQUEST['cod_favor'];
//echo "Codigo Escritura".$cod_sct = $_REQUEST['cod_sct'];

$consult2 = "SELECT cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol, cod_usu FROM escrituras1 WHERE cod_sct = $cod_sct";
$query2 = mysql_query($consult2);
$dato2 = mysql_fetch_array($query2);
$ver=array("Notario"=>$dato2[0],"Escritura"=>$dato2[1],"Distrito"=>$dato2[2],"Fecha"=>$dato2[3],"SubSerie"=>$dato2[4],"NBien"=>$dato2[5],"NumFolios"=>$dato2[6],"Protocolo"=>$dato2[7],"Obs"=>$dato2[8],"Folio"=>$dato2[9],"Usuario"=>$dato2[10]);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=es-iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../../css/busqueda_detail.css" />
<title>Busqueda de Escrituras - ARP</title>
<style type="text/css">
<!--
.Estilo6 {color: #FFFFFF}
.Estilo5 {color: #CCCCCC}
.style15 {color: #FFFFFF; font-weight: bold; font-size: 17px; }
-->
</style>
</head>

<script language="javascript" type="text/javascript">
function enviar_datos(){
    var cod_otor = document.getElementById("cod_otor").value;
    alert('Dato Agregado Correctamente');
    window.close();
    location.href("./ingreso.php?otorgante=" + cod_otor + "");
}
</script>

<body>
<form action="" method="get" enctype="multipart/form-data" name="involucrados" id="involucrados">
  <table width="755" height="263" border="0" background="../imagenes/fondo.jpg" align="center">
    <tr>
      <td width="108" height="35" align="left">Otorgante</td>
      <?php
	  $R = "SELECT Cod_inv, Raz_inv, otros_juri FROM involjuridicas1 WHERE cod_inv = $cod_otor";
	  $Q = mysql_query($R);
	  $P = mysql_fetch_array($Q);
	  ?>
      <td colspan="7" align="left"><input name="otor" type="text" id="otor" size="90" value='<?php echo $P[1];?>'/></td>
    </tr>
    <tr>
      <td height="24" align="left">Otros</td>
      <td colspan="7" align="left"><textarea name="otro1" cols="68" rows="" id="otro1"><?php echo $P[2];?>
  </textarea></td>
    </tr>
    <tr>
      <?php
	  $D = "SELECT CONCAT(A.nom_inv,' ',A.pat_inv,' ',A.mat_inv) AS otorgante, A.otros, B.Cod_inv, B.Raz_inv, B.otros_juri FROM involucrados1 as A, involjuridicas1 as B WHERE A.cod_inv = $cod_favor";
	  $E = mysql_query($D);
	  $F = mysql_fetch_array($E);
	  ?>
      <td height="24" align="left">Favorecido</td>
      <td colspan="7" align="left"><input name="fav" type="text" id="fav" size="90" value="<?php echo $F[0];?>"/></td>
    </tr>
    <tr>
      <td height="30" align="left">Otros</td>
      <td colspan="7" align="left"><textarea name="otros2" cols="68" rows="" id="otros2"><?php echo $F[1];?>
  </textarea>  </td>
    </tr>
    <tr>
      <td height="33" align="left">Nombre del Bien</td>
      <td colspan="7" align="left"><input name="nbien" type="text" id="nbien" size="150" value="<?php echo $ver["NBien"];?>"/></td>
    </tr>
    <tr>
      <td height="40">Fecha</td>
      <td align="left"><label>
        <input name="fecha" type="text" id="fecha" value="<?php echo $ver["Fecha"];?>"/>
      </label></td>
      <td align="left">Sub Serie</td>
      <?php
	  $Sr = $ver["SubSerie"];
	  $Sis="SELECT des_sub from subseries WHERE cod_sub = $Sr";
	  $Sis1 = mysql_query($Sis);
	  $Sto = mysql_fetch_array($Sis1);
	  ?>
      <td colspan="3" align="left"><input name="sub_serie" type="text" id="sub_serie" size="100" value="<?php echo $Sto[0];?>"/></td>
    </tr>
    <tr>
      <td height="29" align="left">Observaciones</td>
      <td colspan="7" align="left"><textarea name="obs" cols="100" rows="4" ><?php echo $ver["Obs"];?>
  </textarea></td>
    </tr>
    <tr bgcolor="#FF9900">
      <td height="26">Protocolo</td>
      <td width="198" class="style15"><label>
        <input name="pro" type="text" id="pro" size="10" value="<?php echo $ver["Protocolo"];?>"/>
      </label></td>
      <td width="99" align="right">N&ordm; Escritura</td>
      <td width="156" class="style15"><label>
        <input name="sct" type="text" id="sct" size="10" value="<?php echo $ver["Escritura"];?>"/>
      </label></td>
      <td width="89" align="right">Folio</td>
      <td width="121" class="style15"><label>
        <input name="folio" type="text" id="folio" size="10" value="<?php echo $ver["Folio"];?>" />
      </label></td>
      <td width="207" align="right">Cant.Folio</td>
      <td width="78" class="style15"><label>
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
      <input name="dst" type="text" id="dst" size="10" value="<?php echo $dto[0];?>"/></td>
      <td class="style15" align="right">&nbsp;</td>
      <?php
	  $dr = $ver["Distrito"];
	  $dis="SELECT des_dst FROM distritos WHERE cod_dst = $dr";
	  $dis1 = mysql_query($dis);
	  $dto = mysql_fetch_array($dis1);
	  ?>
      <td class="style15">&nbsp;</td>
    </tr>
    <tr>
      <td height="26">Trabajador</td>
      <td colspan="5" align="center"><div align="left">
	  <?php
	  $ur = $ver["Usuario"];
	  $uis="SELECT CONCAT(nom_usu,' ', pat_usu,' ', mat_usu) as Usuario FROM usuarios WHERE cod_usu = $ur";
	  $uis1 = mysql_query($uis);
	  $uto = mysql_fetch_array($uis1);
	  ?>
        <input name="textfield2" type="text" size="60" value="<?php echo $uto[0];?>" />
      </div></td>
    </tr>
    <tr>
      <td height="26"></td>
      <td colspan="3" align="center"><input name="button2" type="button" class="boton" id="button2" value="Regresar" onclick="javascript:history.back(-1);" /></td>
      <td colspan="2" align="center"><input name="btnsalir" type="button" class="boton" id="btnsalir" onclick="javascript:location.href='index_old.php'" value="Salir de Busqueda" /></td>
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