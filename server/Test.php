<?php

function EditT($txt)
{
    $txtE= strtok($txt ,';');
    while ($txtE !== false)
    {
        echo "<p> $txtE </p>";
        $txtE = strtok(";");
    }
    return true;
}



require 'base.php';

$REQ = $bdd->prepare("SELECT * FROM Description_S");
$REQ->execute();
$result = $REQ->fetchall() ;
$result_js = json_encode($result);
echo $result_js ;



/*foreach ($result as $key => $value) {

    echo "<p>".$result[$key]['Ram']."</p>";
    echo("<p>".$result[$key]['Processeur']."</p>");
    EditT("<p>".$result[$key]['Memoire']."</p>") ;
    EditT( "<p>".$result[$key]['Batterie']."</p>");
    EditT("<p>".$result[$key]['Resolution']."</p>") ;
    EditT("<p>".$result[$key]['Selfie']."</p>");
    EditT("<p>".$result[$key]['Camera']."</p>") ;
    echo("<p>".$result[$key]['Ecran']."</p>") ;
    echo("<p>".$result[$key]['Autre_D']."</p>") ;
}*/


/*$token = strtok($string, ".");
 
while ($token !== false)
{
    echo "$token<br>";
    $token = strtok(" ");
}*/

