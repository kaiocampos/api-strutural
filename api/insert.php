<?php
require_once("../config.php");

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'post') {

   $title = filter_input(INPUT_POST, 'title');
   $body = filter_input(INPUT_POST, 'body');

   if($title && $body){
       $sql = $pdo->prepare("INSERT INTO notes (title, body) VALUES (:title, :body)");
       $sql->bindValue(':title', $title);
       $sql->bindValue(':body', $body);
       $sql->execute();

       $id = $pdo->lastInsertId();

       $array['result'] = [
           'id' => $id,
           'title' => $title,
           'body' =>$body
       ];

   }else{
       $array['error'] = "Preencha os dados corretamente";
   }

   
}else{
    $array['error'] = 'Metodo não permitido (apenas POST)';
}

require_once('../return.php');