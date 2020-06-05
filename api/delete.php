<?php
require_once("../config.php");

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'delete') {

    parse_str(file_get_contents('php://input'), $input);

    $id = (!empty($input['id'])) ? $input['id'] : null; # php < 7.4

    $id = $input['id'] ?? null; # php >= 7.4
   
    $id = filter_var($id);
   
    if ($id) {

        $sql = $pdo->prepare("DELETE FROM notes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        
    } else {
        $array['error'] = "ID não enviados";
    }
} else {
    $array['error'] = 'Metodo não permitido (apenas DELETE)';
}

require_once('../return.php');
