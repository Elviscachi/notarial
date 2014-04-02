<?php
session_start();
if (isset($_SESSION['personal'])) {
    require_once '../../Model/cone.php';
    $link = new ConexionClass();
    $link->Conectado();

    $otorjuri = $_REQUEST['otorjuri'];
    echo $otorjuri;

    $query = "SELECT cod_sct FROM escriotor1 WHERE cod_inv_ju = '$otorjuri' LIMIT 0,100";
    $result = mysql_query($query);
    $num = mysql_num_rows($result);
    if ($num > 0) {
        echo "Si Existe: " . $num;
        ?>

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
                <link rel="stylesheet" type="text/css" href="../../css/tablas.css"/>
                <link rel="stylesheet" href="../../css/normalize.css">
                <title>Busqueda</title>
            </head>
            <body>
                <p><img src="../imagenes/Banner2.jpg" width="600" height="100" /></p>
                Otorgante: <?php echo $cod_otor . " " . $nombre; ?>Personas Naturales<br />

                <table width="1071" border="1">
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
                        $fav1 = 'SELECT cod_inv, CONCAT(nom_inv," ",pat_inv," ",mat_inv), otros FROM involucrados1 WHERE cod_inv = (SELECT cod_inv FROM escrifavor1 WHERE cod_sct =' . $sct1["escritura"] . ')';
                        $res1 = mysql_query($fav1);
                        @$fat = mysql_fetch_array($res1);
                        ?>
                        <tr>
                            <td bgcolor="#FFFFFF"><?php echo $sct1["escritura"]; ?></td>
                            <td bgcolor="#FFFFFF"><input type="text" name="cod_favor" size="6" id="cod_favor" value="<?php echo $fat[0]; ?>" /><?php echo $fat[1]; ?></td>
                            <td bgcolor="#FFFFFF" class="Estilo1"><?php echo "fecha"; ?></td>
                            <td bgcolor="#FFFFFF" class="Estilo1">&nbsp;</td>
                            <td bgcolor="#FFFFFF" class="Estilo1"><?php echo $fat[2]; ?></td>
                            <td bgcolor="#FFFFFF" class="Estilo1"><a href="buscar_sct_juri.php?cod_otor=<?php echo $otorjuri; ?>&cod_sct=<?php echo $sct1["escritura"]; ?>&cod_favor=<?php echo $fat[0]; ?>">Ver Detalles</a></td>
                            <td bgcolor="#FFFFFF" class="Estilo1"><a href="#">Cambiar</a></td>
                        </tr>
                        <?php 
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