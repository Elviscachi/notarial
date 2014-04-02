<?php
session_start();
if(isset($_SESSION['busqueda']))
{
?>
<!DOCTYPE html>
<html>
<head>
  <title>BUSQUEDAS WEB</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <script type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('imagenes/busca_06_1.gif','imagenes/busca1_05_1.gif')">
<!-- ImageReady Slices (BUSQUEDAS WEB.psd) -->
<table id="Tabla_01" width="1024" height="768" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><img src="imagenes/busca1_01.gif" width="1024" height="228" alt=""></td>
  </tr>
  <tr>
    <td colspan="2"><img src="imagenes/busca1_02.gif" width="1024" height="73" alt=""></td>
  </tr>
  <tr>
    <td><img src="imagenes/busca1_03.gif" width="390" height="57" alt=""></td>
    <td rowspan="4"><img src="imagenes/busca1_04.gif" width="634" height="363" alt=""></td>
  </tr>
  <tr>
    <td><a href="./SystemOld/index_old.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image9','','imagenes/busca1_05_1.gif',1)"><img src="imagenes/busca1_05.gif" name="Image9" width="390" height="91" border="0"></a></td>
  </tr>
  <tr><a href="">Busqueda</a>
    <td><a href="./buscar_index.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image8','','imagenes/busca_06_1.gif',1)"><img src="imagenes/busca_12.gif" name="Image8" width="390" height="103" border="0"></a></td>
  </tr>
  <tr>
    <td><img src="imagenes/busca1_07.gif" width="390" height="112" alt=""></td>
  </tr>
  <tr>
    <td colspan="2"><img src="imagenes/busca1_08.gif" width="1024" height="104" alt=""></td>
  </tr>
</table>
<!-- End ImageReady Slices -->
</body>
</html>
<?php
}
else
{
    header("Location:../../index.php");
}
?>