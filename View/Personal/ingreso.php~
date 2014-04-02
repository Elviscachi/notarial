<?php
session_start();
if (isset($_SESSION['personal'])) {
    require_once '../../Model/cone.php';
    $link = new ConexionClass();
    $link->Conectado();

    @$cod_otor = $_REQUEST['codigo_otorgante'];
    @$cod_favor = $_REQUEST['codigo_favorecido'];
    @$cod_otor_juri = $_REQUEST['cod_otor_juri'];
    @$cod_favor_juri = $_REQUEST['cod_favor_juri'];

    if ($cod_otor == "") {
        $cod_otor = 0;
    }
    if ($cod_favor == "") {
        $cod_favor = 0;
    }
    if ($cod_otor_juri == "") {
        $cod_otor_juri = 0;
    }
    if ($cod_favor_juri == "") {
        $cod_favor_juri = 0;
    }

    $codigo_usuario = $_SESSION['personal'];
    $cons1 = "SELECT CONCAT(nom_usu,' ',pat_usu,' ',mat_usu) AS Trabajador FROM usuarios WHERE cod_usu = $codigo_usuario";
    $personal=$link->fetch_array($link->consulta($cons1));
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
            <link rel="stylesheet" href="../../css/estilo.css">
            <link rel="stylesheet" href="../../css/normalize.css">
            <!-- <meta name="apple-mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style" content="black"> -->
            <!-- <script>(function(){var a;if(navigator.platform==="iPad"){a=window.orientation!==90||window.orientation===-90?"img/startup-tablet-landscape.png":"img/startup-tablet-portrait.png"}else{a=window.devicePixelRatio===2?"img/startup-retina.png":"img/startup.png"}document.write('<link rel="apple-touch-startup-image" href="'+a+'"/>')})()</script> -->
            <!-- <script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script> -->
            <meta http-equiv="cleartype" content="on">
            <script src="js/libs/modernizr-2.5.3.min.js"></script>
            <script src="js/libs/modernizr-2.0.6.min.js"></script>
            <script language="javascript" type="text/javascript">
                function mostrar(){
                    var chkvalue = document.getElementById("chkotro").checked;
                    var subserie = document.getElementById("subserie");
                    var obj = document.getElementById("otro");

                    if (chkvalue == true){
                        if(obj.style.display=="none"){
                            obj.style.display="";
                            subserie.style.display="none";
                        }
                        else{
                            obj.style.display="none";
                            subserie.style.display="";
                        }
                    }
                    else{
                        obj.style.display="none";
                        return true;
                    }
                }
           
                function validar(){
                    var num_sct = document.getElementById("nescritura").value;
                    var protocolo = document.getElementById("protocolo").value;
                    var num_fol = document.getElementById("nfolios").value;
                    var tot_fol = document.getElementById("tfolios").value;
                    var subserie = document.getElementById("subserie").value;
                    var distritos = document.getElementById("distritos").value;

                    var dia = document.getElementById("dia").value;
                    var mes = document.getElementById("mes").value;
                    var year = document.getElementById("year").value;
                    var codigo_otorgantes = document.getElementById("codigo_otorgantes").value;
                    var codigo_favorecidos = document.getElementById("codigo_favorecidos").value;

                    if(protocolo ==""){
                        alert("NO HA INGRESADO EL PROTOCOLO DE LA ESCRITURA");
                        document.getElementById("protocolo").focus();
                        return false;
                    }
                    else if(!(isNaN(protocolo))){
        
                    }else{
                        alert("Ingrese un Numero en el Protocolo");
                        document.getElementById("protocolo").value="";
                        document.getElementById("protocolo").focus();
                        return false;
                    }
        
                    if(num_fol == ""){
                        alert("NO HA INGRESADO EL FOLIO DE LA ESCRITURA");
                        document.getElementById("nfolios").focus();
                        return false;
                    }
                    if (num_sct == ""){
                        alert("NO HA INGRESADO EL NUMERO DE LA ESCRITURA");
                        document.getElementById("nescritura").focus();
                        //document.getElementById("nescritura").style.color="#006699";
                        return false;
                    }
                    else if(!(isNaN(num_sct))){

                    }else{
                        alert("Ingrese un Numero en el Numero de Escritura");
                        document.getElementById("nescritura").value="";
                        document.getElementById("nescritura").focus();
                        return false;
                    }
        
        
                    if(subserie== 0){
                        alert("NO HA SELECCIONADO UNA SUBSERIE");
                        document.getElementById("subserie").focus();
                        return false;
                    }
                    if(distritos == 0){
                        alert("NO HA SELECCIONADO EL DISTRITO");
                        document.getElementById("distritos").focus();
                        return false;
                    }

                    if (dia == "")
                    { alert("Por favor ingresa DIA DE NACIMIENTO ");
                        document.getElementById("dia").focus();
                        return false;
                    }
                    else if(!(isNaN(dia)))
                    {
                        if (document.getElementById("dia").value>=0 && document.getElementById("dia").value<=31)
                        {
                        }
                        else
                        {
                            alert("Debe Ingresar un Numero entre 1 y 31");
                            document.getElementById("dia").value = "";
                            document.getElementById("dia").focus();
                            return 0;
                        }
                    }
                    else
                    {
                        alert("No puede Poner Letras en el Dia de Nacimiento");
                        document.getElementById("dia").value = "";
                        document.getElementById("dia").focus();
                        return 0;
                    }

                    if (mes == 0){
                        alert("Por favor SELECCIONA UN MES DE NACIMIENTO");
                        document.getElementById("mes").focus();
                        return false;
                    }
                    if(year == ""){
                        alert("INGRESE EL A&Ntilde;O");
                        document.getElementById("year").focus();
                        return false;
                    }else if(!(isNaN(year))){
                        var fecha = new Date();
                        var year_now = fecha.getYear();
                        var f = year_now + 1900;
                        if (year > f){
                            alert("La fecha Introducida ES MAYOR al a&ntilde;o actual");
                            document.getElementById("year").value = "";
                            document.getElementById("year").focus();
                            return false;
                        }
                        else
                        {
                        }
                    }
                    else
                    {
                        alert("No Escriba Letras en el A&ntilde;o");
                        document.getElementById("year").value = "";
                        document.getElementById("year").focus();
                        return false;
                    }
          
          
          
                    if(tot_fol ==""){
                        alert("NO HA INGRESADO EL TOTAL DE FOLIOS");
                        document.getElementById("tfolios").focus();
                        return false;
                    }
                    if(codigo_otorgantes == ""){
                        alert("Error: No hay un Otorgante Seleccionado \nConsulte con el Administrador del Sistema para Solucionar el Problema.");
                        document.getElementById("codigo_otorgantes").focus();
                        return false;
                    }
                    if(codigo_favorecidos == ""){
                        alert("Error: No hay un Favorecido Seleccionado \nConsulte con el Administrador del Sistema para Solucionar el Problema.");
                        document.getElementById("codigo_favorecidos").focus();
                        return false;
                    }
                    insert.submit();
                    return true;
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
                    <label>Usuario en el Sistema: <?php echo @$personal["Trabajador"]; ?></label>
                    <label><a href="../Admin1/report_personal.php?trab=<?php echo @$codigo_usuario ?>&fecha_ini=<?php echo @$fecha_ini ?>">Ver mis ingreso del Dia</a></label>
                    <label><a href="javascript:history.back(-1)">Volver Atrás</a></label>
                    <label><a href="../../Controler/session_close.php">Salir del Sistema</a></label>
                </header>
                <br />
            
            <form id="insert" name="insert" method="get" action="../../Model/ingreso_save.php">
                <table width="846" border="0" align="center" cellpadding="1" cellspacing="4" background="../imagenes/fondo.jpg">
                    <tr>
                        <th width="183" scope="row">Protocolo <span class="asterisco"> *</span></th>
                        <td width="239">
                            <input name="protocolo" type="number" id="protocolo" size="5" value="<?php echo @$protocolo; ?>" placeholder="Protocolo" required/>
                        </td>
                        <th width="88"></th>
                        <td width="90"></td>
                        <td width="145"><input name="codigo_otorgantes" type="hidden" id="codigo_otorgantes" value="<?php echo $cod_otor; ?>" size="4" /></td>
                    </tr>
                    <tr>
                        <th scope="row">Folio <span class="asterisco"> *</span></th>
                        <td><input name="nfolios" type="text" id="nfolios" size="10" value="<?php echo @$nfolios; ?>" placeholder="Num Folio"/>
                            <span class="mensaje">Utilice "Vta" para Vuelta.</span>
                        </td>
                        <th></th>
                        <td></td>
                        <td><input name="codigo_favorecidos" type="hidden" id="codigo_favorecidos" value="<?php echo $cod_favor; ?>" size="4" /></td>
                    </tr>
                    <tr>
                        <th scope="row">Num. Escritura <span class="asterisco"> *</span></th>
                        <td><span class="Estilo1">
                                <input name="nescritura" type="text" id="nescritura" size="5" value="<?php echo @$nescritura; ?>" placeholder="Escritura"/>
                            </span></td>
                        <th><div align="left">Distrito</div></th>
                        <td><span class="Estilo1">
                                <select name="distritos" id="distritos">
                                    <option value="210101" selected="selected">PUNO</option>
                                    <?php
                                    $q_dst = "SELECT cod_dst, des_dst FROM distritos WHERE cod_pvi > 210000 and cod_pvi < 211301 ORDER BY des_dst";
                                    $result_dst = mysql_query($q_dst);
                                    while ($row_dst = mysql_fetch_array($result_dst)) {
                                        ?>
                                        <option value="<?php echo $row_dst[0]; ?>">
                                            <?php echo $row_dst[1]; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </span></td>
                        <td><span class="Estilo1">
                                <input name="cod_otor_juri" type="hidden"  id="cod_otor_juri" value="<?php echo $cod_otor_juri; ?>" size="4" />
                            </span></td>
                    </tr>
                    <tr>
                        <th scope="row">Sub Serie <span class="asterisco"> *</span></th>
                        <td colspan="4">
                            <select name="subserie" id="subserie" style="display:;">
                                <option value="46">COMPRA VENTA</option>
                                <?php
                                $query = "SELECT cod_sub, des_sub FROM subseries ORDER BY des_sub";
                                $result = mysql_query($query);
                                while ($row = mysql_fetch_array($result)) {
                                    ?>
                                    <option value="<?php echo $row[0]; ?>">
                                        <?php echo $row[1]; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                            <input type="checkbox" name="chkotro" id="chkotro" onclick="mostrar(chkotro);" />
                            Otro, Especifique:
                            <input type="text" name="otro" id="otro" style="display:none;" size="100"/></td>
                    </tr>
                    <tr>
                        <th scope="row">Fecha  <span class="asterisco"> *</span></th>
                        <td> <input name="dia" type="number" min="1" max="31" id="dia" size="2" maxlength="2" value="<?php echo @$dia; ?>" placeholder="Dia"/>

                            <select name="mes" id="mes">
                                <option value="0">--</option>
                                <option value="01">Ene</option>
                                <option value="02">Feb</option>
                                <option value="03">Mar</option>
                                <option value="04">Abr</option>
                                <option value="05">May</option>
                                <option value="06">Jun</option>
                                <option value="07">Jul</option>
                                <option value="08">Ago</option>
                                <option value="09">Set</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dic</option>        
                            </select>
                            <input name="year" type="number" id="year" min="1800" max="3000" size="4" maxlength="4" value="<?php echo @$year; ?>" placeholder="Año" />      </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><span class="Estilo1">
                                <input name="cod_favor_juri" type="hidden"  id="cod_favor_juri" value="<?php echo $cod_favor_juri; ?>" size="4" />
                            </span></td>
                    </tr>
                    <tr>
                        <th scope="row">Total Folios  <span class="asterisco"> *</span></th>
                        <td><span>
                                <input name="tfolios" type="number" id="tfolios" min="1" max ="30" size="5" value="<?php echo @$tfolios; ?>" placeholder="Cantidad"/>
                            </span></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <th scope="row">NOTARIO  <span class="asterisco"> *</span></th>
                        <td colspan="4"><select name="notario" id="notario">
                                <option value="114" selected="selected">JULIO EDGAR LEZANO ZUÑIGA</option>
                                <?php
                                $q_not = "SELECT cod_not, CONCAT(nom_not, ' ',pat_not,' ' , mat_not) AS NOTARIO FROM notarios ORDER BY pat_not";
                                $result_not = mysql_query($q_not);
                                while ($not4 = mysql_fetch_array($result_not)) {
                                    ?>
                                    <option value="<?php echo $not4[0]; ?>"><?php echo $not4[1]; ?></option>
                                    <?php
                                }
                                ?>
                            </select></td>
                    </tr>
                    <tr>
                        <th scope="row">Ubicaci&oacute;n / Nombre del Bien</th>
                        <td colspan="4"><input name="nbien" type="text" id="nbien" size="100" value="<?php echo @$nbien; ?>" placeholder="Direccion, Numero, Ubicación"/></td>
                    </tr>
                    <tr>
                        <th scope="row">Observaciones </th>
                        <td colspan="4"><textarea name="obs" id="obs" cols="70" rows="3"></textarea></td>
                    </tr>
                </table>

                <table width="477" height="50" align="center" >
                    <tr height="20">
                        <td><div align="center">
                                <button name="button" type="button" id="button" onclick="validar()">Guardar</button>
                            </div>
                        </td>
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
