<?php


if (isset($_POST['name'], $_POST['mdp'])) {

    require 'base.php';

    $name = htmlspecialchars($_POST['name']) ;
    $mdp = sha1($_POST['mdp']);
    if (!empty($_POST['name']) && !empty($_POST['mdp'])) {

        $Test_Login = $bdd->prepare('SELECT * FROM user_site WHERE name_Us = ? AND mdp_Us = ?');
        $Test_Login->execute(array($name,$mdp)) ;
        $conteur = $Test_Login->rowCount() ;


        if ($conteur != 0) {
            $result = "<br><div class=\"alert alert-success alert-dismissible fade show\" style='transition:0.5s' role=\"alert\">
            <strong>connection valider avec succer!</strong> <a href=\"#\" onhover=\"this.style.color='green'\">plus de détaille</a>
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\" style=\"outline:none;\">
               <span aria-hidden=\"true\">&times;</span>
            </button>
            </div>";
            $response = true;
            $traitement = ['reponse'=>$response, 'result'=>$result, 'mdp'=> $_POST['mdp']];

            echo json_encode($traitement);    
        }
        else
        {
            $result = "<br><div class=\"alert alert-danger alert-dismissible fade show\" style='transition:0.5s' role=\"alert\">
            connection non valider!! <strong> (erreur dans le mdp ou le user) </strong> 
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\" style=\"outline:none;\">
               <span aria-hidden=\"true\">&times;</span>
            </button>
            </div>";
            $response = false;
            $traitement = ['reponse'=>$response, 'result'=>$result, 'mdp'=> ""];

            echo json_encode($traitement);  
        }

    }
    else
    {
         $result = "<br><div class=\"alert alert-danger alert-dismissible fade show\" style='transition:0.5s' role=\"alert\">
         Les champs sont vide veillez les remplir </strong> 
         <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\" style=\"outline:none;\">
            <span aria-hidden=\"true\">&times;</span>
         </button>
         </div>"; 
         $response = false;
         $traitement = ['reponse'=>$response, 'result'=>$result, 'mdp'=> ""];

         echo json_encode($traitement);  
    }


}
