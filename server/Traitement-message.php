<?php


require 'base.php';


    $msg = $_POST['msg'];
    $user = $_POST['user']

    if (!empty($user) && !empty($msg)) 
    {
        echo "<br><div class=\"alert alert-success alert-dismissible fade show\" style='transition:0.5s' role=\"alert\">
        <strong>Msg check !</strong> <a href=\"#\" onhover=\"this.style.color='green'\">plus de détaille</a>
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\" style=\"outline:none;\">
           <span aria-hidden=\"true\">&times;</span>
        </button>
        </div>";
    }
    else
    {
        echo "<br><div class=\"alert alert-danger alert-dismissible fade show\" style='transition:0.5s' role=\"alert\">
        Désoler sa ne pass pas!! <strong> (ce compte exist déja) </strong> 
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\" style=\"outline:none;\">
          <span aria-hidden=\"true\">&times;</span>
        </button>
        </div>";         
    }










?>