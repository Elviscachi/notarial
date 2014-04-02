<?php
session_start();
if(isset($_SESSION['user'])){
require_once '../../Model/cone.php';
$link = new ConexionClass();
$link->Conectado();

$fec_actual= date("Y-m-d");
$cod_usu = $_REQUEST['trab'];
$mes = $_REQUEST['mes'];
$anio = $_REQUEST['anio'];

   $text = "SELECT COUNT(*) FROM escrituras1 WHERE hra_ing between '$anio-$mes-01 00:00:00' and '$anio-$mes-30 23:59:59' AND cod_usu LIKE '$cod_usu';";
   $query = mysql_query($text);
   $valor = mysql_fetch_array($query);
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="admin_style.css" />
<link rel="stylesheet" type="text/css" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css" />
<link rel="stylesheet" href="../../css/normalize.css">
<script type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<title>Busqueda</title>
</head>
<body >
   <h3>Reportes Diarios de Ingreso a la Base de Datos</h3>
   <form name="buscar" method="get" action="">
<table width="722" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
      <th valign="top"><p align="left">Opciones:
          <a href="report_ingreso_print.php?trab=<?php echo $cod_usu;?>&fecha_ini=<?php echo $fec_ini;?>&fecha_fin=<?php echo $fec_fin;?>">Exportar la Lista a Excel</a> |  <a href="./index.php">Salir</a></p>
        <p align="left">Trabajador:
          <select name="trab">
            <option value="%">Todos</option>
            <?php
               $tra =mysql_query("SELECT cod_usu, CONCAT(nom_usu,' ',pat_usu) AS Usuario FROM usuarios WHERE chk_usu <> 0;");
               while ($res_tra = mysql_fetch_array($tra)){
            ?>
            <option value="<?php echo $res_tra[0];?>">
              <?php echo $res_tra[1];?>
            </option>
            <?php
               }
            ?>
          </select>
          <input name="buscar2" type="submit" class="boton" value="Buscar" />
          Mes:
          <select name="mes" id="mes">
            <option value="01">Enero</option>
            <option value="02">Febrero</option>
            <option value="03">Marzo</option>
            <option value="04">Abril</option>
            <option value="05">Mayo</option>
            <option value="06">Junio</option>
            <option value="07">Julio</option>
            <option value="08">Agosto</option>
            <option value="09">Setiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
          </select>
	<label>A&ntilde;o</label>
	<select name="anio" id="anio">
		<option value="2010">2010</option>
		<option value="2011">2011</option>
		<option value="2012">2012</option>
		<option value="2013">2013</option>
		<option value="2014" selected>2014</option>	
	</select>
	<input name="buscar2" type="submit" class="boton" value="Buscar"/>
<br />
      </p></th>
      <th valign="top">&nbsp;</th>
   </tr>
   <tr align="top">
      <td valign="top"><p><br />
        Trabajador:
          <?php 
		 if($cod_usu == "%"){
		 echo "Todos los Usuarios";
		 }
		 else{
		 @$nom = mysql_query("SELECT CONCAT(nom_usu,' ',pat_usu,' ',mat_usu) AS Usuario FROM usuarios WHERE cod_usu = $cod_usu");
		 @$Dat = mysql_fetch_array($nom);
		 echo $Dat[0];
		 }
		 ?>
        </p>
        <p>Total de Ingresos en el Mes de<b>
          <?php 
	  $mes;
          switch ($mes) {
             case 1: echo "Enero"; break;
             case 2: echo "Febrero"; break;
             case 3: echo "Marzo"; break;
             case 4: echo "Abril"; break;
             case 5: echo "Mayo"; break;
             case 6: echo "Junio"; break;
             case 7: echo  "Julio"; break;
             case 8: echo "Agosto"; break;
             case 9: echo "Setiembre"; break;
             case 10: echo "Octubre"; break;
             case 11: echo "Noviembre"; break;
             case 12: echo "Diciembre"; break;
            }
	  ?>
          : <?php echo $valor[0];?> </b><br />      
        </p></td>
      <td align="up" valign="top">&nbsp;</td>
   </tr>
</table>
</form>
</body>
</html>
<?php
}
else
{
    print "<meta http-equiv=Refresh content=\"0 ; url= ../../index.php\">";
}
?>
