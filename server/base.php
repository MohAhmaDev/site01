<?php

try 
{
	$bdd = new PDO("mysql:host=localhost;dbname=itech","root","") ;	
} 
catch (PDOException $e)
{
	die("Erreur :".$e->getMessage()) ;
}

?>