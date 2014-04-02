<?php
session_start();
if(isset($_SESSION['user'])){
require_once '../../Model/cone.php';
$link = new ConexionClass();
$link->Conectado();

$fec_actual= date("Y-m-d");
$cod_usu = $_REQUEST['trab'];
$fec_ini = $_REQUEST['fecha_ini'];
$fec_fin = $_REQUEST['fecha_fin'];

if($fec_fin == ""){
   $text = "SELECT hra_ing,cod_usu,cod_sct,num_sct FROM escrituras1 ";
   $text .=" where hra_ing LIKE '$fec_ini%' ";
   $text .= "and cod_usu like '$cod_usu' order by hra_ing";

   $query = mysql_query($text);
   }
   else{
   	if($fec_ini == $fec_fin){
	
	$text = "SELECT hra_ing,cod_usu,cod_sct,num_sct FROM escrituras1 ";
    $text .=" where hra_ing LIKE '$fec_ini%' ";
    $text .= "and cod_usu like '$cod_usu' order by hra_ing";
	
    $query = mysql_query($text);
	}
	else{
	   $text = "SELECT hra_ing,cod_usu,cod_sct,num_sct FROM escrituras1 ";
	   $text .=" where hra_ing between '$fec_ini 00:00:00' and '$fec_fin 23:59:59' ";
	   $text .= "and cod_usu like '$cod_usu' order by hra_ing";
	   
	   $query = mysql_query($text);
   	}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="admin_style.css">
<link rel="stylesheet" type="text/css" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css">
<link rel="stylesheet" href="../../css/normalize.css">
<script type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<title>Busqueda</title>
</head>
<body >
   <h3>Reportes Diarios de Ingreso a la Base de Datos</h3>
   <form name="buscar" method="get" action="">
<table width="892" border="0" align="center" cellpadding="0" cellspacing="0">
   <tr>
      <th width="450" valign="top"><p align="left">Opciones:
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
          <br />
      </p></th>
      <th width="442" valign="top"><div align="left">Total de Filas:  <b>
          <?php $n = mysql_num_rows($query); echo $n;?>
          </b><br/>
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
      </div></th>
   </tr>
   <tr align="top">
      <td valign="top">Dia: (Marque la Fecha en el Calendario) <br />
Empieza:
  <input type="text" name="fecha_ini" value="<?php echo $fec_actual;?>" id="fecha_ini" />
  <input name="button" type="button" class="boton" onclick="displayCalendar(document.buscar.fecha_ini,'yyyy-mm-dd',this)"  value="Calendario"/>
  <br />
  <br />
Finaliza:
<input type="text" name="fecha_fin" />
<input name="button" type="button" class="boton" onclick="displayCalendar(document.buscar.fecha_fin,'yyyy-mm-dd',this)"  value="Calendario"/><br />      </td>
      <td align="up" valign="top">
      <table width="406" border="1">
            <tr>
               <th width="185" height="25">Hra_Ing</th>
               <th width="57">Usuario</th>
               <th width="68">Cod_sct</th>
               <th width="68">Num_Sct</th>
            </tr>
            <?php
            while($fila= mysql_fetch_array($query)){
            $datos = array("hora"=>$fila[0],"usuario"=>$fila[1],"escritura"=>$fila[2],"num_sct"=>$fila[3]);
            ?>
            <tr>
               <td><?php echo $datos["hora"];?></td>
               <td><?php echo $datos["usuario"];?></td>
               <td><?php echo $datos["escritura"];?></td>
               <td><?php echo $datos["num_sct"];?></td>
            </tr>
            <?php
            }
            ?>
        </table>      </td>
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
