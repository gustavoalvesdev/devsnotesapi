<?php 

require '../config.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'post') {

    $title = filter_input(INPUT_POST, 'title');
    $body = filter_input(INPUT_POST, 'body');

    if ($title && $body) {

        $sql = $pdo->prepare("INSERT INTO notes (title, body) VALUES (:title, :body)");
        $sql->bindValue(':title', $title);
        $sql->bindValue(':body', $body);
        $sql->execute();

        http_response_code(201);

        $id = $pdo->lastInsertId();

        $array['result'] = [
            'id' => $id,
            'title' => $title,
            'body' => $body
        ];

    } else {

        http_response_code(400);
        $array['error'] = 'Campos obrigatórios (title, body) não enviados!';

    }
    
} else {
    http_response_code(405);
    $array['error'] = 'Método não permitido (apenas POST)';
}
 
require '../return.php';
