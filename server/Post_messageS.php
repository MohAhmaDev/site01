<?php

$db = new PDO('mysql:host=localhost;dbname=itech;charset=utf8', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);


$task = "list";

if(array_key_exists("task", $_GET)){
  $task = $_GET['task'];
}

if($task == "write"){
  postMessage();
} else {
  getMessages();
}


function getMessages(){

    global $db;

    $resultats = $db->prepare("SELECT * FROM message_S ORDER BY created_at DESC LIMIT 3");
    $resultats->execute();
    $messages = $resultats->fetchAll();
    echo json_encode($messages);    
}


function postMessage(){
  global $db;
  
  if(!array_key_exists('author', $_POST) || !array_key_exists('content', $_POST)){

    echo json_encode(["status" => "error", "message" => "One field or many have not been sent"]);
    return;

  }

  //$config = $_POST['config']AND `name_Us`=:author, "author" => $author
  $author = $_POST['author'];
  $content = $_POST['content'];
  $number = $_POST['number'];
  $bool = false;

	$req = $db->prepare("SELECT name_Us,email_Us FROM user_site WHERE `email_Us`=:config OR `mdp_Us`= SHA1(:config)");
	$req->execute([":config" => $author]);
  $results = $req->fetch();
	if ($req->rowCount() > 0) 
  {
    $bool = true;
  }
  if ($bool) {
    $query = $db->prepare('INSERT INTO message_S SET author = :author, content = :content, created_at = NOW(), com_S = :com');

    $query->execute([
      "author" => $results['name_Us'],
      "content" => $content,
      "com" => $number
    ]);


    echo "<br><div class=\"alert alert-success alert-dismissible fade show\" style='transition:0.5s' role=\"alert\">
    <strong>inscription valider avec succer!</strong> 
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\" style=\"outline:none;\">
       <span aria-hidden=\"true\">&times;</span>
    </button>
    </div>";  
  }
  else
  {
    echo "<br><div class=\"alert alert-danger alert-dismissible fade show\" style='transition:0.5s' role=\"alert\">
    Désolé message non registrer  <strong> veillez vous inscrir avant <a href=\"#\">ici<a> </strong> 
    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\" style=\"outline:none;\">
      <span aria-hidden=\"true\">&times;</span>
    </button>
    </div>";   
}

}

