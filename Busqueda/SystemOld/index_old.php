<?php
session_start();
if(isset($_SESSION['busqueda'])){
	require_once '../Model/conexion.class.php';
	$link = new conexionclass();
	$link->conectarse();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="../css/style_ingreso.css" />
<title>Busqueda</title>
<style type="text/css">
	a{
		text-decoration:none;
	}
	a.hover{
		text-decoration:none;
	}
</style>
<script language="javascript" type="text/javascript">
<!--
function ingreso(){
   var opt1 = document.getElementById("opt1").checked;
   var opt2 = document.getElementById("opt2").checked;
   var opt3 = document.getElementById("opt3").checked;

   if (opt1 == true){
      location.href='./buscar_otor.php';
   }
   if (opt2 == true){
      location.href='./buscar_favor.php';
   }
   if (opt3 == true){
      //location.href='./buscar_sct.php';
   }

}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<style type="text/css">
<!--
.Estilo4 {color: #FFFFFF}
#Layer1 {
	position:absolute;
	left:91px;
	top:633px;
	width:313px;
	height:46px;
	z-index:1;
}
-->
</style>
</head>
<body onload="MM_preloadImages('imagenes/busca_08_1.gif','imagenes/busca_09_1.gif','imagenes/busca_10_1.gif','imagenes/busca_11_1.gif','imagenes/busca_13_1.gif','imagenes/busca_14_1.gif','../imagenes/busca1_05_1.gif','../imagenes/busca_06_1.gif')" >
<div id="Layer1"><a href="../Controler/session_close.php">Salir de Busquedas</a></div>
<table width="200" border="1">
  <tr>
    <td><!-- ImageReady Slices (BUSQUEDAS WEB Notarios.psd) -->
      <table id="Tabla_01" width="1025" height="768" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="4"><img src="imagenes/busca_01.gif" width="1024" height="228" alt="" /></td>
          <td><img src="imagenes/espacio.gif" width="1" height="228" alt="" /></td>
        </tr>
        <tr>
          <td colspan="4"><img src="imagenes/busca_02.gif" width="1024" height="70" alt="" /></td>
          <td><img src="imagenes/espacio.gif" width="1" height="70" alt="" /></td>
        </tr>
        <tr>
          <td><img src="imagenes/busca_03.gif" width="390" height="3" alt="" /></td>
          <td colspan="2" rowspan="2"><img src="../imagenes/busca_04_old.gif" width="502" height="60" /></td>
          <td rowspan="8"><img src="imagenes/busca_05.gif" width="132" height="366" alt="" /></td>
          <td><img src="imagenes/espacio.gif" width="1" height="3" alt="" /></td>
        </tr>
        <tr>
          <td><img src="imagenes/busca_06.gif" width="390" height="57" alt="" /></td>
          <td><img src="imagenes/espacio.gif" width="1" height="57" alt="" /></td>
        </tr>
        <tr>
          <td rowspan="2"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image34','','../imagenes/busca1_05_1.gif',1)"><img src="../imagenes/busca1_05.gif" name="Image34" width="390" height="91" border="0" id="Image34" /></a></td>
          <td><a href="./buscar_otor.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image28','','imagenes/busca_08_1.gif',1)"><img src="imagenes/busca_08.gif" name="Image28" width="248" height="82" border="0" id="Image28" /></a></td>
          <td><a href="./buscar_otor_juri.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image29','','imagenes/busca_09_1.gif',1)"><img src="imagenes/busca_09.gif" name="Image29" width="254" height="82" border="0" id="Image29" /></a></td>
          <td><img src="imagenes/espacio.gif" width="1" height="82" alt="" /></td>
        </tr>
        <tr>
          <td rowspan="2"><a href="./buscar_favor.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image30','','imagenes/busca_10_1.gif',1)"><img src="imagenes/busca_10.gif" name="Image30" width="248" height="78" border="0" id="Image30" /></a></td>
          <td rowspan="2"><a href="./buscar_favor_juri.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image31','','imagenes/busca_11_1.gif',1)"><img src="imagenes/busca_11.gif" name="Image31" width="254" height="78" border="0" id="Image31" /></a></td>
          <td><img src="imagenes/espacio.gif" width="1" height="9" alt="" /></td>
        </tr>
        <tr>
          <td rowspan="2"><a href="../buscar_index.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image35','','../imagenes/busca_06_1.gif',1)"><img src="../imagenes/busca_12.gif" name="Image35" width="390" height="103" border="0" id="Image35" /></a></td>
          <td><img src="imagenes/espacio.gif" width="1" height="69" alt="" /></td>
        </tr>
        <tr>
          <td rowspan="2"><a href="./buscar_x_fecha.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image32','','imagenes/busca_13_1.gif',1)"><img src="imagenes/busca_13.gif" name="Image32" width="248" height="89" border="0" id="Image32" /></a></td>
          <td rowspan="2"><a href="#" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image33','','imagenes/busca_14_1.gif',1)"><img src="imagenes/busca_14.gif" name="Image33" width="254" height="89" border="0" id="Image33" /></a></td>
          <td><img src="imagenes/espacio.gif" width="1" height="34" alt="" /></td>
        </tr>
        <tr>
          <td rowspan="2"><img src="imagenes/busca_15.gif" width="390" height="112" alt="" /></td>
          <td><img src="imagenes/espacio.gif" width="1" height="55" alt="" /></td>
        </tr>
        <tr>
          <td colspan="2"><img src="imagenes/busca_16.gif" width="502" height="57" alt="" /></td>
          <td><img src="imagenes/espacio.gif" width="1" height="57" alt="" /></td>
        </tr>
        <tr>
          <td colspan="4"><img src="imagenes/busca_17.gif" width="1024" height="104" alt="" /></td>
          <td><img src="imagenes/espacio.gif" width="1" height="104" alt="" /></td>
        </tr>
      </table>
      <!-- End ImageReady Slices --></td>
  </tr>
</table>
   <p>x   </p>
</body>
</html>
<?php
}
else
{
    header("Location: ../../index.php");
}
?>