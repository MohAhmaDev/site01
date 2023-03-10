<?php


require 'base.php';


if (isset($_POST['name'],$_POST['description'],$_POST['id'])) 
{

	$name = htmlspecialchars($_POST['name']);
	$description = htmlspecialchars($_POST['description']);
	$id = $_POST['id'];
	

	$req = $bdd->prepare("SELECT * FROM smartphone WHERE nom_S=:name AND Description_S=:description");
	$req->execute(array(':name'=>$name ,':description'=>$description));
	if ($req->rowCount() == 0) 
	{
		$req2 = $bdd->prepare("UPDATE smartphone SET nom_S = :name, Description_S = :description WHERE id_S=:id") ;
		if($req2->execute(array(':name'=>$name, ':description'=>$description, ':id'=>$id)))
		{
			//$req2->execute(array($name,$description,$id));	
			echo "<p style=\"color:green\"> modification appliquer avec succée </p>";
		}	
		else
		{
			echo "<p style=\"color:red\"> Erreur lor de l'envoie [Id " . $id . " Name " . $name . " Description " . $description . " </p>";
		}
	}
	else
	{
		echo '<p style="color:red"> données nos modifier veillez recomencez </p>';
	}
}
if (isset($_POST['Id'])) 
{
	$Id = $_POST['Id'] ;
	$request = $bdd->prepare("UPDATE smartphone SET actif01 = 1 WHERE id_S = :id") ;
	if($request->execute(['id' => $Id]))
	{
		echo "<p style=\"color:green\"> modification appliquer avec succée </p>";
	}	
	else
	{
		echo "<p style=\"color:green\"> Erreur lor de l'envoye </p>";
	}	
}

?>