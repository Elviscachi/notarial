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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=es-iso-8859-1" /> 
<link rel="stylesheet" type="text/css" href="../../css/style_ingreso.css" />
<link rel="stylesheet" type="text/css" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css">
<link rel="stylesheet" href="../../css/normalize.css">

<script type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<title>Busqueda</title>
</head>
<body >
   <h3 align="center">Reportes Diarios de Ingreso a la Base de Datos</h3>
   <form name="buscar" method="get" action="">
<table width="" border="1" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
   <tr>
      <td width="400"><p>Opciones:
          <a href="report_ingreso_print.php?trab=<?=$cod_usu;?>&fecha_ini=<?=$fec_ini;?>&fecha_fin=<?=$fec_fin;?>">Exportar la Lista a Excel</a> |  Salir</p>
        <p>Trabajador:
          <select name="trab">
            <option value="%">Todos</option>
            <?php
               $tra =mysql_query("select cod_usu, concat(nom_usu,' ',pat_usu) as Usuario from usuarios");
               while ($res_tra = mysql_fetch_array($tra)){
            ?>
            <option value="<?=$res_tra[0];?>">
              <?=$res_tra[1];?>
            </option>
            <?php
               }
            ?>
          </select>
          <input name="buscar2" type="submit" class="boton" value="Buscar" />
          <br />
          <br />
        Dia: (Marque la Fecha en el Calendario) <br />
Empieza:
<input type="text" name="fecha_ini" value="<?=$fec_actual;?>" id="fecha_ini" />
<input type="button" class="boton" onclick="displayCalendar(document.buscar.fecha_ini,'yyyy-mm-dd',this)"  value="Calendario"/>
<br />
<br />
Finaliza:
<input type="text" name="fecha_fin" />
<input type="button" class="boton" onclick="displayCalendar(document.buscar.fecha_fin,'yyyy-mm-dd',this)"  value="Calendario"/>
        </p></td>
      <td width="500" valign="top"><h2>Resultado:</h2><br/>
        Total de Filas:  <b>
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
        <br/>      
      </td>
   </tr>
   <tr align="top">
      <td><br />      </td>
      <td align="up" valign="top">
      <table border="1">
            <tr>
               <td>Hra_Ing</td>
               <td>Usuario</td>
               <td>Cod_sct</td>
               <td>Num_Sct</td>
            </tr>
            <?
            while($fila= mysql_fetch_array($query)){
            $datos = array("hora"=>$fila[0],"usuario"=>$fila[1],"escritura"=>$fila[2],"num_sct"=>$fila[3]);
            ?>
            <tr>
               <td><?=$datos["hora"];?></td>
               <td><?=$datos["usuario"];?></td>
               <td><?=$datos["escritura"];?></td>
               <td><?=$datos["num_sct"];?></td>
            </tr>
            <?
            }
            ?>
         </table>      </td>
   </tr>
</table>
</form>
</body>
</html>
<?
}
else
{
    print "<meta http-equiv=Refresh content=\"0 ; url= ../../index.php\">";
}
?>