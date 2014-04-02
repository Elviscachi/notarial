<?php
session_start();
if (isset($_SESSION['personal'])) {
    require_once '../../Model/cone.php';
    $link = new ConexionClass();
    $link->conectarse();

    $cod_otor = $_REQUEST['cod_otor'];
    $nombre = $_REQUEST['nombre'];
//  Datos del Favorecido
    $nombre_fav = $_REQUEST['nombre_fav'];
    $paterno = $_REQUEST['paterno'];
    $materno = $_REQUEST['materno'];


    $query = "SELECT cod_sct FROM escriotor1 WHERE cod_inv = $cod_otor";
    $result = mysql_query($query);
    $num = mysql_num_rows($result);
    if ($num > 0) {
        ?>

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
                <link rel="stylesheet" type="text/css" href="../../css/busqueda.css"/>
                <link rel="stylesheet" href="../../css/normalize.css">
                <title>Busqueda</title>
            </head>
            <body>
                <p>BUSQUEDA POR OTORGANTE <?php echo "Existe(n): " . $num . " Favorecidos"; ?></p>

                <form action="" name="busqueda_favoredico" method="post">
                    <table width="1107" border="0">
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>Nombre</td>
                            <td>Paterno</td>
                            <td>Materno</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="581">Otorgante: <?php echo $nombre; ?></td>
                            <td width="74">Favorecido:</td>
                            <td width="121"><input name="nombre_fav" type="text" id="nombre_fav" size="20" /></td>
                            <td width="121"><input type="text" size="20" name="paterno" /></td>
                            <td width="120"><input name="materno" type="text" size="20" /></td>
                            <td width="58"><input type="submit" name="Submit" value="Buscar" /></td>
                        </tr>
                    </table>
                </form>
                <table width="1071" border="0">
                    <tr>
                        <td width="53" class="error">Escritura</td>
                        <td width="580" class="error">Favorecido</td>
                        <td width="37" class="error">Fecha</td>
                        <td width="27" class="error">Bien</td>
                        <td width="133" class="error">Otros</td>
                        <td width="82" class="error">&nbsp;</td>
                        <td width="113" class="error">&nbsp;</td>
                    </tr>
                    <?php
                    while ($sct = mysql_fetch_array($result)) {
                        $sct1 = array("escritura" => $sct[0]);
                        $fav1 = 'SELECT cod_inv, CONCAT(nom_inv," ",pat_inv," ",mat_inv), otros FROM involucrados1 WHERE cod_inv = (SELECT cod_inv FROM escrifavor1 WHERE cod_sct =' . $sct1["escritura"] . ')';
                        $res1 = mysql_query($fav1);
                        @$fat = mysql_fetch_array($res1);

                        //     DATOS ADICIONALES DE LA ESCRITURA
                        $fav1 = 'SELECT Raz_inv, otros_juri FROM involjuridicas1 WHERE cod_inv = (SELECT cod_inv_juri FROM escrifavor1 WHERE cod_sct =' . $sct1["escritura"] . ')';
                        $res1 = mysql_query($fav1);
                        @$fat1 = mysql_fetch_array($res1);
                        ?>
                        <tr>
                            <td bgcolor="#FFFFFF"><?php echo $sct1["escritura"]; ?></td>
                            <td bgcolor="#FFFFFF"><input type="hidden" name="cod_favor" size="6" id="cod_favor" value="<?php echo $fat[0]; ?>" /><?php echo $fat[1]; ?></td>
                            <td bgcolor="#FFFFFF" class="Estilo1"><?php echo "fecha"; ?></td>
                            <td bgcolor="#FFFFFF" class="Estilo1">&nbsp;</td>
                            <td bgcolor="#FFFFFF" class="Estilo1"><?php echo $fat[2]; ?></td>
                            <td bgcolor="#FFFFFF" class="Estilo1"><a href="buscar_sct.php?cod_otor=<?php echo $cod_otor; ?>&cod_sct=<?php echo $sct1["escritura"]; ?>&cod_favor=<?php echo $fat[0]; ?>">Ver Detalles</a></td>
                            <td bgcolor="#FFFFFF" class="Estilo1"><a href="#">Cambiar</a></td>
                        </tr>
            <?php
        }
        ?>
                </table>
                <br />
                <table width="1071" border="0">
                    <tr>
                        <td width="53" class="error">Escritura</td>
                        <td width="580" class="error">Favorecido Juridico </td>
                        <td width="37" class="error">Fecha</td>
                        <td width="27" class="error">Bien</td>
                        <td width="133" class="error">Otros</td>
                        <td width="82" class="error">&nbsp;</td>
                        <td width="113" class="error">&nbsp;</td>
                    </tr>
        <?php
        while ($sct = mysql_fetch_array($result)) {
            $sct1 = array("escritura" => $sct[0]);
            $fav1 = 'SELECT cod_inv, CONCAT(nom_inv," ",pat_inv," ",mat_inv), otros FROM involucrados1 WHERE cod_inv = (SELECT cod_inv FROM escrifavor1 WHERE cod_sct =' . $sct1["escritura"] . ')';
            $res1 = mysql_query($fav1);
            @$fat = mysql_fetch_array($res1);

            //     DATOS ADICIONALES DE LA ESCRITURA
            $fav1 = 'SELECT cod_inv, Raz_inv, otros_juri FROM involjuridicas1 WHERE cod_inv = (SELECT cod_inv_juri FROM escrifavor1 WHERE cod_sct =' . $sct1["escritura"] . ')';
            $res1 = mysql_query($fav1);
            @$fat1 = mysql_fetch_array($res1);
            ?>
                        <tr>
                            <td bgcolor="#FFFFFF"><?php echo $sct1["escritura"]; ?></td>
                            <td bgcolor="#FFFFFF"><input type="hidden" name="cod_favor2" size="6" id="cod_favor2" value="<?php echo $fat1[0]; ?>" />
                        <?php echo $fat1[0]; ?></td>
                            <td bgcolor="#FFFFFF" class="Estilo1"><?php echo "fecha"; ?></td>
                            <td bgcolor="#FFFFFF" class="Estilo1">&nbsp;</td>
                            <td bgcolor="#FFFFFF" class="Estilo1"></td>
                            <td bgcolor="#FFFFFF" class="Estilo1"><a href="buscar_sct.php?cod_otor=<?php echo $cod_otor; ?>&amp;cod_sct=<?php echo $sct1["escritura"]; ?>&amp;cod_favor=<?php echo $fat[0]; ?>">Ver Detalles</a></td>
                            <td bgcolor="#FFFFFF" class="Estilo1"><a href="#">Cambiar</a></td>
                        </tr>
            <?php
        }
        ?>
                </table>
                <p>
                    <?php
                } else {
                    echo "No Existe Ninguna Escritura que mostrar.  Vuelva Atras";
                }
                ?>
            </p>
        </body>
    </html>
             <?php
} else {
    header("Location: ../../index.php");
}
?>