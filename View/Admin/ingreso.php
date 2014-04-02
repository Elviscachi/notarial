<?php
session_start();
if(isset($_SESSION['user'])){
require_once '../../Model/cone.php';
$link = new ConexionClass();
$link->Conectado();

$cod_otor =$_REQUEST['codigo_otorgante'];
$cod_favor = $_REQUEST['codigo_favorecido'];

$codigo_usuario=$_SESSION['user'];
$cons1 = "SELECT CONCAT(nom_usu,' ',pat_usu,' ',mat_usu) AS Trabajor FROM usuarios WHERE cod_usu = $codigo_usuario";
$query = mysql_query($cons1);
@$dato1 = mysql_fetch_array($query);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=es-iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../../css/style_ingreso.css">
<link rel="stylesheet" href="../../css/normalize.css">

<title>Sistema de Busqueda</title>
<script language="javascript1.5" type="text/javascript">

 function validar(){
    var num_sct = document.getElementById("nescritura").value;
    var protocolo = document.getElementById("protocolo").value;
    var num_fol = document.getElementById("nfolios").value;
    var tot_fol = document.getElementById("tfolios").value;
    var subserie = document.getElementById("subserie").value;
    var distritos = document.getElementById("distritos").value;
    var nbien = document.getElementById("nbien").value;
    var dia = document.getElementById("dia").value;
    var mes = document.getElementById("mes").value;
    var year = document.getElementById("year").value;
    var codigo_otorgantes = document.getElementById("codigo_otorgantes").value;
    var codigo_favorecidos = document.getElementById("codigo_favorecidos").value;

    if(protocolo ==""){
        alert("NO HA INGRESADO EL PROTOCOLO DE LA ESCRITURA");
        document.getElementById("protocolo").focus();
        return false;
    }
	else if(!(isNaN(protocolo))){
	
	}else{
			alert("Ingrese un Numero en el Protocolo");
			document.getElementById("protocolo").value="";
			document.getElementById("protocolo").focus();
			return false;
    }
	
	if(num_fol == ""){
        alert("NO HA INGRESADO EL FOLIO DE LA ESCRITURA");
        document.getElementById("nfolios").focus();
        return false;
    }
	if (num_sct == ""){
        alert("NO HA INGRESADO EL NUMERO DE LA ESCRITURA");
        document.getElementById("nescritura").focus();
        //document.getElementById("nescritura").style.color="#006699";
        return false;
    }
	else if(!(isNaN(num_sct))){

	}else{
			alert("Ingrese un Numero en el Numero de Escritura");
			document.getElementById("nescritura").value="";
			document.getElementById("nescritura").focus();
			return false;
    }
	
	
    if(subserie== 0){
        alert("NO HA SELECCIONADO UNA SUBSERIE");
        document.getElementById("subserie").focus();
        return false;
    }
    if(distritos == 0){
        alert("NO HA SELECCIONADO EL DISTRITO");
        document.getElementById("distritos").focus();
        return false;
    }
   /* if(nbien == ""){
        alert("NO HA INGRESADO NOMBRE DEL BIEN.");
        
        if(!(confirm("DESEA DEJARLO EN BLANCO?"))){
            document.getElementById("nbien").focus();
			return false;
        }
    }
	*/
    if (dia == "")
	{ alert("Por favor ingresa DIA DE NACIMIENTO ");
	  document.getElementById("dia").focus();
	  return false;
	}
    else if(!(isNaN(dia)))
    	{
	  if (document.getElementById("dia").value>=0 && document.getElementById("dia").value<=31)
	  {
	  }
	  else
	  {
	   alert("Debe Ingresar un Numero entre 1 y 31");
	    document.getElementById("dia").value = "";
	    document.getElementById("dia").focus();
       return 0;
	  }
	}
	else
	{
	alert("No puede Poner Letras en el Dia de Nacimiento");
	document.getElementById("dia").value = "";
	document.getElementById("dia").focus();
	return 0;
	}

    if (mes == 0){
    	alert("Por favor SELECCIONA UN MES DE NACIMIENTO");
        document.getElementById("mes").focus();
        return false;
    }
    if(year == ""){
        alert("INGRESE EL A&Ntilde;O");
        document.getElementById("year").focus();
        return false;
    }else if(!(isNaN(year))){
	  	var fecha = new Date();
		var year_now = fecha.getYear();
		var f = year_now + 1900;
			if (year > f){
				alert("La fecha Introducida ES MAYOR al a�o actual");
				document.getElementById("year").value = "";
				document.getElementById("year").focus();
				return false;
			}
			else
			{
			}
	  }
	  else
	  {
	    alert("No Escriba Letras en el A&ntilde;o");
	    document.getElementById("year").value = "";
	    document.getElementById("year").focus();
        return false;
	  }
	  
	  
	  
	if(tot_fol ==""){
        alert("NO HA INGRESADO EL TOTAL DE FOLIOS");
        document.getElementById("tfolios").focus();
        return false;
    }
    if(codigo_otorgantes == ""){
        alert("Error: No hay un Otorgante Seleccionado \nConsulte con el Administrador del Sistema para Solucionar el Problema.");
        document.getElementById("codigo_otorgantes").focus();
        return false;
    }
    if(codigo_favorecidos == ""){
        alert("Error: No hay un Favorecido Seleccionado \nConsulte con el Administrador del Sistema para Solucionar el Problema.");
        document.getElementById("codigo_favorecidos").focus();
        return false;
    }
	insert.submit();
	return true;
}
</script>
<style type="text/css">
<!--
.Estilo4 {color: #990000}
.Estilo5 {
	color: #333399
}
body {
	background-color: #3c5e83;
}
.Estilo6 {color: #CCCCCC}
-->
</style>
</head>
<body>
   <table width="1055" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td width="600" rowspan="2"><img src="../imagenes/Banner2.jpg" alt="banner" width="600" height="100" /></td>
       <td height="55">Usuario en el Sistema:<span class="Estilo6">
         <?=$dato1[0];?>
       </span></td>
     </tr>
     <tr>
       <td> Regresar - Volver atras | <a href="../../Controler/session_close.php">Salir del Sistema</a></td>
     </tr>
   </table>
<form id="insert" name="insert" method="post" action="../../Model/ingreso_save.php">
<table width="742" border="0" align="center" cellpadding="1" cellspacing="4" background="../imagenes/fondo.jpg">
	<tr>
    	<td colspan="5" bgcolor="#3C5E84"><div align="center"><img src="../imagenes/datos_escritura.jpg" width="600" height="32" /></div></td>
    </tr>
  <tr>
    <th width="100" scope="row">Protocolo</th>
    <td width="218"><span class="Estilo1">
      <input name="protocolo" type="text" class="textos" id="protocolo" size="5" value="<?=$protocolo;?>" />
      <select name="tipoprotocolo" id="tipoprotocolo">
        <?
            $query="SELECT cod_tippro, tipoproto FROM protocolos";
            $result = mysql_query($query);
            while ($row=mysql_fetch_array($result)){
            ?>
        <option value="<?=$row[0];?>">
        <?=$row[1];?>
        </option>
        <?
            }
            ?>
      </select>
    </span></td>
    <th width="180">Folio</th>
    <td width="100"><input name="nfolios" type="text" class="textos" id="nfolios" size="5" value="<?=$nfolios;?>"/></td>
    <td width="158">&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Num. Escritura</th>
    <td><span class="Estilo1">
      <input name="nescritura" type="text" class="textos" id="nescritura" size="5" value="<?=$nescritura;?>" />
      </span></td>
    <th><div align="left"></div></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">Sub Serie</th>
    <td>
    <select name="subserie" id="subserie">
    	<option value="0">--</option>
      <?
            $query="SELECT cod_sub, des_sub FROM subseries ORDER BY des_sub";
            $result = mysql_query($query);
            while ($row=mysql_fetch_array($result)){
            ?>
      <option value="<?=$row[0];?>">
        <?=$row[1];?>
        </option>
      <?
            }
            ?>
    </select></td>
    <td colspan="3">Distrito<span class="Estilo1">
      <select name="distritos" id="distritos">
        <option value="211101" selected="selected">JULIACA</option>
        <?
            $q_dst = "SELECT cod_dst, des_dst FROM distritos WHERE cod_pvi > 210000 and cod_pvi < 211301 ORDER BY des_dst";
            $result_dst = mysql_query($q_dst);
            while ($row_dst = mysql_fetch_array($result_dst)){
            ?>
        <option value="<?=$row_dst[0];?>">
        <?=$row_dst[1];?>
        </option>
        <?
            }
            ?>
      </select>
    </span></td>
    </tr>
  <tr>
    <th scope="row">Nombre del Bien</th>
    <td colspan="4"><input name="nbien" type="text" class="direccion" id="nbien" value="<?=$nbien;?>" /></td>
    </tr>
  <tr>
    <th scope="row">Fecha</th>
    <td> <input name="dia" type="text" class="dia" id="dia" size="2" maxlength="2" value="<?=$dia;?>"/>
      
        <select name="mes" id="mes">
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
      </select>
      <input name="year" type="text" class="year" id="year" size="4" maxlength="4" value="<?=$year;?>" />      </td>
    <td colspan="3"><input type="hidden" name="codigo_otorgantes" id="codigo_otorgantes" value="<?=$codigo_otorgante;?>" />
      <input type="hidden" name="codigo_favorecidos" id="codigo_favorecidos" value="<?=$codigo_favorecido;?>" /></td>
    </tr>
  <tr>
    <th scope="row">Total Folios</th>
    <td colspan="4"><span class="Estilo1">
      <input name="tfolios" type="text" class="textos" id="tfolios" size="5" value="<?=$tfolios;?>" />
    </span></td>
  </tr>
  <tr>
    <th scope="row">NOTARIO</th>
    <td colspan="4"><select name="notario" id="notario">
      	<option value="112" selected="selected">LUIS ALFREDO CUBA OVALLE</option>
      	<?
            $q_not = "SELECT cod_not, CONCAT(nom_not, ' ',pat_not,' ' , mat_not) AS NOTARIO FROM notarios ORDER BY pat_not";
            $result_not = mysql_query($q_not);
            while($not4 = mysql_fetch_array($result_not)){
        ?>
                <option value="<?=$not4[0];?>"><?=$not4[1];?></option>
        <?
            }
        ?>
      </select></td>
    </tr>
  <tr>
    <th scope="row">Observaciones </th>
    <td colspan="4"><textarea name="obs" id="obs" cols="70" rows="3"></textarea></td>
    </tr>
 </table>
<table width="477" height="50" align="center" >
<tr height="20">
        <td colspan="2"><div align="center">
            <input name="btncancelar" type="button" class="boton" id="button16" value="Cancelar" onclick="javascript:location.href='./index.php'" />
        </div></td>
        <td><div align="center">
            <input name="btnguardar" type="button" class="boton" id="button13" value="Guardar" onclick="validar()" />
        </div></td>
        <td>&nbsp;</td>
      <td><input name="btnsalir" type="button" class="boton" id="button17" value="Salir" onclick="javascript:location.href='./index.php'" /></td>
      </tr>
    </table>
</form>

   <p>&nbsp;</p>
</body>
</html>
<?
}
else
{
	print "<meta http-equiv=Refresh content=\"0 ; url= ../../index.php\">";
}
?>