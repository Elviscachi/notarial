<?php
    /**
     * Creado por Edgar
     */
    include 'MySQL.php';
    class Buscar
    {
        	
        public function buscarsql($nombre,$paterno,$materno)
		{
			$con = new MySQL();
									
			if(!is_null($nombre)){
				if(!is_null($paterno))
				{
					if(!is_null($materno))
					{
						//echo "sql (nombre, paterno, materno)";
						
						$nexo = "%";
						$sinEspacios = trim($nombre);
						$nom_temp = explode(" ", $sinEspacios);
						$nom_corregido = implode($nexo, $nom_temp);
						$query="SELECT Cod_inv, Nom_inv, Pat_inv, Mat_inv FROM involucrados WHERE Nom_inv LIKE '%$nom_corregido%' AND Pat_inv LIKE '%$paterno%' AND Mat_inv LIKE '%$materno%' ORDER BY Pat_inv " ;
						//$rpta = mysql_query($query);
						return $query;		
					}else{
						//echo "sql (nombre, paterno)";
						
						$nexo = "%";
						$sinEspacios = trim($nombre);
						$nom_temp = explode(" ", $sinEspacios);
						$nom_corregido = implode($nexo, $nom_temp);
						$query="SELECT Cod_inv, Nom_inv, Pat_inv, Mat_inv FROM involucrados WHERE Nom_inv LIKE '%$nom_corregido%' AND Pat_inv LIKE '%$paterno%' ORDER BY Pat_inv " ;
						//$rpta = mysql_query($query);
						return $query;
					}
				}else{
					if(!is_null($materno))
					{
						//echo "sql (nombre, materno)";
						
						$nexo = "%";
						$sinEspacios = trim($nombre);
						$nom_temp = explode(" ", $sinEspacios);
						$nom_corregido = implode($nexo, $nom_temp);
						$query="SELECT Cod_inv, Nom_inv, Pat_inv, Mat_inv FROM involucrados WHERE Nom_inv LIKE '%$nom_corregido%' AND Mat_inv LIKE '%$materno%' ORDER BY Pat_inv " ;
						//$rpta = mysql_query($query);
						return $query;
					}else{
						//echo "sql (nombre)";
						$nexo = "%";
						$sinEspacios = trim($nombre);
						$nom_temp = explode(" ", $sinEspacios);
						$nom_corregido = implode($nexo, $nom_temp);
						$query="SELECT Cod_inv, Nom_inv, Pat_inv, Mat_inv FROM involucrados WHERE Nom_inv LIKE '%$nom_corregido%' ORDER BY Pat_inv " ;
						//$rpta = mysql_query($query);
						return $query;
					}
				}	
			//SI  ESYA VACIO				
			}else{
				if(!is_null($paterno))
				{
					if(!is_null($materno))
					{
						//echo "SQL (PATERNO, MATERNO)";
						
						$nexo = "%";
						$sinEspacios = trim($nombre);
						$nom_temp = explode(" ", $sinEspacios);
						$nom_corregido = implode($nexo, $nom_temp);
						$query="SELECT Cod_inv, Nom_inv, Pat_inv, Mat_inv FROM involucrados WHERE Pat_inv LIKE '%$paterno%' AND Mat_inv LIKE '%$materno%' ORDER BY Pat_inv " ;
						//$rpta = mysql_query($query);
						return $query;
					}else{
						//echo "SQL (PATERNO)";
						
						$nexo = "%";
						$sinEspacios = trim($nombre);
						$nom_temp = explode(" ", $sinEspacios);
						$nom_corregido = implode($nexo, $nom_temp);
						$query="SELECT Cod_inv, Nom_inv, Pat_inv, Mat_inv FROM involucrados WHERE Pat_inv LIKE '%$paterno%' ORDER BY Pat_inv " ;
						//$rpta = mysql_query($query);
						return $query;
					}
				}else{
					if(!is_null($materno))
					{
						//echo "SQL (MATERNO)";
						
						$nexo = "%";
						$sinEspacios = trim($nombre);
						$nom_temp = explode(" ", $sinEspacios);
						$nom_corregido = implode($nexo, $nom_temp);
						$query="SELECT Cod_inv, Nom_inv, Pat_inv, Mat_inv FROM involucrados WHERE Mat_inv LIKE '%$materno%' ORDER BY Pat_inv " ;
						//$rpta = mysql_query($query);
						return $query;
					}else{
						echo "Error, No ha ingresado ningun Nombre o Apellido";
					}
				}
			}	
			
		}
      
    }
?>