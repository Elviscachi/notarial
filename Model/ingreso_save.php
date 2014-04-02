<?php
    session_start();
    require_once '../Model/cone.php';
    $link = new ConexionClass();
    $link->Conectado();

    //***********************************************
    //   Recojo de Variables y convertirlas a Session
    //***********************************************
    $last_sct =mysql_query("SELECT cod_sct FROM escrituras1 ORDER BY cod_sct DESC LIMIT 0,1;");
	$num_sct1=mysql_fetch_array($last_sct);
	$cod_sct =  $num_sct1[0] + 1;

	$c_otorgante = $_REQUEST['codigo_otorgantes'];
	$c_favorecido = $_REQUEST['codigo_favorecidos'];
	$cod_otor_juri = $_REQUEST['cod_otor_juri'];
	$cod_favor_juri = $_REQUEST['cod_favor_juri'];
    
//**********************************************************
//              INGRESANDO VALORESA A LA BASE DE DATOS  
//***********************************************************
    //$cod_sct = $_SESSION['codigo_escritura'];
    $num_sct = $_REQUEST['nescritura'];
    $cod_pro = $_REQUEST['protocolo'];
    $num_fol = $_REQUEST['nfolios'];
    $can_fol = $_REQUEST['tfolios'];
    $cod_sub = strtoupper($_REQUEST['subserie']);
    $cod_dst = $_REQUEST['distritos'];
    $nom_bie = strtoupper($_REQUEST['nbien']);
    //Fecha
    $dia = $_REQUEST['dia'];
    $mes = $_REQUEST['mes'];
    $year = $_REQUEST['year'];

    $fec_doc = $year."/".$mes."/".$dia;
    $cod_not = $_REQUEST['notario'];
    $obs_sct = strtoupper($_REQUEST['obs']);
    $cod_usu = $_SESSION['personal'];
    $otro = strtoupper($_REQUEST['otro']);
    //   Fecha Actual de la PC
    $hra_ing = date("Y-m-d H:i:s");        //  H:Hora      i: Minutos     s:Segundos

//*****************************************************************************
//           FIN DEL RECOJO DE VARIABLES
//******************************************************************************

// Si el Cuadro otra Subserie esta vacio entonces sigue la sigueinte funcion
if($otro == ""){
	//***********************************e**************************
	//****** Registra en TABLA : ESCRITURAS   *********************
	//*************************************************************
	$query = "INSERT INTO escrituras1 (cod_sct, cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol, cod_usu, hra_ing) VALUES ('$cod_sct', '$cod_not', '$num_sct', '$cod_dst', '$fec_doc', '$cod_sub', '$nom_bie', '$can_fol', '$cod_pro', '$obs_sct','$num_fol', '$cod_usu','$hra_ing');";
	$result = mysql_query($query) or die(mysql_error());

	//***********************************************************
	//****** Registra en TABLA: ESCRIOTOR   *********************
	//***********************************************************
	$query2 = "INSERT INTO escriotor1 (cod_sct,cod_inv,cod_per,cod_inv_ju) VALUES ('$cod_sct', '$c_otorgante', '$cod_usu', '$cod_otor_juri');";
	$result2 = mysql_query($query2) or die(mysql_error());
    //***********************************************************
	//****** Registra en TABLA: ESCRIFAVOR  *********************
	//***********************************************************
	$query3 = "INSERT INTO escrifavor1 (cod_sct,cod_inv,cod_per,cod_inv_ju) VALUES ('$cod_sct', '$c_favorecido', '$cod_usu','$cod_favor_juri');";
	$result3 = mysql_query($query3) or die(mysql_error());

	print "<meta http-equiv=Refresh content=\"0 ; url= ../View/Personal/index.php\">";
	echo "<script type='text/javascript'>alert('Dato Ingresado');</script>";
	
	 //               FIN DE LA FUNCION ANTERIOR

    }
else
   {
    //***************************************************************************
    //*** SI SE COLOCA OTRA SUB SERIE *******
    //***************************************************************************
    $subse_q = "INSERT INTO subseries (cod_sre, des_sub) VALUES ('46','$otro');";
    $query44 = mysql_query($subse_q) or die(mysql_error()."parte 1");

	//*************************************************************
	//            Registra en TABLA : ESCRITURAS 
	//*************************************************************

    $last_subserie =mysql_query("SELECT cod_sub FROM subseries ORDER BY cod_sub DESC LIMIT 0,1;");
    $num_sub=mysql_fetch_array($last_subserie);
    $n_sub = $num_sub[0]; //codigo de la ultima subserie ingresada

    
	$query4 = "INSERT INTO escrituras1 (cod_sct, cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol, cod_usu, hra_ing) VALUES ('$cod_sct', '$cod_not', '$num_sct', '$cod_dst', '$fec_doc', '$n_sub', '$nom_bie', '$can_fol', '$cod_pro', '$obs_sct','$num_fol', '$cod_usu','$hra_ing');";
	$result4 = mysql_query($query4) or die(mysql_error()."parte2");

	//***********************************************************
	//****** Registra en TABLA: ESCRIOTOR   *********************
	//***********************************************************

	$query5 = "INSERT INTO escriotor1 (cod_sct,cod_inv,cod_per,cod_inv_ju) VALUES ('$cod_sct', '$c_otorgante', '$cod_usu', '$cod_otor_juri');";
	$result5 = mysql_query($query5) or die (mysql_error()."parte3");
		//***********************************************************
		//****** Registra en TABLA: ESCRIFAVOR  *********************
		//***********************************************************

	$query7 = "INSERT INTO escrifavor1 (cod_sct,cod_inv,cod_per,cod_inv_ju) VALUES ('$cod_sct', '$c_favorecido', '$cod_usu','$cod_favor_juri');";
	$result7 = mysql_query($query7) or die(mysql_error()."parte4");
    
        header(" ../View/Personal/index.php");
	echo "<script type='text/javascript'>alert('Dato Ingresado');</script>";
	}
?>
