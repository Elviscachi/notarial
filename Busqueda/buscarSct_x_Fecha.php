<?php
session_start();
if(isset($_SESSION['busqueda'])){
require_once 'Model/conexion.class.php';
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

$consult2 = "SELECT cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol, cod_usu FROM escrituras1 WHERE cod_sct = $cod_sct";
$query2 = mysql_query($consult2);
$dato2 = mysql_fetch_array($query2);
$ver=array("Notario"=>$dato2[0],"Escritura"=>$dato2[1],"Distrito"=>$dato2[2],"Fecha"=>$dato2[3],"SubSerie"=>$dato2[4],"NBien"=>$dato2[5],"NumFolios"=>$dato2[6],"Protocolo"=>$dato2[7],"Obs"=>$dato2[8],"Folio"=>$dato2[9],"Usuario"=>$dato2[10]);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Busqueda de Escrituras - ARP</title>
<link rel="stylesheet" type="text/css" href="css/busquedas.css"/>
</head>

<body>
<form action="" method="get" enctype="multipart/form-data" name="involucrados" id="involucrados">
  <table width="800" border="0" align="left">
  <caption>Detalles de la Busqueda</caption>
    <tr>
      <td width="98" height="31">Otorgantes</td>
      <?php
        $ver_otorgante;
        $var1=$cod_otor;
        $var2=$cod_otor_ju;
        $q_oto="SELECT a.Cod_inv, CONCAT(a.Nom_inv,' ',a.Pat_inv,' ',a.Mat_inv), otros FROM involucrados1 as a WHERE a.cod_inv = '$var1'";
        $query1=mysql_query($q_oto) or die (mysql_error()." Error Buscado otorgante");
	$r1=mysql_fetch_array($query1);
	//echo "Sie sta mos aqui".$r1[1];
        $ver_otorgante = $r1[1];
        if($var2<>0){
            $RESULT = "SELECT Cod_inv, Raz_inv FROM involjuridicas1 WHERE Cod_inv = '$var2'";
            $QUERY=mysql_query($RESULT);
            $FILA=mysql_fetch_array($QUERY);
            //echo $FILA[1];
            $ver_otorgante = $FILA[1];
        }
	  ?>
      <td width="331"><input name="otor" type="text" id="otor" size="60" value='<?php echo $ver_otorgante;?>'/></td>
      <td width="72">Otros</td>
      <td width="271"><textarea name="otro1" cols="50" rows="" id="otro1"><?php echo $r1[2];?>
      </textarea></td>
    </tr>
    <tr>
      <td height="29">Favorecidos</td>
      <?php
        $ver_favorecido;
        $var3=$cod_favor;
        $var4=$cod_favor_ju;
        $q_fav="SELECT a.Cod_inv, CONCAT(a.Nom_inv,' ',a.Pat_inv,' ',a.Mat_inv), otros FROM involucrados1 as a WHERE a.cod_inv = '$var3'";

        $query2=mysql_query($q_fav) or die (mysql_error()." Error Buscado Favorecido");
	$r2=mysql_fetch_array($query2);
	//echo $r2[1];
        $ver_favorecido=$r2[1];
        if($var4<>0){
            $RESULT2 = "SELECT Cod_inv, Raz_inv FROM involjuridicas1 WHERE Cod_inv = '$var4'";
            $QUERY2=mysql_query($RESULT2);
            $FILA2=mysql_fetch_array($QUERY2);
            //echo $FILA2[1];
            $ver_favorecido=$FILA2[1];
        }
      ?>
      <td><input name="fav" type="text" id="fav" size="60" value="<?php echo $ver_favorecido;?>"/></td>
      <td>Otros</td>
      <td><textarea name="otros2" cols="50" rows="" id="otros2"><?php echo $r2[2];?>
      </textarea></td>
    </tr>
    <tr>
      <td height="29">Fecha</td>
      <td><?php echo $ver["Fecha"];?> (A&ntilde;o/Mes/Dia)</td>
      <td>Sub Serie</td>
       <?php
	  $Sr = $ver["SubSerie"];
	  $Sis="SELECT des_sub from subseries WHERE cod_sub = $Sr";
	  $Sis1 = mysql_query($Sis);
	  $Sto = mysql_fetch_array($Sis1);
	  ?>
      <td><input name="sub_serie" type="text" id="sub_serie" size="50" value="<?php echo $Sto[0];?>"/></td>
    </tr>
    <tr>
      <td>Nombre del Bien</td>
      <td colspan="3"><input name="nbien" type="text" id="nbien" size="90" value="<?php echo $ver["NBien"];?>"/></td>
    </tr>
    <tr>
      <td height="51">Obsevarciones</td>
      <td colspan="3"><textarea name="obs" cols="105" rows="4" ><?php echo $ver["Obs"];?>
      </textarea></td>
    </tr>
    <tr>
      <td height="28">Protocolo</td>
      <td class="detalle"><input name="pro" type="text" id="pro" size="10" value="<?php echo $ver["Protocolo"];?>"/></td>
      <td>Notario</td>
      <?php
	  $nr = $ver["Notario"];
	  $nis="SELECT CONCAT(nom_not,' ', pat_not,' ', mat_not) AS Notario FROM notarios WHERE cod_not = $nr";
	  $nis1 = mysql_query($nis);
	  $nto = mysql_fetch_array($nis1);
	  ?>
      <td><input name="notario" type="text" id="notario" size="60" value="<?php echo $nto[0];?>" /></td>
    </tr>
    <tr>
      <td height="29">Num Escritura</td>
      <td class="detalle">
        <input name="sct" type="text" id="sct" size="10" value="<?php echo $ver["Escritura"];?>"/>
      </td>
      <td>Lugar</td>
      <?php
	  $dr = $ver["Distrito"];
	  $dis="SELECT des_dst FROM distritos WHERE cod_dst = $dr";
	  $dis1 = mysql_query($dis);
	  $dto = mysql_fetch_array($dis1);
	  ?>
      <td><input name="dst" type="text" id="dst" size="10" value="<?php echo $dto[0];?>"/></td>
    </tr>
    <tr>
      <td height="29">Folio</td>
      <td class="detalle">
        <input name="folio" type="text" id="folio" size="10" value="<?php echo $ver["Folio"];?>" />
      </td>
      <td>Trabajador</td>
      <td><?php
	  $ur = $ver["Usuario"];
	  $uis="SELECT CONCAT(nom_usu,' ', pat_usu,' ', mat_usu) as Usuario FROM usuarios WHERE cod_usu = $ur";
	  $uis1 = mysql_query($uis);
	  $uto = mysql_fetch_array($uis1);
	  ?>
      <input name="textfield2" type="text" size="60" value="<?php echo $uto[0];?>" /></td>
    </tr>
    <tr>
      <td>Cant. Folio</td>
      <td class="detalle">
        <input name="cant_fol" type="text" id="cant_fol" size="10" value="<?php echo $ver["NumFolios"];?>"/>
      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tfoot>
    <tr>
      <td>&nbsp;</td>
      <td><input type="button" class="boton" name="btnbuscar" id="btnbuscar" value="Regresar" onclick="javascript:history.back(-1);" /></td>
      <td><input type="button" class="boton" name="regresar" value="Salir" onclick="javascript:location.href='./buscar_index.php'" /></td>
      <td>&nbsp;</td>
    </tr>
    </tfoot>
  </table>
  <p>
    <?php echo $F[2];?>
    <?php echo $F[3];?>
    <?php echo $F[4];?>
    <?php echo $F[5];?>
    <?php echo $F[6];?>
    <?php echo $F[7];?>
  </p>
</form>
</body>
</html>
<?php
}
else
{
	header("Location: ../../index.php");
}
?>