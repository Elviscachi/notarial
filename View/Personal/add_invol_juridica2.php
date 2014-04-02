<?php
session_start();
if (isset($_SESSION['personal'])) {
    require_once '../../Model/cone.php';
    $link = new ConexionClass();
    $link->Conectado();

    $nombre_favor = $_REQUEST['nombre_favor'];
    $codigo_otorgante = $_REQUEST['codigo_otorgante'];
    $cod_otor_juri = $_REQUEST['cod_otor_juri'];
    

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
                function enviar_datos(){
                    var per_juridica = document.getElementById("per_juridica").value;
            
                    if( per_juridica == ""){
                        alert("No ha Escrito nada en el Cuadro");
                        document.getElementById("per_juridica").focus();
                        return false;
                    }
                    if(confirm("Estas Seguro de Agregar esta Persona Juridica?")){
                        involucrados.submit();
                        return true;
                    }
                    else
                    {
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

            <form action="../../Model/invol_juridica_save2.php" method="post" enctype="multipart/form-data" name="involucrados" id="involucrados">
                <div align="center">
                    <table width="574" border="1" cellpadding="1" cellspacing="4" bgcolor="#CC6600">
                        <caption>Nuevo Favorecido</caption>
                        <tr>
                            <td colspan="3" bgcolor="#3C5E83"><div align="left"><img src="../imagenes/Pers_Juridica.jpg" width="400" height="32" alt="hh" /></div></td>
                        </tr>
                        <tr>
                            <td colspan="3"><textarea name="per_juridica" id="per_juridica" cols="80" rows="4" style="text-transform:uppercase"><?php echo $nombre_favor ?></textarea></td>
                        </tr>
                        <tr>
                            <td width="180"><div align="center">
                                    <input name="guardar" type="button" class="boton" id="guardar" value="Guardar Informaci&oacute;n" onclick="enviar_datos();"/>
                                </div></td>
                            <td width="183"><div align="center">
                                    <input type="hidden" name="cod_otor_juri" id="cod_otor_juri" value="<?php echo $cod_otor_juri; ?>" />
                                    <input type="hidden" name="codigo_otorgante" id="codigo_otorgante" value="<?php echo $codigo_otorgante; ?>" />
                                    <input name="button2" type="button" class="boton" id="button2" value="Regresar" onclick="javascript:history.back(-1);" />
                                </div></td>
                            <td width="181"><input name="salir" type="button" class="boton" id="salir" value="Cancelar / Salir" onclick=    "javascript:location.href='./favorecidos.php'"/></td>
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