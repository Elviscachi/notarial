<?php
session_start();
if(isset($_SESSION['busqueda']))
{
require_once '../Model/conexion.class.php';
$link = new conexionclass();
$link->conectarse();

$cod_favor_ju = $_REQUEST['cod_favor_ju'];
echo $cod_favor_ju;
$nombre = $_GET['nom_valor'];
//  Datos del Favorecido

$query = "SELECT cod_sct FROM escrifavor WHERE Cod_inv = '$cod_favor_ju';";
$result = mysql_query($query);
$num = mysql_num_rows($result);
if($num > 0){
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="css/busquedas2.css" />
<title>Busqueda</title>
<script language="javascript" type="text/javascript">
    function muestra(cod_fav_ju, cod_sct, cod_oto, cod_inv_ju ){
		location.href="buscarSct_x_Fecha.php?cod_favor_ju="+cod_fav_ju+"&cod_otor="+cod_oto+"&cod_sct="+cod_sct+"&cod_otor_ju="+cod_inv_ju+"";
    }
    </script>
</head>
<body>
<p>BUSQUEDA POR FAVORECIDO <?php echo "Existe(n): ".$num." Favorecidos";?></p>

<form action="" name="busqueda_favoredico" method="get">
<table>
  <tr>
    <td><input name="button2" type="button" class="boton" id="button2" value="Regresar" onclick="javascript:history.back(-1);" /></td>
    <td><input name="btnsalir" type="button" class="boton" id="btnsalir" onclick="javascript:location.href='index_old.php'" value="Salir" /></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="2">Favorecido: <?php echo $nombre;?></td>
        
  </tr>
</table>
</form>
<!-- AQUI COMINEZA EL PAGINADOR -->

<table width="1327" border="0">
  <thead>
  <tr>
    <th width="40" class="error">Num.</th>
    <th width="450" class="error">Otorgante</th>
    <th width="175" class="error">Fecha</th>
    <th width="162" class="error">SubSerie</th>
    <th width="282" class="error">Prebio /Bien </th>
    <th width="90" class="error">Protocolo</th>
    <th width="96" class="error">Escritura</th>
	<th width="59" class="error">Folio</th>
  </tr>
  </thead>
  <?php
    $i=1;

    $numeroRegistros=mysql_num_rows($result);
    if($numeroRegistros<=0)
    {
    echo "<div align='center'>";
    echo "<font face='verdana' size='-2'>No se encontraron resultados</font>";
    echo "</div>";
    }else{
    //////////elementos para el orden
        if(!isset($orden))
        {
            $orden="cod_sct";
        }
        //////////fin elementos de orden
        //////////calculo de elementos necesarios para paginacion
        //////////tama?o de la pagina
    $tamPag=30;
    //pagina actual si no esta definida y limites
    if(!isset($_GET["pagina"]))
    {
       $pagina=1;
       $inicio=1;
       $final=$tamPag;
    }else{
       $pagina = $_GET["pagina"];
    }
    //calculo del limite inferior
    $limitInf=($pagina-1)*$tamPag;

    //calculo del numero de paginas
    $numPags=ceil($numeroRegistros/$tamPag);
    if(!isset($pagina))
    {
       $pagina=1;
       $inicio=1;
       $final=$tamPag;
    }else{
       $seccionActual=intval(($pagina-1)/$tamPag);
       $inicio=($seccionActual*$tamPag)+1;

       if($pagina<$numPags)
       {
          $final=$inicio+$tamPag-1;
       }else{
          $final=$numPags;
       }

       if ($final>$numPags){
          $final=$numPags;
       }
    }

//////////fin de dicho calculo
//////////creacion de la consulta con limites
//$sql="SELECT Cod_inv,Raz_inv FROM involjuridicas ".$criterio." ORDER BY ".$orden." LIMIT ".$limitInf.",".$tamPag;
//$res=mysql_query($sql);
    
  $sql = "SELECT cod_sct FROM escrifavor WHERE Cod_inv =".$cod_favor_ju." LIMIT ".$limitInf.",".$tamPag.";";
  $res=mysql_query($sql);

  while(@$fila2=mysql_fetch_array($res)){
    $Escritura = $fila2[0];
	$query_sct="SELECT cod_sct, cod_inv FROM escriotor WHERE cod_sct = '$Escritura';";
	$query1=mysql_query($query_sct);
	$res1=mysql_fetch_array($query1);
	$var0=$res1[0];
        $var1=$res1[1];
		
	$query2 = "SELECT cod_sct, cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol FROM escrituras WHERE cod_sct = '$Escritura';";
        $result2=mysql_query($query2);
	$fila=mysql_fetch_array($result2);
	$datosEscritura=array("cod_sct"=>$fila[0],"notario"=>$fila[1],"escritura"=>$fila[2],"distrito"=>$fila[3],"fecha"=>$fila[4],"subserie"=>$fila[5],"bien"=>$fila[6],"cantFolios"=>$fila[7],"protocolo"=>$fila[8],"obs"=>$fila[9],"numFolios"=>$fila[10]);
        $Escritura2=$datosEscritura["cod_sct"];

  ?>
  <tr onClick="javascript:muestra('<?php echo $cod_favor_ju;?>','<?php echo $Escritura2;?>','<?php echo $var1;?>', '<?php echo $FILA2["Raz_inv"];?>');">
    <td><?php echo $i;?></td>
    <td>
	<?php
        $q_fav="SELECT a.Cod_inv, CONCAT(a.Nom_inv,' ',a.Pat_inv,' ',a.Mat_inv) AS persona FROM involucrados as a WHERE a.cod_inv = '$var1';";
        $query22=mysql_query($q_fav) or die (mysql_error()." Error Buscado Favorecido");
        $num33 = mysql_num_rows($query22);
        $r2=mysql_fetch_array($query22);

	echo $r2["persona"];
        if($num33 == 0){
            $RESULT2 = "SELECT Cod_inv, Raz_inv FROM involjuridicas WHERE Cod_inv = '$var1';";
            $QUERY2=mysql_query($RESULT2);
            $FILA2=mysql_fetch_array($QUERY2);
            echo $FILA2["Raz_inv"];
        }
    ?>	</td>
    <td><?php echo $datosEscritura["fecha"];?></td>
    <td><?php $sub=$datosEscritura["subserie"];
      /* @var $datosEscritura <type> */
	  $Sis="SELECT des_sub FROM subseries WHERE cod_sub = '$sub';";
	  $Sis1 = mysql_query($Sis);
	  $Sto = mysql_fetch_array($Sis1);
	  echo $Sto["des_sub"];
	  ?></td>
    <td><?php echo $datosEscritura["bien"];?></td>
    <td><?php echo $datosEscritura["protocolo"];?></td>
    <td><?php echo $datosEscritura["escritura"];?>    </td>
	<td width="59" class="Estilo1"><?php echo $datosEscritura["numFolios"];?></td>
  </tr>
    <?php
  $i=$i+1;
  }
}
  ?>

  <tr>
    
  </tr>
</table>
<div align="center" id="paginar">
          <?php
        if($pagina>1)
        {
        echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina-1)."&cod_favor_ju=".$cod_favor_ju."'>";
        echo "<font face='verdana' size='2'>anterior</font>";
        echo "</a> ";
        }

        for($i=$inicio;$i<=$final;$i++)
        {
            if($i==$pagina)
            {
            echo "<font face='verdana' size='2'><b>".$i."</b> </font>";
            }else{
            echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".$i."&cod_favor_ju=".$cod_favor_ju."'>";
            echo "<font face='verdana' size='2'>".$i."</font></a> ";
            }
        }
        if($pagina<$numPags)
        {
            echo " <a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina+1)."&cod_favor_ju=".$cod_favor_ju."'>";
            echo "<font face='verdana' size='2'>siguiente</font></a>";
        }
        //////////fin de la paginacion
  
        ?>
        </div>
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
    header("Location: ../../arpweb/index.htm");
}
?>