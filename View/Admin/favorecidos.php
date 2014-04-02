<?   //Para la conexion con la Base de Datos
session_start();
if(isset($_SESSION['user'])){
require_once '../../Model/cone.php';
$link = new ConexionClass();
$link->Conectado();

$codigo_otorgante = $_REQUEST['codigo_otorgante'];
echo $codigo_otorgante;

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
<title>Favorecido - ARP</title>
<style type="text/css">
<!--
.Estilo6 {color: #FFFFFF}
.Estilo5 {color: #CCCCCC}
-->
</style>
</head>

<script language="javascript" type="text/javascript">
function enviar_datos(){
    var cod_otor = document.getElementById("cod_otor").value;
    alert('Dato Agregado Correctamente');
    location.href("./ingreso.php?favor="+cod_otor+"");
    window.close(); 
}
</script>

<body>
<table width="1055" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="600" rowspan="2"><img src="../imagenes/Banner2.jpg" alt="banner" width="600" height="100" /></td>
    <td height="55">Usuario en el Sistema:<span class="Estilo5">
      <?=$dato1[0];?>
    </span></td>
  </tr>
  <tr>
    <td> Regresar - Volver atras | <a href="../../Controler/session_close.php">Salir del Sistema</a></td>
  </tr>
</table>
<form action="" method="post" enctype="multipart/form-data" name="involucrados" id="involucrados">
  <p align="center"><img src="../imagenes/FAVORECIDO.jpg" width="400" height="32" /></p>
  <div align="center">
   <table width="698" border="1" cellpadding="1" cellspacing="4" bgcolor="#330000">
       <tr>
       		<td colspan="5" bgcolor="#3C5E83"><div align="left"><img src="../imagenes/Pers_Natural.jpg" width="400" height="32" /></div></td>
   	  </tr>
      <tr>
        <td><div align="center"><span class="Estilo6">Apellidos Paterno</span></div></td>
        <td><div align="center"><span class="Estilo6">Apellido Materno</span></div></td>
        <td><div align="center"><span class="Estilo6">Nombre(s)</span></div></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><input type="text" name="paterno" id="paterno" value="<?=$paterno;?>" /></td>
        <td><input type="text" name="materno" id="materno" value="<?=$materno;?>" /></td>
        <td><input type="text" name="nombres" id="nombres" value="<?=$nombres;?>" /></td>
        <td><input type="submit" class="boton" name="btnbuscar" id="btnbuscar" value="Buscar" />
          <?php
        if(isset($_POST[btnbuscar]))
 		{
        $nombres = $_POST['nombres'];
        $paterno = $_POST['paterno'];
        $materno = $_POST['materno'];
        if($nombres =="" and $paterno =="" and $materno =="")
            {
    	       $error = "No hay Registros que mostrar";
            }
        else
            {
                $query4 = "SELECT Cod_inv, Pat_inv, Mat_inv, Nom_inv AS Nombre FROM involucrados1 ";
                $query4 .= " WHERE Nom_inv LIKE '$nombres%' AND Pat_inv LIKE '$paterno%' AND Mat_inv LIKE '$materno%' ORDER BY Pat_inv";
                $result4 = mysql_query($query4);
                $num4 = mysql_num_rows($result4);

                if($num4 == 0){
       		       $error = "El Otorgante que Busca, no se encuentra en la Base de Datos";
                    }
	    }
        }
        ?></td>
        <td>
          <input type="button" class="boton" name="btnNuevo1" id="btnNuevo1" value="Nuevo Otorgante" onclick="javascript:location.href='./add_involucrado2.php?codigo_otorgante=<?=$codigo_otorgante;?>&nombres=<?=$nombres;?>&paterno=<?=$paterno?>&materno=<?=$materno;?>'" />
        </td>
      </tr>
    </table>
    <table width="700" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <td><div class="error">
          <?=$error;?>
        </div></td>
      </tr>
    </table>
    <table width="698" border="1" cellpadding="1" cellspacing="4" bgcolor="#330000">
      <?php
	while(@$fila4=mysql_fetch_array($result4)){
    ?>
      <tr>
        <td width="160" bgcolor="#D5E4FD"><input type="hidden" name="cod_otor" id="cod_otor" value="<?=$fila4[0];?>" readonly="readonly" />
          <?=$fila4[1];?></td>
        <td width="145" bgcolor="#D5E4FD"><?=$fila4[2];?></td>
        <td width="151" bgcolor="#D5E4FD"><?=$fila4[3];?></td>
        <td width="218" bgcolor="#FDFECB"><a href="ingreso.php?codigo_favorecido=<?=$fila4[0];?>&codigo_otorgante=<?=$codigo_otorgante;?>">SELECCIONAR</a></td>
      </tr>
      <?
          }
    ?>
    </table>
  </div>
  <div align="center">
    <table width="698" border="1" cellpadding="1" cellspacing="4" bgcolor="#330000">
    	<tr>
       		<td colspan="5" bgcolor="#3C5E84"><div align="left"><img src="../imagenes/Pers_Juridica.jpg" width="400" height="32" /></div></td>
   	  </tr>
      <tr>
        <td><input type="text" name="otorperjuridica" id="paterno2" value="<?=$otorperjuridica;?>" size="60" /></td>
        <td><input type="submit" class="boton"name="btnbuscarpj" id="btnbuscarpj" value="Buscar" />
          <?php
        if(!(isset ($_GET["btnbuscarpj"])))
            {
		$nexo1 = "%";
        $otorperjuridica = $_REQUEST['otorperjuridica'];
		$datos1 = explode(" ",$otorperjuridica);
        $union1 = implode($nexo1, $datos1);
       
        if($otorperjuridica =="")
            {
           $error = "No hay Registros que mostrar";
           }
           else
            {
                $query2 = "SELECT Cod_inv, Raz_inv FROM involjuridicas1 WHERE Raz_inv LIKE '%$union1%'";
                $result2 = mysql_query($query2);
                $num2 = mysql_num_rows($result2);

                if($num2 == 0){
                    $error = "El Otorgante que Busca, no se encuentra en la Base de Datos";
                    }
            }
            }
        ?>
          <input type="button" class="boton" name="btnNuevo2" id="btnNuevo2" value="Nuevo Otorgante" onclick="javascript:location.href='./add_invol_juridica2.php?codigo_otorgante=<?=$codigo_otorgante;?>'"/></td>
      </tr>
      <?
    while(@$fila2=mysql_fetch_array($result2)){
	?>
      <tr>
        <td bgcolor="#D5E4FD"><input type="hidden" name="cod_otor_juridica" id="cod_otor_juridica" value="<?=$fila2[0];?>" readonly="readonly" />
          <?=$fila2[1];?></td>
        <td bgcolor="#FDFECB"><a href="ingreso.php?codigo_favorecido=<?=$fila2[0];?>&codigo_otorgante=<?=$codigo_otorgante;?>">SELECCIONAR</a></td>
      </tr>
      <?
    }
	?>
    </table>
    <table width="686" border="0" cellspacing="4" cellpadding="1">
      <tr>
        <td><?
        if ($error == ""){
	}
	else{
	 echo '<div class="error">'.$error;'</div>';
	}
        ?></td>
      </tr>
    </table>
  </div>
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