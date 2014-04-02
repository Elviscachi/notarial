<?php
session_start();
if(isset($_SESSION['busqueda'])){
  require_once 'Model/conexion.class.php';
  $link = new conexionclass();
  $link->conectarse();

$cod_otor = $_REQUEST['cod_otor'];
$nombre = $_REQUEST['nombre'];
//  Datos del Favorecido
$query7 = "SELECT cod_sct FROM escriotor1 WHERE cod_inv = $cod_otor";
$result1 = mysql_query($query7);
$num = mysql_num_rows($result1);
if($num > 0){


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/busquedas2.css"/>
<title>Resultado de Busqueda por Otorgante</title>

    <script language="javascript" type="text/javascript">
    function muestra(cod_otor, cod_sct, cod_fav, cod_fav_ju){
		location.href="buscarSct_x_Fecha.php?cod_otor="+cod_otor+"&cod_sct="+cod_sct+"&cod_favor="+cod_fav+"&cod_favor_ju="+cod_fav_ju+"";
    }
    </script>
</head>
<body>
<div id="header"></div>
<p>&nbsp;</p>
<p>BUSQUEDA POR OTORGANTE <?php echo "Existe(n): ".$num." Favorecidos";?></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="encabezado">
  <h1>Documentos Notariales del Departamento de Puno.</h1>
  <h2>Provincias de : Azangaro, Lampa, Carabaya - Macusani, Juliaca (Cuba Ovalle,Hildebrando Castillo, Selmo Carcausto), Puno (Julio Garnica Rosado)</h2>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<br />
<table>
  <caption>Otorgante: <?php echo $nombre;?> - <input type="button" name="regresar" value="Regresar / Salir" onclick="javascript:location.href='./buscar_index.php'" /></caption>
  <thead>
  <tr>
    <th width="20">Num</th>
    <th width="260">Favorecido</th>
    <th width="70">Fecha</th>
    <th>SubSerie</th>
    <th>Nombre del Bien </th>
    <th>Protocolo</th>
    <th>Escritura</th>
    <th>Folio</th>
  </tr>
  </thead>
  <?php
    $i=1;
  while(@$fila2=mysql_fetch_array($result1)){
        $sct1 = array("escritura"=>$fila2[0]);
        $Escritura = $sct1["escritura"];
	$con_14="SELECT cod_sct, cod_inv, cod_inv_ju FROM escrifavor1 WHERE cod_sct = '$Escritura'";
	$q14=mysql_query($con_14);
	$a14=mysql_fetch_array($q14);
	$array_f= array("cod_sct"=>$a14[0],"cod_inv"=>$a14[1],"codInvJur"=>$a14[2]);
	    $var0=$array_f["cod_sct"];
        $var1=$array_f["cod_inv"];
        $var2=$array_f["codInvJur"];
		
		$consulta123 = "SELECT cod_sct, cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol FROM escrituras1 WHERE cod_sct = '$a14[0]' LIMIT 0,250;";
        $result=mysql_query($consulta123);
		$fila=mysql_fetch_array($result);
	    $datosEscritura=array("cod_sct"=>$fila[0],"notario"=>$fila[1],"escritura"=>$fila[2],"distrito"=>$fila[3],"fecha"=>$fila[4],"subserie"=>$fila[5],"bien"=>$fila[6],"cantFolios"=>$fila[7],"protocolo"=>$fila[8],"obs"=>$fila[9],"numFolios"=>$fila[10]);
  $Escritura=$datosEscritura["cod_sct"];
  
  
  ?>
    <tbody>
        <tr bgcolor="#F0ECCE" onMouseOver="this.style.backgroundColor='#4499CC';this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='#F0ECCE';" onClick="javascript:muestra('<?php echo $cod_otor;?>','<?php echo $sct1["escritura"];?>','<?php echo $var1;?>','<?php echo $var2;?>');">
         <td><?php echo $i;?></td>
            <td><b>
	<?php
        $con_2="SELECT cod_sct,cod_inv,cod_inv_ju FROM escrifavor1 WHERE cod_sct ='$Escritura'";
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
            ?>	
           </b></td>
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
    <td><?php echo $datosEscritura["numFolios"];?></td>
  </tr>
    <?php
      $i=$i+1;
     }
     ?>
    </tbody>
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
    header("Location: ../../index.php");
}
?>