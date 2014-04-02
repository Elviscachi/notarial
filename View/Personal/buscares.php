<?php
session_start();
if (isset($_SESSION['personal'])) {
    require_once '../../Model/cone.php';
    $link = new ConexionClass();
    $link->Conectado();

    $nombres = $_REQUEST['nombres'];
    $paterno = $_REQUEST['paterno'];
    $materno = $_REQUEST['materno'];
    if ($nombres == "" and $paterno == "" and $materno == "") {
        $error = "No hay Registros que mostrar";
    } else {
        $query = "SELECT cod_not, pat_not,mat_not, nom_not FROM notarios ";
        $query .= "WHERE nom_not LIKE '$nombres%' AND pat_not LIKE '$paterno%' AND mat_not LIKE '$materno%' ORDER BY pat_not";
        $result = mysql_query($query);
        $num = mysql_num_rows($result);

        if ($num == 0) {
            $error = "El notario que Busca no se encuentra en la Base de Datos";
        }
    }

    $codigo_usuario = $_SESSION['personal'];
    $cons1 = "SELECT CONCAT(nom_usu,' ',pat_usu,' ',mat_usu) AS Trabajor FROM usuarios WHERE cod_usu = $codigo_usuario";
    $query = mysql_query($cons1);
    @$dato1 = mysql_fetch_array($query);
    ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            <link rel="stylesheet" type="text/css" href="../../css/style_ingreso.css"/>
            <link rel="stylesheet" href="../../css/normalize.css">
            <title>Busqueda</title><script language="javascript" type="text/javascript">
                function pasar_datos(){
                    var paterno = document.getElementById("nom_not").value;
                    alert("Notario " + paterno);
                }
            </script>
            <style type="text/css">
                <!--
                .Estilo5 {color: #CCCCCC}
                -->
            </style>
        </head>
        <body >
            <table width="1055" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="600" rowspan="2"><img src="../imagenes/banner-superior-Bus.jpg" alt="banner" width="655" height="114" /></td>
                    <td height="55">Usuario en el Sistema:<span class="Estilo5">
    <?php echo $dato1[0]; ?>
                        </span></td>
                </tr>
                <tr>
                    <td> Regresar - Volver atras | <a href="../../Controler/session_close.php">Salir del Sistema</a></td>
                </tr>
            </table>
            <br />
            <form id="notarios" name="notarios" method="post" action="">
                <table width="346" height="179" border="1" align="center">
                    <tr>
                        <td width="95" align="center">Buscar por:</td>
                        <td width="158"><label>
                                <select name="select" id="select">
                                    <option>Notario</option>
                                    <option>N&ordm; Escritura</option>
                                    <option>Distrito</option>
                                    <option>Fecha Documento</option>
                                    <option>Nombre del Bien</option>
                                    <option>Cantidad de Folio</option>
                                    <option>Codigo Protocolo</option>
                                    <option>Observaciones</option>
                                    <option>Favorecido</option>
                                </select>
                            </label></td>
                        <td width="71"><input type="submit" class="boton"name="btnbuscar2" id="btnbuscar2" value="Buscar" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
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