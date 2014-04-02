<?php
session_start();
if (isset($_SESSION['busqueda'])) {
    require_once '../Model/conexion.class.php';
    $link = new conexionclass();
    $link->conectarse();

    $cod_favor1 = $_REQUEST['cod_favor1'];
    $nombre = $_REQUEST['nombre_favor'];

    $query = "SELECT cod_sct FROM escrifavor WHERE cod_inv = '$cod_favor1'";
    $result15 = mysql_query($query);
    $num = mysql_num_rows($result15);
    if ($num > 0) {
        ?>

        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UFT-8" />
                <link rel="stylesheet" type="text/css" href="css/busquedas2.css" />
                <title>Busqueda</title>

                <script language="javascript" type="text/javascript">
                    function muestra(cod_otor, cod_sct, cod_fav, cod_fav_ju){
                        location.href="buscarSct_x_Fecha.php?cod_otor="+cod_otor+"&cod_sct="+cod_sct+"&cod_favor="+cod_fav+"&cod_favor_ju="+cod_fav_ju+"";
                    }
                </script>
            </head>
            <body>

                <table width="1107" border="0">
                    <caption>Busqueda por Favorecido:<?php echo "Existe(n): " . $num . " Favorecidos"; ?></caption>
                    <tr>
                        <td><input type="button" name="regresar" value="Regresar" class="boton" onclick="javascript:history.back(-1);" /></td>
                        <td><input name="btnsalir" type="button" class="boton" id="btnsalir" onclick="javascript:location.href='index_old.php'" value="Salir" /></td>


                    </tr>
                    <tr>
                        <td width="581">Favorecido: <?php echo $nombre; ?></td>
                        <td></td>
                    </tr>
                </table>

                <table width="1337" border="0">
                    <thead>
                        <tr>
                            <th width="50" class="error">Num</th>
                            <th width="326" class="error">OTORGANTE(s)</th>
                            <th width="125" class="error">Fecha</th>
                            <th width="82" class="error">SubSerie</th>
                            <th width="306" class="error">Nombre del Bien </th>
                            <th width="138" class="error">Protocolo</th>
                            <th width="72" class="error">Escritura</th>
                            <th width="75" class="error">Folio</th>
                        </tr>
                    </thead>
                    <?php
                    $i = 1;
                    while (@$fila2 = mysql_fetch_array($result15)) {
                        $Escritura23 = $fila2[0];
                        $con_14 = "SELECT cod_sct, cod_inv FROM escriotor WHERE cod_sct = '$Escritura23'";
                        $q14 = mysql_query($con_14);
                        $a14 = mysql_fetch_array($q14);
                        $var0 = $a14["cod_sct"];
                        $var1 = $a14["cod_inv"];

                        $consulta123 = "SELECT cod_sct, cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol FROM escrituras WHERE cod_sct = '$a14[0]' LIMIT 0,250;";
                        $result = mysql_query($consulta123);
                        $fila = mysql_fetch_array($result);
                        $datosEscritura = array("cod_sct" => $fila[0], "notario" => $fila[1], "escritura" => $fila[2], "distrito" => $fila[3], "fecha" => $fila[4], "subserie" => $fila[5], "bien" => $fila[6], "cantFolios" => $fila[7], "protocolo" => $fila[8], "obs" => $fila[9], "numFolios" => $fila[10]);
                        $Escritura = $datosEscritura["cod_sct"];
                        ?>
                        <tbody>
                            <tr onClick="javascript:muestra('<?php echo $var1; ?>','<?php echo $Escritura; ?>','<?php echo $cod_favor1; ?>','<?php echo $var2; ?>');">
                                <td><?php echo $i; ?></td>
                                <td>
                                    <?php
                                    $q_fav = "SELECT Cod_inv, CONCAT(Nom_inv,' ',Pat_inv,' ',Mat_inv) as persona FROM involucrados WHERE cod_inv ='$var1';";
                                    $query2 = mysql_query($q_fav) or die(mysql_error() . " Error Buscado Favorecido");
                                    $r2 = mysql_fetch_array($query2);
                                    $num44 = mysql_num_rows($query2);
                                    echo $r2["persona"];
                                    if ($num44 == 0) {
                                        $q_rz = "SELECT Cod_inv, Raz_inv FROM involjuridicas WHERE cod_inv = '$var1';";
                                        $query8 = mysql_query($q_rz) or die(mysql_error() . " Error Buscado Favorecido");
                                        $r8 = mysql_fetch_array($query8);
                                        echo $r8["Raz_inv"];
                                    }
                                    ?>
                                </td>
                                <td><?php echo $datosEscritura["fecha"]; ?></td>
                                <td><?php
                        $sub = $datosEscritura["subserie"];
                        /* @var $datosEscritura <type> */
                        $Sis = "SELECT des_sub FROM subseries WHERE cod_sub = '$sub'";
                        $Sis1 = mysql_query($Sis);
                        $Sto = mysql_fetch_array($Sis1);
                        echo $Sto[0];
                        ?></td>
                                <td><?php echo $datosEscritura["bien"]; ?></td>
                                <td><?php echo $datosEscritura["protocolo"]; ?></td>
                                <td><?php echo $datosEscritura["escritura"]; ?>    </td>
                                <td class="Estilo1"><?php echo $datosEscritura["numFolios"]; ?></td>
                            </tr>
                            <?php
                            $i = $i + 1;
                        }
                        ?>
                    </tbody>
                </table>

                <?php
            } else {
                echo "<script language='javascript' type='text/javascript'>alert('No hay Escrituras que Mostrar.  Volver Atras');history.back(-1);</script>";
            }
            }
            ?>
    </body>
</html>