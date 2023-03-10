<?php


require 'base.php';



$output = '';
if(isset($_POST["query"]))
{
 $search =  htmlspecialchars($_POST["query"]);
 $query = "
  SELECT * FROM articles 
  WHERE title_Art LIKE '%".$search."%'
  OR type_Art LIKE '%".$search."%' 
 ";
}
else
{
 $query = "
  SELECT * FROM articles ORDER BY id
 ";
}
$result = $bdd->prepare($query); 
$result->execute();

if($result->rowCount() > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table-bordered table-dark">
    <tr>
     <th> Titre </th>
     <th> Type </th>
     <th> Description </th>
     <th> Number </th>
     <th>vister</th>
    </tr>
 ';
 while($row = $result->fetch())
 { 
  $output .= '
   <tr>
    <td>'.$row["title_Art"].'</td>
    <td>'.$row["type_Art"].'</td>
    <td>'.$row["description_Art"].'</td>
    <td>'.$row["Number_Art"].'</td>
    <td><button type="submit" class="btn btn-danger" onclick="function1()"> <a class="fas fa-eye" style="color:white;" href="#" ></a> </button></td>
   </tr>
  ';
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}


