<?php
session_start();
if (isset($_SESSION['personal'])) {
    require_once '../../Model/cone.php';
    $link = new ConexionClass();
    $link->conectarse();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<link rel="stylesheet" type="text/css" href="../../css/style_ingreso.css" />
<link rel="stylesheet" href="../../css/normalize.css">
<title>Busqueda</title>

<script language="javascript" type="text/javascript">
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
</script>
<style type="text/css">
<!--
.Estilo4 {color: #FFFFFF}
-->
</style>
</head>
<body >
   <form method="post" action="" name="ingreso1">
   <p align="left" class="Estilo3 Estilo4"><img src="../imagenes/Banner2.jpg" width="600" height="100" alt=""/> </p>
<p align="center" class="Estilo3 Estilo4">BUSQUEDAS	</p>
<table width="679" border="1" align="center" bgcolor="#FFFFFF">
  <tr>
    <th scope="row"><div align="center">BUSCAR POR: </div></th>
  </tr>
  <tr>
    <th scope="row">
      <div align="center">
        <input type="button" name="Submit" value="Otorgante Persona Natural" onclick="javascript:location.href='./buscar_otor.php'" />
        |      
  |      
        <input type="button" name="Submit2" value="Otorgante Persona Juridica" onclick="javascript:location.href='./buscar_otor_juri.php'" />
        </div></th>
  </tr>
  <tr>
    <th scope="row">
      <div align="center">
        <input type="button" name="Submit3" value="Favorecido Persona Natural" />
        | | 
        <input type="button" name="Submit4" value="Favorecido Persona Juridica" />
        </div></th></tr>
  <tr>
    <th scope="row"><div align="center">Otros</div></th>
  </tr>
  <tr>
    <th scope="row">
      <div align="center">
        <input type="button" name="Submit5" value="Fecha Exacta" />
        | 
        <input type="button" name="Submit6" value="Numero de Escritura" />
        | 
        <input type="button" name="Submit7" value="Nombre del Bien / Predio" />
        </div></th>
  </tr>
  <tr>
    <th scope="row">
      <div align="center"></div></th>
  </tr>
</table>
   </form>
</body>
</html>
<?php
} else {
    header("Location: ../../index.php");
}
?>