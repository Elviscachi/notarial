<?php
session_start();
if (isset($_SESSION['personal'])) {
    require_once '../../Model/cone.php';
    $link = new ConexionClass();
    $link->conectarse();

//$otor_juri =$_POST['otorjuri'];
    ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            <link rel="stylesheet" type="text/css" href="../../css/style_ingreso.css" />
            <link rel="stylesheet" href="../../css/normalize.css">
            <title>Busqueda</title>

        </head>
        <body>
            <p><img src="../imagenes/Banner2.jpg" width="600" height="100" /></p>
            <form id="busqueda" name="busqueda" method="post" action="">
                <table width="766" height="47" border="0" cellpadding="0" cellspacing="1" background="Admin/Fondo.jpg" bgcolor="#990000">
                    <tr>
                        <td width="115" height="19" align="center"><h3>&nbsp;</h3></td>
                        <td width="162" align="center"><h3>Nombre(s)</h3></td>
                        <td width="154" align="center"><h3>Apellidos Paterno</h3></td>
                        <td width="167" align="center"><h3>Apellido Materno</h3></td>
                    </tr>
                    <tr>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td colspan="2" align="center"></td>
                    </tr>
                    <tr>
                        <td align="center" class="error">FAVORECIDO</td>
                        <td colspan="3" align="center"><input name="otor_juri" type="text" id="otor_juri" size="80" value="<?php echo $otor_juri; ?>" /></td>
                        <td width="162" align="center"><input type="submit" name="btnbuscar" value="Buscar" id="btnbuscar" /></td>
                    </tr>
                    <tr>
                        <td colspan="4" align="center"><div align="left"><span class="error">Otros</span>
                                <input type="text" name="otros" id="otros" value="" size="70"/>
                            </div></td>
                        <td align="center">&nbsp;</td>
                    </tr>
                </table>
            </form>
            <table width="916" border="1" bgcolor="#F0F0F0">
                <tr>
                    <td width="710" class="error">Otorgante Juridico </td>
                    <td width="111" class="error">Otros</td>
                    <td width="71" class="error">&nbsp;</td>
                </tr>
                <?php
                if (isset($_REQUEST["btnbuscar"])) {
                    $nexo1 = "%";
                    $otor_juri = trim($_REQUEST['otor_juri']);
                    $datos1 = explode(" ", $otor_juri);
                    $union1 = implode($nexo1, $datos1);

                    if ($otor_juri == "") {
                        $error = "Cuadros Vacios. No hay Registros que mostrar";
                    } else {
                        $error = "";
                        $query2 = "SELECT Cod_inv, Raz_inv FROM involjuridicas1 WHERE Raz_inv LIKE '%$union1%' LIMIT 0,60";
                        $result2 = mysql_query($query2);
                        $num2 = mysql_num_rows($result2);
                        while (@$Dat = mysql_fetch_array($result2)) {
                            $otor_juri = array("codigo" => $Dat[0], "Raz_inv" => $Dat[1], "otros" => $Dat[2]);
                            ?>
                            <tr>
                                <td bgcolor="#336699"><?php echo $Dat[1]; ?></td>
                                <td><?php echo $Dat[2]; ?></td>
                                <td bgcolor="#FFFFFF" class="Estilo1"><a href="buscar_otorjuri_detail.php?otorjuri=<?php echo $Dat[0]; ?>">Ver Detalles</a></td>
                            </tr>
                <?php
            }
            if ($num2 == 0) {
                $error = "El Otorgante que Busca, no se encuentra en la Base de Datos";
            }
        }
    }
    ?>
            </table>
        </body>
    </html>
           <?php
} else {
    header("Location: ../../index.php");
}
?>