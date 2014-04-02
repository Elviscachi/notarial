<?php
session_start();
if(isset($_SESSION['busqueda']))
{
require_once '../Model/conexion.class.php';
$link = new conexionclass();
$link->conectarse();

$dia=$_REQUEST['dia'];
$mes=$_REQUEST['mes'];
$year=$_REQUEST['year'];
//$fecha=$_REQUEST['fecha'];

if($dia <> "" and $mes <> "" and $year <> "" ){
    $fecha=$year."-".$mes."-".$dia;
    $consulta123 = "SELECT cod_sct, cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol FROM dbarp.escrituras WHERE fec_doc ='$fecha' LIMIT 0, 150";
    $result=mysql_query($consulta123);
    $cons_total = "SELECT COUNT(*) FROM dbarp.escrituras WHERE fec_doc LIKE '$fecha'";
    $Res_Total = mysql_query($cons_total); $total=mysql_fetch_array($Res_Total) ;
    
    $numeroRegistros = mysql_num_rows($result);
}

if($dia == ""){
    $fecha=$year."-".$mes."-"."%";
    $consulta123 = "SELECT cod_sct, cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol FROM dbarp.escrituras WHERE fec_doc LIKE '$fecha' LIMIT 0,150";
    $cons_total = "SELECT COUNT(*) FROM dbarp.escrituras WHERE fec_doc LIKE '$fecha'";
    $Res_Total = mysql_query($cons_total); $total=mysql_fetch_array($Res_Total) ;

    $result=mysql_query($consulta123);
    $numeroRegistros = mysql_num_rows($result);    
}

if($dia == "" and $mes == 0){
        $fecha=$year."-"."%"."-"."%";
        $consulta123 = "SELECT cod_sct, cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol FROM dbarp.escrituras WHERE fec_doc LIKE '$fecha' LIMIT 0, 200";
        $cons_total = "SELECT COUNT(*) FROM dbarp.escrituras WHERE fec_doc LIKE '$fecha'";
        $Res_Total = mysql_query($cons_total); 
        $total=mysql_fetch_array($Res_Total) ;
        $result=mysql_query($consulta123);
        $numeroRegistros = mysql_num_rows($result);
}

if($num > 0){
}
else
{
	$error="La Fecha colocada, no Existen en la Base de Datos.  Intente con otra fecha.\n El Administrador.";
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="css/busquedas2.css" />
<title>Busqueda de Documentos - ARP</title>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="1135" border="0">
      <caption><?php echo "Se han encontrado :".$numeroRegistros." escritura(s), con la fecha \"".$fecha."\"."?></caption>
    <tr>
      <td>Dia</td>
      <td>Mes</td>
      <td>A&ntilde;o</td>
    <td>
      <input name="button2" type="button" class="boton" id="button2" value="Regresar" onClick="javascript:history.back(-1);" />
      <input name="btnsalir" type="button" class="boton" id="btnsalir" onClick="javascript:location.href='index_old.php'" value="Salir" /></td>
    </tr>
    <tr>
      <td><input name="dia" type="text" id="dia" size="2" maxlength="2" /></td>
      <td><select name="mes" id="mes">
        <option value="0">--</option>
        <option value="01">Ene</option>
        <option value="02">Feb</option>
        <option value="03">Mar</option>
        <option value="04">Abr</option>
        <option value="05">May</option>
        <option value="06">Jun</option>
        <option value="07">Jul</option>
        <option value="08">Ago</option>
        <option value="09">Set</option>
        <option value="10">Oct</option>
        <option value="11">Nov</option>
        <option value="12">Dic</option>
      </select></td>
      <td><input name="year" type="text" id="year" size="4" maxlength="4" /></td>
      <td><select name="notario" id="notario">
      	<option>Busque Notario</option>
      </select>
      <input name="buscar" type="submit" class="boton" id="buscar" value="Buscar" /></td>
    </tr>
  </table>
</form>
<?php
    //$numeroRegistros=mysql_num_rows($res);
    if($numeroRegistros<=0)
    {
    
    }else{
    //////////elementos para el orden
        if(!isset($orden))
        {
          $orden="fec_doc";
        }
        //////////fin elementos de orden
        //////////calculo de elementos necesarios para paginacion
        //////////tama?o de la pagina
    $tamPag=20;
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
    }
    ?>
<table width="1705" border="1">
  <tr>
    <td width="35">Num</td>
    <td width="75">Notario</td>
    <td width="123">Protocolo</td>
    <td width="139">Fecha </td>
    <td width="164">Sub Serie</td>
    <td width="360">Nombre Predio </td>
    <td width="324">Otorgante</td>
    <td width="362">Favorecido</td>
    <td width="65">&nbsp;</td>
  </tr>
  <?php
    $i=1;
  while(@$fila=mysql_fetch_array($result)){
  $datosEscritura=array("cod_sct"=>$fila[0],"notario"=>$fila[1],"escritura"=>$fila[2],"distrito"=>$fila[3],"fecha"=>$fila[4],"subserie"=>$fila[5],"bien"=>$fila[6],"cantFolios"=>$fila[7],"protocolo"=>$fila[8],"obs"=>$fila[9],"numFolios"=>$fila[10]);
  $Escritura=$datosEscritura["cod_sct"];
  ?>
  <tr>
    <td><?php echo $i;?></td>
    <td><?php echo $datosEscritura["notario"];?></td>
    <td><?php echo $datosEscritura["protocolo"];?></td>
    <td><?php echo $datosEscritura["fecha"];?></td>
    <td><?php $sub=$datosEscritura["subserie"];
      /* @var $datosEscritura <type> */
	  $Sis="SELECT des_sub FROM subseries WHERE cod_sub = '$sub'";
	  $Sis1 = mysql_query($Sis);
	  $Sto = mysql_fetch_array($Sis1);
	  echo $Sto[0];
	  ?></td>
    <td><?php echo $datosEscritura["bien"];?></td>
    <td><?php
        
        $con_15="SELECT cod_sct,cod_inv FROM escriotor WHERE cod_sct = '$Escritura'";
	$q15=mysql_query($con_15);
	$a15=mysql_fetch_array($q15);

/* @var $a15 <type> */
        $var1=$a15["cod_inv"];

        $q_fav="SELECT a.Cod_inv, CONCAT(a.Nom_inv,' ',a.Pat_inv,' ',a.Mat_inv) AS persona FROM involucrados as a WHERE a.cod_inv = '$var1'";
        $query22=mysql_query($q_fav) or die (mysql_error()." Error Buscado Favorecido");
        $num33 = mysql_num_rows($query22);
        $r2=mysql_fetch_array($query22);

	echo $r2["persona"];
        if($num33 == 0){
            $RESULT2 = "SELECT Cod_inv, Raz_inv FROM involjuridicas WHERE Cod_inv = '$var1'";
            $QUERY2=mysql_query($RESULT2);
            $FILA2=mysql_fetch_array($QUERY2);
            echo $FILA2["Raz_inv"]." Imprimir";
        }
    ?></td>
    <td><?php
        $con_2="SELECT cod_sct,cod_inv FROM escrifavor WHERE cod_sct ='$Escritura'";
	$q2=mysql_query($con_2);
	$a2=mysql_fetch_array($q2);
        $var3=$a2["cod_inv"];

        $q_fav="SELECT a.Cod_inv, CONCAT(a.Nom_inv,' ',a.Pat_inv,' ',a.Mat_inv) AS persona FROM involucrados as a WHERE a.cod_inv = '$var3'";
        $query22=mysql_query($q_fav) or die (mysql_error()." Error Buscado Favorecido");
        $num33 = mysql_num_rows($query22);
        $r2=mysql_fetch_array($query22);

	echo $r2["persona"];
        if($num33 == 0){
            $RESULT2 = "SELECT Cod_inv, Raz_inv FROM involjuridicas WHERE Cod_inv = '$var3'";
            $QUERY2=mysql_query($RESULT2);
            $FILA2=mysql_fetch_array($QUERY2);
            echo $FILA2["Raz_inv"]." Imprimir";
        }
    ?></td>
    <td><a href="./buscarSct_x_Fecha.php?cod_otor=<?php echo $var1;?>&cod_favor=<?php echo $var3;?>&cod_otor_ju=<?php echo $var1;?>&cod_favor_ju=<?php echo $var3;?>&cod_sct=<?php echo $Escritura;?>">Detalles</a></td>
  </tr>
  <?php
  $i=$i+1;
  }
  ?>
</table>
<div align="center" id="paginar">
  <?php
        if($pagina>1)
        {
        echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina-1)."&orden=".$orden."&fecha=".$fecha."'>";
        echo "<font face='verdana' size='2'>anterior</font>";
        echo "</a> ";
        }

        for($i=$inicio;$i<=$final;$i++)
        {
            if($i==$pagina)
            {
            echo "<font face='verdana' size='2'><b>".$i."</b> </font>";
            }else{
            echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".$i."&orden=".$orden."&fecha=".$fecha."'>";
            echo "<font face='verdana' size='2'>".$i."</font></a> ";
            }
        }
        if($pagina<$numPags)
        {
            echo " <a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina+1)."&orden=".$orden."&fecha=".$fecha."'>";
            echo "<font face='verdana' size='2'>siguiente</font></a>";
        }
        //////////fin de la paginacion
  
        ?>
</div>

</body>
</html>
<?php
}
else
{
   print "<meta http-equiv=Refresh content=\"0 ; url= ../../arpweb/index.htm\">";
}
?>