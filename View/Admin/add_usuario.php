<?php
session_start();
// Comprovamos si existe la variable
require_once '../../Model/cone.php';
$link = new ConexionClass();
$link->Conectado();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=es-iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../../css/style_ingreso.css" />
<link rel="stylesheet" href="../../css/normalize.css">
<title>Sistema de Busqueda</title>
<script language="javascript" type="text/javascript">
	function validar(){
		var nombre = document.getElementById("nom_usu").value;
		var paterno= document.getElementById("pat_usu").value;
		var materno = document.getElementById("mat_usu").value;
		var direc = document.getElementById("dir_usu").value;
		var telf = document.getElementById("tel_usu").value;
		var login = document.getElementById("login").value;
		var clave1 = document.getElementById("clave1").value;
		var clave2 = document.getElementById("clave2").value;
		var tipo = document.getElementById("tipo").value;
		var habilitado = document.getElementById("nom_usu").value;
		
		if(nombre == ""){
			alert("Ingrese NOMBRE DE USUARIO");
			document.getElementById("nom_usu").focus();
			return false;
		}
		if(paterno == ""){
			alert("Ingrese APELLIDO PATERNO");
                        document.getElementById("pat_usu").focus();
			return false;
		}
		if(materno == ""){
			alert("Ingrese APELLIDO MATERNO");
                        document.getElementById("mat_usu").focus();
			return false;
		}
		if(login == ""){
			alert("Ingrese LOGIN DEL USUARIO");
                        document.getElementById("login").focus();
                        return false;
		}
                if(clave1 == ""){
			alert("Ingresa Clave, No puede estar vacio");
                        document.getElementById("clave1").focus();
                        return false;
		}
                if(clave2 == ""){
			alert("Ingresa Clave2, No puede estar vacio");
                        document.getElementById("clave2").focus();
                        return false;
		}
            if (clave1 == clave2){
		
		}else{
                   alert("Las Contraseñas no coinciden");
                   document.getElementById("clave1").value = "";
                   document.getElementById("clave2").value = "";
                   document.getElementById("clave1").focus();
               }
		insert.submit();
		return true;
	}
</script>
<style type="text/css">
<!--
body {
	background-image: url(../imagenes/FONDO1.png);
}
-->
</style></head>
<body>
<form id="insert" name="insert" method="post" action="./Model/save_usuario.php">
  <h3 align="center" class="Estilo1">  Sistema de Ingreso</h3>
  <table width="493" border="0" align="center" cellpadding="0" cellspacing="4">
    <tr>
      <th width="186" scope="row"><div align="center">Nombre(s)</div></th>
      <td width="307"><input name="nom_usu" type="text" class="mayus" id="nom_usu" /></td>
    </tr>
    <tr>
      <th scope="row"><div align="center">Apellido Paterno</div></th>
      <td><input name="pat_usu" type="text" class="mayus" id="pat_usu" /></td>
    </tr>
    <tr>
      <th scope="row"><div align="center">Apellido Materno</div></th>
      <td><input name="mat_usu" type="text" class="mayus" id="mat_usu" /></td>
    </tr>
    <tr>
      <th scope="row"><div align="center">Direccion</div></th>
      <td><input name="dir_usu" type="text" class="mayus" id="dir_usu" size="40" /></td>
    </tr>
    <tr>
      <th scope="row"><div align="center">Telefono</div></th>
      <td><input name="tel_usu" type="text" class="mayus" id="tel_usu" /></td>
    </tr>
    <tr>
      <th scope="row"><div align="center"></div></th>
      <td>&nbsp;</td>
    </tr>

    <tr>
      <th scope="row"><div align="center">Nombre de USUARIO</div></th>
      <td><input type="text" name="login" id="login" /></td>
    </tr>
    <tr>
      <th scope="row"><div align="center">Clave</div></th>
      <td><input type="password" name="clave1" id="clave1" /></td>
    </tr>
    <tr>
      <th scope="row"><div align="center">Repetir Clave</div></th>
      <td><input type="password" name="clave2" id="clave2" /></td>
    </tr>
    <tr>
      <th scope="row"><div align="center">Tipo</div></th>
      <td><select name="tipo" id="tipo">
      		<option value="1">Administrador</option>
            <option value="2" selected="selected">Trabajador</option>
            <option value="3">Usuario</option>      
      </select>      </td>
    </tr>
    <tr>
      <th scope="row"><div align="center">Habilitado</div></th>
      <td><input name="habilitado" type="checkbox" id="habilitado" checked="checked" /></td>
    </tr>
  </table>
  <table width="366" align="center" >
<tr>
        <td colspan="2"><div align="center">
            <input name="btncancelar" type="button" class="boton" id="button16" value="Cancelar" />
        </div></td>
        <td><div align="center">
            <input name="btnguardar" type="button" class="boton" id="button13" value="Guardar" onclick="validar()" />
        </div></td>
        <td><div align="center">
            <input name="btnnuevo" type="button" class="boton" id="button10" value="Nuevo" />
        </div></td>
        <td><input name="btnsalir" type="button" class="boton" id="button17" value="Salir" /></td>
      </tr>
    </table>
</form>

   </body>
</html>