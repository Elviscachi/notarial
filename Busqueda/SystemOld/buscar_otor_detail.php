<?php
session_start();
if(isset($_SESSION['busqueda'])){
require_once '../Model/conexion.class.php';
$link = new conexionclass();
$link->conectarse();
//Datos del Otorgante
$cod_otor = $_REQUEST['cod_otor'];
$nombre = $_REQUEST['nombre'];
//  Datos del Favorecido
$query7 = "SELECT cod_sct FROM escriotor WHERE cod_inv = $cod_otor";
$result1 = mysql_query($query7);
$num = mysql_num_rows($result1);
if($num > 0){

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="css/busquedas2.css" />
<title>Busqueda</title>

    <script language="javascript" type="text/javascript">
    function muestra(cod_otor, cod_sct, cod_fav, cod_fav_ju){
		location.href="buscarSct_x_Fecha.php?cod_otor="+cod_otor+"&cod_sct="+cod_sct+"&cod_favor="+cod_fav+"&cod_favor_ju="+cod_fav_ju+"";
    }
    </script>
</head>
<body>
<p>BUSQUEDA POR OTORGANTE <?php echo "Existe(n): ".$num." Favorecido(s)";?></p>

<form action="" name="busqueda_favoredico" method="get">
<table>
	<thead>
  <tr>
    <th><input name="button2" type="button" class="boton" id="button2" value="Regresar" onclick="javascript:history.back(-1);" /></th>
    <th colspan="3"><input name="btnsalir" type="button" class="boton" id="btnsalir" onclick="javascript:location.href='index_old.php'" value="Salir" /></th>
      </tr>
  </thead>
  <tr>
    <td colspan="3">Otorgante: <?php echo $nombre;?></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
</form>

<table width="1337" border="0">
  <thead>
  <tr>
    <th width="50" class="error">Num</th>
    <th width="326" class="error">Favorecido</th>
    <th width="125" class="error">Fecha</th>
    <th width="82" class="error">SubSerie</th>
    <th width="306" class="error">Nombre del Bien </th>
    <th width="138" class="error">Protocolo</th>
    <th width="72" class="error">Escritura</th>
    <th width="75" class="error">Folio</th>
  </tr>
  </thead>
  <?php
    $i=1;
  while(@$fila2=mysql_fetch_array($result1)){
        $sct1 = array("escritura"=>$fila2[0]);
        $Escritura = $sct1["escritura"];
	$con_14="SELECT cod_sct, cod_inv FROM escrifavor WHERE cod_sct = '$Escritura'";
	$q14=mysql_query($con_14);
	$a14=mysql_fetch_array($q14);
	$array_f= array("cod_sct"=>$a14[0],"cod_inv"=>$a14[1]);
	$var0=$array_f["cod_sct"];
        $var1=$array_f["cod_inv"];
		
	$consulta123 = "SELECT cod_sct, cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol FROM escrituras WHERE cod_sct = '$a14[0]' LIMIT 0,250;";
        $result=mysql_query($consulta123);
	$fila=mysql_fetch_array($result);
	$datosEscritura=array("cod_sct"=>$fila[0],"notario"=>$fila[1],"escritura"=>$fila[2],"distrito"=>$fila[3],"fecha"=>$fila[4],"subserie"=>$fila[5],"bien"=>$fila[6],"cantFolios"=>$fila[7],"protocolo"=>$fila[8],"obs"=>$fila[9],"numFolios"=>$fila[10]);
        $Escritura=$datosEscritura["cod_sct"];
  
  
  ?>
  <tr onClick="javascript:muestra('<?php echo $cod_otor;?>','<?php echo $sct1["escritura"];?>','<?php echo $var1;?>','<?php echo $var2;?>');">
    <td><?php echo $i;?></td>
    <td>
	<?php
        $con_2="SELECT cod_sct,cod_inv FROM escrifavor WHERE cod_sct ='$Escritura'";
	$q2=mysql_query($con_2);
	$a2=mysql_fetch_array($q2);
        $array_f= array("cod_sct"=>$a2[0],"cod_inv"=>$a2[1]);
        $var3=$array_f["cod_inv"];

        $q_fav="SELECT a.Cod_inv, CONCAT(a.Nom_inv,' ',a.Pat_inv,' ',a.Mat_inv) as otor, b.Cod_inv, b.Raz_inv FROM involucrados as a, involjuridicas as b WHERE a.cod_inv = '$var1' LIMIT 0,100;";

        $query2=mysql_query($q_fav) or die (mysql_error()." Error Buscado Favorecido");
	$r2=mysql_fetch_array($query2);
	echo $r2["otor"];
        echo $r2["Raz_inv"];
        
    ?>	</td>
    <td><?php echo $datosEscritura["fecha"];?></td>
    <td><?php $sub=$datosEscritura["subserie"];
      /* @var $datosEscritura <type> */
	  $Sis="SELECT des_sub FROM subseries WHERE cod_sub = '$sub'";
	  $Sis1 = mysql_query($Sis);
	  $Sto = mysql_fetch_array($Sis1);
	  echo $Sto[0];
	  ?></td>
    <td><?php echo $datosEscritura["bien"];?></td>
    <td><?php echo $datosEscritura["protocolo"];?></td>
    <td><?php echo $datosEscritura["escritura"];?>    </td>
	<td class="Estilo1"><?php echo $datosEscritura["numFolios"];?></td>
  </tr>
    <?php
  $i=$i+1;
  }
  ?>

  <tr>  </tr>
</table>

<div align="center">
  <?php
}
else{
	echo "<script language='javascript' type='text/javascript'>alert('No hay Escrituras que Mostrar.  Volver Atras');history.back(-1);</script>";
}
?>
</div>
</body>
</html>
<?php
}
else
{
	header("Location: ../../index.php");
}
?>