<?php






require 'base.php';

$REQ = $bdd->prepare("SELECT * FROM ressources");
$REQ->execute();
$result = $REQ->fetchall() ;
$result_js = json_encode($result);
echo $result_js ;