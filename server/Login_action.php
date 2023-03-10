<?php


if (isset($_POST['name'], $_POST['email'], $_POST['mdp'])) 
{  
   


    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['mdp']) )
    {

      $name = htmlspecialchars($_POST['name']) ;
      $email = $_POST['email'];
      $mdp = sha1($_POST['mdp']);

      if(filter_var($email, FILTER_VALIDATE_EMAIL))
      {

         require 'base.php';
         $Test_Login = $bdd->prepare('SELECT * FROM user_site WHERE name_Us = ? OR email_Us = ? OR mdp_Us = ?');
         $Test_Login->execute(array($name,$email,$mdp)) ;
         $conteur = $Test_Login->rowCount() ;
         if ($conteur == 0) 
         {
            $Login = $bdd->prepare('INSERT INTO user_site(name_Us, email_Us, mdp_Us) VALUES(?, ?, ?)');
            if ($Login->execute([$name, $email, $mdp])) { 

               $result = "<br><div class=\"alert alert-success alert-dismissible fade show\" style='transition:0.5s' role=\"alert\">
               <strong>inscription valider avec succer!</strong> <a href=\"#\" onhover=\"this.style.color='green'\">plus de détaille</a>
               <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\" style=\"outline:none;\">
                  <span aria-hidden=\"true\">&times;</span>
               </button>
               </div>";
               $response = true;
               $traitement = ['reponse'=>$response, 'result'=>$result];

               echo json_encode($traitement);    
            }
         }
         else
         {
            $result = "<br><div class=\"alert alert-danger alert-dismissible fade show\" style='transition:0.5s' role=\"alert\">
            inscription non valider!! <strong> (ce compte exist déja) </strong> 
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\" style=\"outline:none;\">
               <span aria-hidden=\"true\">&times;</span>
            </button>
            </div>";
            $response = false;
            $traitement = ['reponse'=>$response, 'result'=>$result];

            echo json_encode($traitement);    
        }
      }
      else
      {
         $result = "<br><div class=\"alert alert-danger alert-dismissible fade show\" style='transition:0.5s' role=\"alert\">
         <strong> email non valide, Veillez saisir une adress email valide <strong> (notation xxx@kkk.jjj) </strong> 
         <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\" style=\"outline:none;\">
            <span aria-hidden=\"true\">&times;</span>
         </button>
         </div>";
         $response = false;
         $traitement = ['reponse'=>$response, 'result'=>$result];

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
         $traitement = ['reponse'=>$response, 'result'=>$result];

         echo json_encode($traitement);  
    }
}
