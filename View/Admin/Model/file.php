<?php
	$read = "coddes.dll";
	if(!$cod = fopen($read,'r')){
		echo "No podemos acceder";
	}
	else{
		while($caracter = fgets($cod))
                {
			$shell = explode(";", $caracter);
                        echo $shell[0];
                        echo $shell[1];
		}
	}
        fclose($cod);
?>
