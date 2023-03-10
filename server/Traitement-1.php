<?php



require 'base.php';




$req = $bdd->prepare("SELECT * FROM `articles` WHERE `type_Art` = 'Gaming'");
$req->execute();
$result = $req->fetchall() ;
$result_js = json_encode($result);
echo $result_js ;