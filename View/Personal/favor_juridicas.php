<?php
session_start();
if (isset($_SESSION['personal'])) {
    require_once '../../Model/cone.php';
    $link = new ConexionClass();
    $link->Conectado();

    @$cod_sct = $_SESSION['codigo_escritura'];
    @$otorperjuridica = $_REQUEST['otorperjuridica'];
    @$codigo_otorgante = $_REQUEST['codigo_otorgante'];
    @$cod_otor_juri = $_REQUEST['cod_otor_juri'];
    //echo $cod_otor_juri;

    $codigo_usuario = $_SESSION['personal'];
    $cons1 = "SELECT CONCAT(nom_usu,' ',pat_usu,' ',mat_usu) AS Trabajor FROM usuarios WHERE cod_usu = $codigo_usuario";
    $query = mysql_query($cons1);
    @$dato1 = mysql_fetch_array($query);
    ?>
    <!DOCTYPE HTML>
    <!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="es"> <![endif]-->
    <!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="es"> <![endif]-->
    <!--[if IE 8]>    <html class="no-js lt-ie9" lang="es"> <![endif]-->
    <!--[if gt IE 8]><!-->
    <html class="no-js" lang="es">
        <!--<![endif]-->
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
            <meta name="HandheldFriendly" content="True">
            <meta name="MobileOptimized" content="320">
            <title>Sistema de Ingreso-Archivo Regional de Puno</title>
            <meta name="description" content="Escritura Publica">
            <meta name="viewport" content="width = device-width, initial-scale=1, maximum-scale=1"/>
            <link rel="stylesheet" href="../../css/estilo_fav.css">
            <link rel="stylesheet" href="../../css/normalize.css">
            <!-- <meta name="apple-mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style" content="black"> -->
            <!-- <script>(function(){var a;if(navigator.platform==="iPad"){a=window.orientation!==90||window.orientation===-90?"img/startup-tablet-landscape.png":"img/startup-tablet-portrait.png"}else{a=window.devicePixelRatio===2?"img/startup-retina.png":"img/startup.png"}document.write('<link rel="apple-touch-startup-image" href="'+a+'"/>')})()</script> -->
            <!-- <script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script> -->
            <meta http-equiv="cleartype" content="on">
            <script src="js/libs/modernizr-2.5.3.min.js"></script>
            <script src="js/libs/modernizr-2.0.6.min.js"></script>
            <script language="javascript" type="text/javascript">
                function enviar_datos(){
                        var cod_otor = document.getElementById("cod_otor_juri").value;
                        alert('Dato Agregado Correctamente');
                        location.href = "./ingreso.php?favor="+cod_otor+"";
                        window.close(); 
            }
            function sin_favor(){
                var codotor = document.getElementById("cod_otor_juri").value;
                var chek = document.getElementById("nulo").checked;
                if (chek == true){
                    location.href = "./ingreso_juridicas.php?cod_otor_juri="+codotor+"&codigo_favorecido=0";
                    return true;
                }
                else{
                    return false;
                }
            }
        </script>
        </head>
        <body>
            <!--[if gte IE 9]>
                <style type="text/css">
                    .gradient {
                        filter: none;
                    }
                </style>
            <![endif]-->
            <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
            <section id="contenedor">
                <header>
                    <label>Usuario en el Sistema: <?php echo $dato1[0]; ?></label>
                        
                    <label><a href="../Admin1/report_personal.php?trab=<?php echo @$codigo_usuario; ?>&fecha_ini=<?php echo @$fecha_ini; ?>">Ver mis ingreso del Dia</a></label>
                    <label><a href="javascript:history.back(-1)">Volver Atrás</a></label>
                    <label><a href="../../Controler/session_close.php">Salir del Sistema</a></label>
                </header>
                <br />

            <form action="" method="get" enctype="multipart/form-data" name="involucrados" id="involucrados">
                <input type="hidden" name="cod_otor_juri" id="cod_otor_juri" value="<?php echo $cod_otor_juri; ?>" />
                <p align="center">
                    <input type="hidden" name="cod_sct" id="cod_sct" value="<?php echo $cod_sct; ?>" />
                </p>
                <div align="center">

                    <table width="698" border="1" cellpadding="1" cellspacing="4">
                        <tr>
                            <td colspan="5" bgcolor="#3C5E83"><div align="left"><img src="../imagenes/Pers_Natural.jpg" width="400" height="32" alt=""/></div></td>
                        </tr>
                        <tr>
                            <th><div align="center">Nombre(s)</div></th>
                            <th><div align="center">Apellidos Paterno</div></th>
                            <th><div align="center">Apellido Materno</div></th>
                            <th>&nbsp;</th>
                            <th><div align="center">
                                    <input name="button" type="button" class="boton" id="button" value="Regresar" onclick="javascript:history.back(-1);" />
                                </div></th>
                        </tr>
                        <tr>
                            <td><input type="text" name="nombres" id="nombres" value="<?php echo @$nombres; ?>" /></td>
                            <td><input type="text" name="paterno" id="paterno" value="<?php echo @$paterno; ?>" /></td>
                            <td><input type="text" name="materno" id="materno" value="<?php echo @$materno; ?>" /></td>
                            <td><input type="submit" class="boton" name="btnbuscar" id="btnbuscar" value="Buscar" />
                                <?php
                                if (isset($_GET['btnbuscar'])) {
                                    $nexo1 = "%";
                                    $nomb = trim($_GET['nombres']);
                                    $datos1 = explode(" ", $nomb);
                                    $nombres = trim(implode($nexo1, $datos1));
                                    //$nombres = $_GET['nombres'];
                                    $paterno = trim($_GET['paterno']);
                                    $materno = trim($_GET['materno']);
                                    if ($nombres == "" and $paterno == "" and $materno == "") {
                                        $error = "No hay Registros que mostrar";
                                    } else {
                                        $query4 = "SELECT Cod_inv, Pat_inv, Mat_inv, Nom_inv, otros AS Nombre FROM involucrados1 ";
                                        $query4 .= " WHERE Nom_inv LIKE '$nombres%' AND Pat_inv LIKE '$paterno%' AND Mat_inv LIKE '$materno%' ORDER BY Pat_inv LIMIT 0,50";
                                        $result4 = mysql_query($query4);
                                        $num4 = mysql_num_rows($result4);

                                        if ($num4 == 0) {
                                            $error = "El Otorgante que Busca, no se encuentra en la Base de Datos";
                                        }
                                    }
                                }
                                ?></td>
                            <td><input type="button" class="boton" name="btnNuevo1" id="btnNuevo1" value="Nuevo Otorgante" onclick="javascript:location.href='./add_involucrado2.php?cod_otor_juri=<?php echo @$cod_otor_juri; ?>&codigo_otorgante=<?php echo @$codigo_otorgante; ?>&nombres=<?php echo @$nomb; ?>&paterno=<?php echo @$paterno; ?>&materno=<?php echo @$materno; ?>'" /></td>
                        </tr>
                        <tr>
                            <td colspan="3">otros:</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
    <?php echo @$error; ?>
                    <table width="763" border="1" cellpadding="1" cellspacing="4" bgcolor="#006699">
                    <?php
                    while (@$fila4 = mysql_fetch_array($result4)) {
                        ?>
                            <tr>
                                <td width="193" bgcolor="#D5E4FD"><input type="hidden" name="cod_otor" id="cod_otor" value="<?php echo $fila4[0]; ?>" readonly="readonly" />
                            <?php echo $fila4[3]; ?></td>
                                <td width="149" bgcolor="#D5E4FD"><?php echo $fila4[1]; ?></td>
                                <td width="152" bgcolor="#D5E4FD"><?php echo $fila4[2]; ?></td>
                                <td width="97" bgcolor="#FDFECB">
                                    <a href="ingreso.php?cod_otor_juri=<?php echo $cod_otor_juri; ?>&codigo_otorgante=<?php echo $codigo_otorgante ?>&codigo_favorecido=<?php echo $fila4[0]; ?>">SELECCIONAR</a></td>
                            </tr>

        <?php
    }
    ?>
                    </table>
                </div>
                <div align="center">
                    <table width="788" border="1" cellpadding="1" cellspacing="4">
                        <tr>
                            <td colspan="5" bgcolor="#3C5E84"><div align="left"><img src="../imagenes/Pers_Juridica.jpg" width="400" height="32" alt="" /></div></td>
                        </tr>
                        <tr>
                            <td width="461"><input type="text" name="otorperjuridica" id="paterno2" value="<?php echo $otorperjuridica; ?>" size="60" /></td>
                            <td width="228"><input type="submit" class="boton" name="btnbuscarpj" id="btnbuscarpj" value="Buscar" />
                                <input type="button" class="boton" name="btnNuevo2" id="btnNuevo2" value="Nuevo Otorgante" onclick="javascript:location.href='./add_invol_juridica2.php?cod_otor_juri=<?php echo $cod_otor_juri; ?>&codigo_otorgante=<?php echo $codigo_otorgante; ?>&nombre_favor=<?php echo $otorperjuridica; ?>'"/>
    <?php
    if (isset($_GET["btnbuscarpj"])) {
        $nexo1 = "%";
        $otorperjuridica = $_REQUEST['otorperjuridica'];
        $datos1 = explode(" ", $otorperjuridica);
        $union1 = implode($nexo1, $datos1);

        if ($otorperjuridica == "") {
            $error = "No hay Registros que mostrar";
        } else {
            $query2 = "SELECT Cod_inv, Raz_inv FROM involjuridicas1 WHERE Raz_inv LIKE '%$union1%' LIMIT 0,60";
            $result2 = mysql_query($query2);
            $num2 = mysql_num_rows($result2);

            if ($num2 == 0) {
                $error = "El Otorgante que Busca, no se encuentra en la Base de Datos";
            }
        }
    }
    ?>
                            </td>
                        </tr>
                                <?php
                                while (@$fila2 = mysql_fetch_array($result2)) {
                                    ?>
                            <tr>
                                <td bgcolor="#D5E4FD"><input type="hidden" name="cod_otor_juridica" id="cod_otor_juridica" value="<?php echo $fila2[0]; ?>" readonly="readonly" />
        <?php echo $fila2[1]; ?></td>
                                <td bgcolor="#FDFECB">
                                    <a href="ingreso_juridicas.php?cod_favor_juri=<?php echo $fila2[0]; ?>&cod_otor_juri=<?php echo $cod_otor_juri; ?>">SELECCIONAR</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
    <?php
    if (@$error == "") {
        
    } else {
        echo '<div class="error">' . $error;
        '</div>';
    }
    ?>
                    <p>
                        <input type="checkbox" name="nulo" id="nulo" value="nulo"/>
                        <span class="Estilo6">No Hay Favorecido </span> 
                        <input type="button" class="boton"name="save" id="save" value="Guardar Informaci&oacute;n" onclick="sin_favor();"/>
                        |<a href="<?php echo @$HTTP_REFERER; ?>">Regresar a la Pagina Anterior</a> </p>
                </div>
            </form>
        </body>
    </html>
<?php
} else {
    header("Location: ../../index.php");
}
?>