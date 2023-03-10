<?php


require 'base.php';
if (isset($_POST['name'], $_POST['mdp'])) 
{
   if (!empty($_POST['name']) && !empty($_POST['mdp'])) 
    {
        $name = htmlspecialchars($_POST['name']) ;
        $mdp = $_POST['mdp'];

        $req = $bdd->prepare("SELECT * FROM `users` WHERE `pseudo`=? AND `password`=?");
        $req->execute(array($name,$mdp)) ;
        $conteur = $req->rowCount() ;
        if ($conteur != 0) 
        {
            echo "index.html";             
            //header("location:index.html");
        }
        else
        {
            echo "<br><div class=\"alert alert-danger alert-dismissible fade show\" style='transition:0.5s' role=\"alert\">
            cette utilisateur n'éxistent pas </strong> 
           <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\" style=\"outline:none;\">
              <span aria-hidden=\"true\">&times;</span>
           </button>
          </div>"; 
        }
    }
    else
    {
        echo "<br><div class=\"alert alert-danger alert-dismissible fade show\" style='transition:0.5s' role=\"alert\">
         Les champs sont vide veillez les remplir </strong> 
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\" style=\"outline:none;\">
           <span aria-hidden=\"true\">&times;</span>
        </button>
       </div>"; 
    }
    
    
}








?>