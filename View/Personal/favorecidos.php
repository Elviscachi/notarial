<?php
session_start();
if (isset($_SESSION['personal'])) {
    require_once '../../Model/cone.php';
    $link = new ConexionClass();
    $link->Conectado();

    @$codigo_otorgante = $_REQUEST['codigo_otorgante'];
    @$cod_otor_juri = $_REQUEST['cod_otor_juri'];

    $codigo_usuario = $_SESSION['personal'];
    $sql_personal = "SELECT CONCAT(nom_usu,' ',pat_usu,' ',mat_usu) AS Trabajador FROM usuarios WHERE cod_usu = $codigo_usuario";
    @$personal = $link->fetch_array($link->consulta($sql_personal));
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
                function sin_favor(){
                    var codotor = document.getElementById("codigo_otorgante").value;
                    var chek = document.getElementById("nulo").checked;
                    if (chek == true){
                        location.href = "./ingreso.php?codigo_otorgante="+codotor+"&codigo_favorecido=0";
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
                    <label>Usuario en el Sistema: <?php echo $personal["Trabajador"]; ?></label>
                        
                    <label><a href="../Admin1/report_personal.php?trab=<?php echo @$codigo_usuario; ?>&fecha_ini=<?php echo @$fecha_ini; ?>">Ver mis ingreso del Dia</a></label>
                    <label><a href="javascript:history.back(-1)">Volver Atrás</a></label>
                    <label><a href="../../Controler/session_close.php">Salir del Sistema</a></label>
                </header>
                <br />


                <form method="get" enctype="multipart/form-data" name="involucrados" id="involucrados">
                    <input type="hidden" name="codigo_otorgante" id="codigo_otorgante" value="<?php echo $codigo_otorgante; ?>" />
                    <input type="hidden" name="cod_otor_juri" id="cod_otor_juri" value="<?php echo $cod_otor_juri; ?>" />

                    <table>
                        <thead>
                            <tr bgcolor="#3C5E84"><td><h2>Favorecido</h2></td></tr>
                            <tr>
                                <th>Nombre(s)</th>
                                <th>Apellidos Paterno</th>
                                <th>Apellido Materno</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name="nombres" id="nombres" placeholder="Nombre(s)" value="<?php echo @$nombres; ?>" /></td>
                                <td><input type="text" name="paterno" id="paterno" placeholder="Apellido Paterno" value="<?php echo @$paterno; ?>" /></td>
                                <td><input type="text" name="materno" id="materno" placeholder="Apelldio Materno" value="<?php echo @$materno; ?>" /></td>
                                <td><button type="submit" name="btnbuscar">Buscar</button>
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
                                            $query4 .= " WHERE Nom_inv LIKE '$nombres%' AND Pat_inv LIKE '$paterno%' AND Mat_inv LIKE '$materno%' ORDER BY Pat_inv LIMIT 0,60";
                                            $result4 = mysql_query($query4);
                                            $num4 = mysql_num_rows($result4);

                                            if ($num4 == 0) {
                                                $error = "El Favorecido que Busca, no se encuentra en la Base de Datos";
                                            }
                                        }
                                    }
                                    ?>                </td>
                                <td><button type="button" name="btnNuevo1" id="btnNuevo1" onclick="javascript:location.href='./add_involucrado2.php?codigo_otorgante=<?php echo @$codigo_otorgante; ?>&cod_otor_juri=<?php echo @$cod_otor_juri; ?>&nombres=<?php echo @$nomb; ?>&paterno=<?php echo @$paterno; ?>&materno=<?php echo @$materno; ?>'" />Nuevo</button></td>
                            </tr>
                        </tbody>
                    </table>
                </form>

                <?php echo @$error; ?>
                <table border="1" width="1000">
                    <tbody>
                        <?php
                        while (@$fila4 = mysql_fetch_array($result4)) {
                            ?>
                            <tr>
                                <td width="193"><input type="hidden" name="cod_favor" id="cod_favor" value="<?php echo $fila4[0]; ?>" />
                                    <?php echo $fila4[3]; ?></td>
                                <td width="149"><?php echo $fila4[1]; ?></td>
                                <td width="152"><?php echo $fila4[2]; ?></td>
                                <td width="97"><a href="ingreso.php?cod_otor_juri=<?php echo $cod_otor_juri; ?>&codigo_otorgante=<?php echo $codigo_otorgante; ?>&codigo_favorecido=<?php echo $fila4[0]; ?>">SELECCIONAR</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

                <br/>
                <form name="form3" method="get">
                    <table>
                        <tr bgcolor="#3C5E84">
                            <td><h2>Favorecido Juridico</h2></td>
                        </tr>
                        <tr>
                            <td width="615">
                                <input type="hidden" name="codigo_otorgante" id="codigo_otorgante" value="<?php echo $codigo_otorgante; ?>" />
                                <input type="text" name="otorperjuridica" id="paterno2" value="<?php echo @$otorperjuridica; ?>" size="100" />
                            </td>
                            <td width="279">
                                <button type="submit" name="btnbuscarpj" id="btnbuscarpj">Buscar</button>
                                <button type="button" name="btnNuevo2" id="btnNuevo2" onclick="javascript:location.href='./add_invol_juridica2.php?cod_otor_juri=<?php echo @$cod_otor_juri; ?>&codigo_otorgante=<?php echo @$codigo_otorgante; ?>&nombre_favor=<?php echo @$otorperjuridica; ?>'">Nuevo</button>
                                <?php
                                if (isset($_REQUEST["btnbuscarpj"])) {
                                    $nexo1 = "%";
                                    $otorperjuridica = trim($_GET['otorperjuridica']);
                                    $datos1 = explode(" ", $otorperjuridica);
                                    $union1 = implode($nexo1, $datos1);

                                    if ($otorperjuridica == "") {
                                        $error = "No hay Registros que mostrar";
                                    } else {
                                        $query2 = "SELECT Cod_inv, Raz_inv FROM involjuridicas1 WHERE Raz_inv LIKE '%$union1%' LIMIT 0,60";
                                        $result2 = mysql_query($query2);
                                        $num2 = mysql_num_rows($result2);

                                        if ($num2 == 0) {
                                            $error = "El Favorecido que Busca, no se encuentra en la Base de Datos";
                                        }
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        while (@$fila2 = mysql_fetch_array($result2)) {
                            ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="hidden" name="cod_otor_juridica" id="cod_otor_juridica" value="<?php echo $fila2[0]; ?>" />
                                        <?php echo $fila2[1]; ?></td>
                                    <td><a href="ingreso.php?cod_otor_juri=<?php echo $cod_otor_juri; ?>&codigo_otorgante=<?php echo $codigo_otorgante; ?>&cod_favor_juri=<?php echo $fila2[0]; ?>">SELECCIONAR</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </form>
                <?php
                if (@$error == "") {
                    
                } else {
                    echo $error;
                }
                ?>
                <p>
                    <label><span>Si en la Escritura No Existe un Favorecido, Active la Casilla : </span><input type="checkbox" name="nulo" id="nulo" value="nulo"/></label>
                    <br/> <span> Luego, Presione el Boton Guardar.</span>
                    <button type="button" name="save" id="save" onclick="sin_favor();">Guardar</button>
                </p>
        </body>
    </html>
    <?php
} else {
    header("Location: ../../index.php");
}
?>