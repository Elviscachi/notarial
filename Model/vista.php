<?php
require_once '../Model/cone.php';
$link = new conexionclass();
$link->Conectado();

   $last_sct =mysql_query("SELECT cod_sct FROM escrituras1 order by cod_sct desc");
    $num_sct1=mysql_fetch_array($last_sct);
    $dato1 = array("numsub"=>$num_sct1[0]);
    $cod_sct3 = $dato1["numsub"];
    $_SESSION['sct']= $cod_sct3;
    echo "Session ".$_SESSION['sct'];
    echo "<br>";
    $codigo_r = $_SESSION['sct'];
    echo $codigo_r;
?>
