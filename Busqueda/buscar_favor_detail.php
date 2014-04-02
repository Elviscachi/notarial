<?php
session_start();
if(isset($_SESSION['busqueda'])){
require_once 'Model/conexion.class.php';
$link = new conexionclass();
$link->conectarse();

$cod_favor1 = $_REQUEST['cod_favor1'];
$nombre_favor = $_REQUEST['nombre_favor'];
//  Datos del Favorecido
$nombre_fav = $_REQUEST['nombre_favor'];
$paterno = $_REQUEST['paterno'];
$materno = $_REQUEST['materno'];


$query = "SELECT cod_sct FROM escrifavor1 WHERE cod_inv = '$cod_favor1'";
$result = mysql_query($query);
$num = mysql_num_rows($result);
if($num > 0){
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="css/busquedas2.css"/>
<title>Busqueda</title>
<script language="javascript" type="text/javascript">
    function muestra(cod_fav, cod_sct, cod_oto, cod_inv_ju ){
		location.href="buscarSct_x_Fecha.php?cod_favor="+cod_fav+"&cod_otor="+cod_oto+"&cod_sct="+cod_sct+"&cod_otor_ju="+cod_inv_ju+"";
    }
    </script>
</head>
<body>
<p>BUSQUEDA POR FAVORECIDO <?php echo "Existe(n): ".$num." Favorecidos";?></p>
<div id="header"></div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="encabezado">
  <h1>Documentos Notariales del Departamento de Puno.</h1>
  <h2>Provincias de : Azangaro, Lampa, Carabaya - Macusani, Juliaca (Cuba Ovalle,Hildebrando Castillo, Selmo Carcausto), Puno (Julio Garnica Rosado)</h2>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<br /><br />
<table>
	<caption>Otorgante: <?php echo $nombre_favor;?> - <input type="button" name="regresar" value="Regresar / Salir" onclick="javascript:location.href='./buscar_index.php'" /></caption>
    <thead>
  <tr>
      <th width="20">Num</th>
      <th width="260">Otorgante</th>
      <th width="70">Fecha</th>
    <th>Serie</th>
    <th>Direccion</th>
    <th>Protocolo</th>
    <th>Folio</th>
    
  </tr>
  </thead>
  <?php
    $i=1;
  while(@$fila2=mysql_fetch_array($result)){
        $sct1 = $fila2[0];
	$con_14="SELECT cod_sct, cod_inv, cod_inv_ju FROM escriotor1 WHERE cod_sct = '$sct1'";
	$q14=mysql_query($con_14);
	$a14=mysql_fetch_array($q14);
	$array_f= array("cod_sct"=>$a14[0],"cod_inv"=>$a14[1],"codInvJur"=>$a14[2]);
	    $var0=$array_f["cod_sct"];
        $var1=$array_f["cod_inv"];
        $var2=$array_f["codInvJur"];
		
		$consulta123 = "SELECT cod_sct, cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol FROM escrituras1 WHERE cod_sct = '$a14[0]' LIMIT 0,250;";
        $result2=mysql_query($consulta123);
		$fila=mysql_fetch_array($result2);
	    $datosEscritura=array("cod_sct"=>$fila[0],"notario"=>$fila[1],"escritura"=>$fila[2],"distrito"=>$fila[3],"fecha"=>$fila[4],"subserie"=>$fila[5],"bien"=>$fila[6],"cantFolios"=>$fila[7],"protocolo"=>$fila[8],"obs"=>$fila[9],"numFolios"=>$fila[10]);
  $Escritura=$datosEscritura["cod_sct"];
  
  
  ?>
  
  <tbody>
  <tr onClick="javascript:muestra('<?php echo $cod_favor1;?>','<?php echo $sct1;?>','<?php echo $var1;?>', '<?php echo $var2;?>');">
    <td><?php echo $i;?></td>
    <td>
	<?php
        $con_2="SELECT cod_sct,cod_inv,cod_inv_ju FROM escriotor1 WHERE cod_sct ='$Escritura'";
	$q2=mysql_query($con_2);
	$a2=mysql_fetch_array($q2);
        $array_f= array("cod_sct"=>$a2[0],"cod_inv"=>$a2[1],"codInvJur"=>$a2[2]);
        $var3=$array_f["cod_inv"];
        $var4=$array_f["codInvJur"];
        $q_fav="SELECT a.Cod_inv, CONCAT(a.Nom_inv,' ',a.Pat_inv,' ',a.Mat_inv), b.Cod_inv, b.Raz_inv FROM involucrados1 as a, involjuridicas1 as b WHERE a.cod_inv = '$var1'";

        $query2=mysql_query($q_fav) or die (mysql_error()." Error Buscado Favorecido");
	$r2=mysql_fetch_array($query2);
	echo $r2[1];
        if($var4<>0){
            $RESULT2 = "SELECT Cod_inv, Raz_inv FROM involjuridicas1 WHERE Cod_inv = '$var2'";
            $QUERY2=mysql_query($RESULT2);
            $FILA2=mysql_fetch_array($QUERY2);
            echo $FILA2[1];
        }
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
    <td><div style="display: none;"><a href="buscar_sct.php?cod_otor=<?php echo $cod_otor;?>&cod_sct=<?php echo $sct1;?>&cod_favor=<?php echo $var1;?>">Ver Detalles</a></div></td>
  </tr>
    </tbody>
    <?php
  $i=$i+1;
  }
  ?>
</table>
<?php
}
else{
	echo "<script language='javascript' type='text/javascript'>alert('No hay Escrituras que Mostrar.  Volver Atras');history.back(-1);</script>";
}
?>
</body>
</html>
<?php
}
else
{
	header("Location: ../arpweb/index.php");
}
?>