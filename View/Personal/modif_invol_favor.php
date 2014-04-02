<?php
session_start();
if (isset($_SESSION['personal'])) {
    require_once '../../Model/cone.php';
    $link = new ConexionClass();
    $link->Conectado();

    $CodOtor = $_REQUEST['CodOtor'];
    $CodFavor = $_REQUEST['CodFavor'];

    $nombres = $_REQUEST['nombres'];
    $paterno = $_REQUEST['paterno'];
    $materno = $_REQUEST['materno'];

    $codigo_usuario = $_SESSION['personal'];
    $cons1 = "SELECT CONCAT(nom_usu,' ',pat_usu,' ',mat_usu) AS Trabajor FROM usuarios WHERE cod_usu = $codigo_usuario";
    $query = mysql_query($cons1);
    @$dato1 = mysql_fetch_array($query);

    $CodOtor = $_REQUEST['CodOtor'];
    $q1 = "select * from involucrados1 where cod_inv = $CodFavor";
    $r = mysql_query($q1);
    $d = mysql_fetch_array($r);
    $DatPer = array("codigo" => $d[0], "paterno" => $d[1], "materno" => $d[2], "nombre" => $d[3], "otros" => $d[4]);
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            <link rel="stylesheet" type="text/css" href="../../css/style_ingreso.css"></link>
            <link rel="stylesheet" href="../../css/normalize.css">
            <title>Favorecido - ARP</title>
            <style type="text/css">
                <!--
                .Estilo6 {color: #FFFFFF}
                .Estilo5 {color: #CCCCCC}
                -->
            </style>
        </head>
        <body>
            <table width="1055" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="600" rowspan="2"><img src="../imagenes/Banner2.jpg" alt="banner" width="600" height="100" /></td>
                    <td height="55">Usuario en el Sistema:<span class="Estilo5">
                            <?php echo $dato1[0]; ?>
                        </span></td>
                </tr>
                <tr>
                    <td> Regresar - Volver atras | <a href="../../Controler/session_close.php">Salir del Sistema</a></td>
                </tr>
            </table>
            <form action="../../Model/involucrado_update_f.php" method="post" enctype="multipart/form-data" name="involucrados" id="involucrados">
                <p align="center" class="error">MODIFICAR : FAVORECIDO</p>
                <div align="center">
                    <table width="574" border="1" cellpadding="1" cellspacing="4" bgcolor="#2F3962">
                        <tr>
                            <td colspan="3" bgcolor="#3C5E83"><div align="left"><img src="../imagenes/Pers_Natural.jpg" width="400" height="32" alt="Persona Natural" /></div></td>
                        </tr>
                        <tr>
                            <td width="180"><div align="center"><span class="Estilo6">Nombre(s)</span></div></td>
                            <td><div align="center"><span class="Estilo6">Apellidos Paterno</span></div></td>
                            <td width="181"><div align="center"><span class="Estilo6">Apellido Materno</span></div></td>
                        </tr>
                        <tr><input type="hidden" name="codigo_otor" id="codigo_otor" value="<?php echo $CodOtor ?>" />
                            <input type="hidden" name="codigo_favor" id="codigo_favor" value="<?php echo $DatPer["codigo"]; ?>" />
                            <td><input type="text" name="nombres" id="nombres" value="<?php echo $DatPer["nombre"]; ?>" /></td>
                            <td><input type="text" name="paterno" id="paterno" value="<?php echo $DatPer["paterno"]; ?>" /></td>
                            <td><input type="text" name="materno" id="materno" value="<?php echo $DatPer["materno"]; ?>" /></td>
                        </tr>
                        <tr>
                            <td class="Estilo6"><div align="center">Otros</div></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="3"><textarea name="otros" id="otros" cols="80" rows="5" style="text-transform:uppercase"><?php echo $DatPer["otros"]; ?></textarea></td>
                        </tr>
                        <tr>
                            <td><div align="center">
                                    <input name="guardar" type="submit" class="boton" id="guardar" value="Guardar Informaci&oacute;n" onclick="enviar_datos();"/>
                                </div></td>
                            <td><div align="center">
                                    <input name="button2" type="button" class="boton" id="button2" value="Regresar" onclick="javascript:history.back(-1);" />
                                </div></td>
                            <td><input name="salir" type="button" class="boton" id="salir" value="Cancelar / Salir" onclick="javascript:location.href='./otorgantes.php'" /></td>
                        </tr>
                    </table>
                </div>
            </form>
        </body>
    </html>
<?php
} else {
    header("Location: ../../index.php");
}
?>