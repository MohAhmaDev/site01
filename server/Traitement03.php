<?php


require 'base.php';




$req = $bdd->prepare("SELECT * FROM msg_table");
$req->execute();
$result = $req->fetchall() ;
$result_js = json_encode($result);
echo $result_js ;



?>