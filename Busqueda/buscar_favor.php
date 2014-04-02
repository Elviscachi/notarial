<?php
session_start();
if(isset($_SESSION['busqueda'])){
    require_once 'Model/conexion.class.php';
    require_once 'Model/buscarclass.php';
            
    $link = new conexionclass();
    $link->conectarse();
    $busqueda=new Buscar();
    /*Consulta de Datos en  la clase buscarclass*/
    $nombres=$_REQUEST['nombres'];
    $paterno=$_REQUEST['paterno'];
    $materno=$_REQUEST['materno'];

//inicializo el criterio y recibo cualquier cadena que se desee buscar
    

    if(!empty($nombres)){
	if(!empty ($paterno))
	{
            if(!empty($materno))
            {
		//echo "sql (nombre, paterno, materno)";
                  $query = $busqueda->buscarsql($nombres,$paterno,$materno);
                
            }else{
            	//echo "sql (nombre, paterno)";
                  $query = $busqueda->buscarsql($nombres,$paterno,null);
                
            }
         }else{
            if(!empty($materno))
		{
                    //echo "sql (nombre, materno)";
                    $query = $busqueda->buscarsql($nombres,null,$materno);
                   
            }else{
                    //echo "sql (nombre)";
                    $query = $busqueda->buscarsql($nombres,null,null);
                    
            }
        }	
    //SI  ESYA VACIO				
    }else{
        if(!empty($paterno))
	{
            if(!empty($materno))
            {
                //echo "SQL (PATERNO, MATERNO)";
		$query = $busqueda->buscarsql(null,$paterno,$materno);
                
            }else{
            	//echo "SQL (PATERNO)";
                $query = $busqueda->buscarsql(null,$paterno,null);
                
            }
	}else{
            if(!empty($materno))
            {
                //echo "SQL (MATERNO)";
		$query = $busqueda->buscarsql(null,null,$materno);
                
            }else{
		echo "Error, No ha ingresado ningun Nombre o Apellido";
            }
	}
    }
    
    $res=mysql_query($query);
    $numeroRegistros=@mysql_num_rows($res);
    if($numeroRegistros<=0)
    {
    /*echo "<div align='center'>";
    echo "No se encontraron resultados";
    echo "</div>";*/
    }else{
    //////////elementos para el orden
        
        //////////fin elementos de orden
        //////////calculo de elementos necesarios para paginacion
        //////////tama�o de la pagina
    $tamPag=20;
    //pagina actual si no esta definida y limites
    if(!isset($_GET["pagina"]))
    {
       $pagina=1;
       $inicio=1;
       $final=$tamPag;
    }else{
       $pagina = $_GET["pagina"];
    }
    //calculo del limite inferior
    $limitInf=($pagina-1)*$tamPag;

    //calculo del numero de paginas
    $numPags=ceil($numeroRegistros/$tamPag);
    if(!isset($pagina))
    {
       $pagina=1;
       $inicio=1;
       $final=$tamPag;
    }else{
       $seccionActual=intval(($pagina-1)/$tamPag);
       $inicio=($seccionActual*$tamPag)+1;

       if($pagina<$numPags)
       {
          $final=$inicio+$tamPag-1;
       }else{
          $final=$numPags;
       }

       if ($final>$numPags){
          $final=$numPags;
       }
    }

//////////fin de dicho calculo
//////////creacion de la consulta con limites
$sql=$query." LIMIT ".$limitInf.",".$tamPag;
$res=mysql_query($sql);

//////////fin consulta con limites

}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Busqueda de Otorgantes</title>
<link rel="stylesheet" type="text/css" href="css/busquedas.css"/>
<script src="jquery-1.6.4.js"></script>
<link rel="stylesheet" href="css/OrangeCSS.css" />

<script language="javascript" type="text/javascript">
    function muestra(codigo, nombre){
		location.href="buscar_favor_detail.php?cod_favor1="+ codigo +"&nombre_favor="+ nombre +"";
    }
    </script>
</head>

<body>
<div id="header"></div>
<div id="encabezado">
<h1>Documentos Notariales del Departamento de Puno.</h1>
<h2>Provincias de : Azangaro, Lampa, Carabaya - Macusani, Juliaca (Cuba Ovalle,Hildebrando Castillo, Selmo Carcausto), Puno (Julio Garnica Rosado)</h2>
</div>
<div id="datos">
<form name="otorgantes" method="post" action="">
  <table>
  	<caption>Buscar por el Favorecido (Comprador)<input type="button" class="boton" name="regresar" value="Salir" onclick="javascript:location.href='./buscar_index.php'" /></caption>
    <tr>
      <th width="190">Nombre o nombres</th>
      <th colspan="3">Apellido Paterno </th>
      <th width="198">Apellido Materno</th>
    </tr>
    <tr>
      <td><input name="nombres" type="text" id="nombres" size="30" value="<?php echo $nombres;?>"/></td>
      <td colspan="3"><input name="paterno" type="text" id="paterno" size="30" value="<?php echo $paterno;?>"/></td>
      <td><input name="materno" type="text" id="materno" size="30" value="<?php echo $materno;?>"/></td>
    </tr>
    <tr>
        <td><input type="button" name="btnOtros" id="btnOtros" value="Mas Opciones" class="boton" onclick='$("#otros").toggle(200);' /></td>
      <td colspan="3"><input type="submit" name="btnOtorgante" id="btnOtorgante" value="Buscar" class="boton" /></td>
      <td><input type="submit" name="btnLimpiar" id="btnLimpiar" value="Reiniciar" class="boton" /></td>
    </tr>
   </table>

  <div id="otros">
   <table class="otros_datos">
    <tr>
      <td>&nbsp;</td>
      <td >Día</td>
      <td >Mes</td>
      <td>Año</td>
      <td>Nombre del Bien</td>
    </tr>	
    <tr>
      <td>Busqueda por Fecha</td>
      <td><input name="dia" type="text" id="dia" size="2" maxlength="2"></td>
      <td><select name="mes" id="mes">
        <option value="0">[Seleccione]</option>
        <option value="01">Enero</option>
        <option value="02">Febrero</option>
        <option value="03">Marzo</option>
        <option value="04">Abril</option>
        <option value="05">Mayo</option>
        <option value="06">Junio</option>
        <option value="07">Julio</option>
        <option value="08">Agosto</option>
        <option value="09">Setiembre</option>
        <option value="10">Octubre</option>
        <option value="11">Noviembre</option>
        <option value="12">Diciembre</option>
      
      </select></td>
      <td><input name="anio" type="text" id="anio" size="4" maxlength="4"></td>
      <td><input type="text" name="bien" id="bien"></td>
    </tr>
  </table>
  </div>
   </form>
    
  <div id="cuerpo">
  <table>
      <caption><?php echo $error_descr;?></caption>
      <thead>
        <tr>
          <th width="50" scope="col">Num</th>
          <th width="233" scope="col">Nombres</th>
          <th width="233" scope="col">Apellido Paterno</th>
          <th width="233" scope="col">Apellido Materno</th>
          <th>opciones</th>
        </tr>
      </thead>

    <tbody>
      <?php
       while($registro=@mysql_fetch_array($res))
	{
      ?>
	<tr onClick="javascript:muestra('<?php echo $registro["Cod_inv"];?>','<?php echo $registro["Nom_inv"]." ".$registro["Pat_inv"]." ".$registro["Mat_inv"]; ?>');">
            <td width="47"><input type="hidden" name="cod_otor" id="cod_otor" value="<?php echo $registro["Cod_inv"]; ?>" /></td>
            <td><b><?php echo $registro["Nom_inv"]; ?></b></td>
            <td><b><?php echo $registro["Pat_inv"]; ?></b></td>
            <td><b><?php echo $registro["Mat_inv"]; ?></b></td>
            <td width="182">Ver Datalles</td>
        </tr>
       <?php
       }
       ?>
    </tbody>
      
      <tfoot>
       <tr>
           <td colspan="5">
        <?php
        if($pagina>1)
        {
        echo "<a class='' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina-1)."&orden=".$orden."&nombres=".$nombres."'>";
        echo "Anterior";
        echo "</a> ";
        }

        for($i=$inicio;$i<=$final;$i++)
        {
            if($i==$pagina)
            {
            echo "<b>".$i."</b>";
            }else{
            echo "<a class='' href='".$_SERVER["PHP_SELF"]."?pagina=".$i."&orden=".$orden."&nombres=".$nombres."&paterno=".$paterno."&materno=".$materno."'>";
            echo $i."</a> ";
            }
        }
        if($pagina<$numPags)
        {
            echo "<a class='' href='".$_SERVER["PHP_SELF"]."?pagina=".($pagina+1)."&orden=".$orden."&nombres=".$nombres."'>";
            echo "Siguiente</a>";
        }
        //////////fin de la paginacion
  
        ?>
        </td>
        </tr>
      </tfoot>
  </table>

  </div>
</div>
</body>
</html>
<?php
}
else
{
	header("Location: ../../index.php");
}
?>