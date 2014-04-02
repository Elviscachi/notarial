<?php
session_start();
if(isset($_SESSION['busqueda']))
{
    require_once '../Model/conexion.class.php';
    $link = new conexionclass();
    $link->conectarse();

    $otorperjuridica = $_REQUEST['otorperjuridica'];

    $codigo_usuario=$_SESSION['user'];
    $cons1 = "SELECT CONCAT(nom_usu,' ',pat_usu,' ',mat_usu) AS Trabajor FROM usuarios WHERE cod_usu = $codigo_usuario";
    $query = mysql_query($cons1);
    @$dato_user = mysql_fetch_array($query);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="css/busquedas2.css" />
<title>Busqueda</title>

    <script language="javascript" type="text/javascript">
    function muestra(codigo){  /* muestra(codigo, nombre)*/
		location.href="buscar_otorjuri_detail.php?cod_otor_ju="+ codigo +"";
    }
    </script>
</head>
<body>
<form id="busqueda" name="busqueda" method="get" action="">
  <table>
  <thead>
    <tr>
      <th colspan="2">BUSQUEDA POR "OTORGANTES" JURIDICO</th>
      <th><input name="button2" type="button" class="boton" id="button2" value="Regresar" onclick="javascript:history.back(-1);" /></th>
      <th>Usuario en el Sistema:<?php echo $dato_user[0];?></th>
    </tr>
   </thead>
   
    <tr>
      <td width="269">OTORGANTE  JURIDICO</td>
      <td width="492"><input name="otor_juri" type="text" id="otor_juri" size="80" value="<?php echo $otor_juri;?>" /></td>
      <td><input name="btnbuscar" type="submit" class="boton" id="btnbuscar" value="Buscar" /></td>
      <td><input name="btnsalir" type="button" class="boton" id="btnsalir" onclick="javascript:location.href='index_old.php'" value="Salir" /></td>
    </tr>
    <tr>
      <td>Otros</td>
      <td><input type="text" name="otros" id="otros" value="" size="70"/></td>
      <td></td>
      <td></td>
    </tr>
  </table>
</form>
<?php
//inicializo el criterio y recibo cualquier cadena que se desee buscar
        $nexo1 = "%";
        $otor_juri = trim($_REQUEST['otor_juri']);
        $datos1 = explode(" ",$otor_juri);
        $union1 = implode($nexo1, $datos1);

        if($otor_juri =="")
           {
           $error = "Cuadros Vacios. No hay Registros que mostrar";
           }
        else
           {
		   	$criterio = " WHERE Raz_inv LIKE '%$union1%' ";
           }
    $sql="SELECT Cod_inv, Raz_inv FROM involjuridicas ".$criterio;
    $res=mysql_query($sql);
    $numeroRegistros=mysql_num_rows($res);
    if($numeroRegistros<=0)
    {
    echo "<div align='center'>";
    echo "<font face='verdana' size='-2'>No se encontraron resultados</font>";
    echo "</div>";
    }else{
    //////////elementos para el orden
        if(!isset($orden))
        {
          $orden="Raz_inv";
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

//////////fin de dicho calculo
//////////creacion de la consulta con limites
$sql="SELECT Cod_inv,Raz_inv FROM involjuridicas ".$criterio." ORDER BY ".$orden." LIMIT ".$limitInf.",".$tamPag;
$res=mysql_query($sql);

//////////fin consulta con limites
echo "<div align='center'>";
echo "<font face='verdana' size='-2'>encontrados ".$numeroRegistros." resultados<br>";
echo "ordenados por <b>Nombre </b>";
echo "</font></div>";
}
?>
<table>
	<thead>
      <tr>
	  	<th>Num</th>
		<th width="827">OTORGANTE JURIDICO </th>
      </tr>
    </thead>
      
    <tbody>
      <?php
       while($registro=mysql_fetch_array($res))
		{
        ?>
	    <tr onClick="javascript:muestra('<?php echo $registro["Cod_inv"];?>');">
      		<td width="3">&nbsp;</td>
            <td><b><?php echo $registro["Raz_inv"]; ?></b></td>
            
        </tr>
       <?php
       }
       ?>
    </tbody>
	
	<tfoot>
		<tr>
			<td colspan="2">
        <?php
        if($pagina>1)
        {
        echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina-1)."&orden=".$orden."&otor_juri=".$otor_juri."'>";
        echo "<font face='verdana' size='2'>anterior</font>";
        echo "</a> ";
        }

        for($i=$inicio;$i<=$final;$i++)
        {
            if($i==$pagina)
            {
            echo "<font face='verdana' size='2'><b>".$i."</b> </font>";
            }else{
            echo "<a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".$i."&orden=".$orden."&otor_juri=".$otor_juri."'>";
            echo "<font face='verdana' size='2'>".$i."</font></a> ";
            }
        }
        if($pagina<$numPags)
        {
            echo " <a class='p' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina+1)."&orden=".$orden."&otor_juri=".$otor_juri."'>";
            echo "<font face='verdana' size='2'>siguiente</font></a>";
        }
        //////////fin de la paginacion
  
        ?>
        	</td>
   		</tr>    
       </tfoot>
   </table>
</body>
</html>
<?php
}
else
{
    print "<meta http-equiv=Refresh content=\"0 ; url= ../../arpweb/index.htm\">";
}
?>