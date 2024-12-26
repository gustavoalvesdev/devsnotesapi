<?php 

require '../config.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'get') {

    $id = filter_input(INPUT_GET, 'id');

    if ($id) {

        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {

            $data = $sql->fetch(PDO::FETCH_ASSOC);

            $array['result'] = [
                'id' => $data['id'],
                'title' => $data['title'],
                'body' => $data['body']
            ];

            http_response_code(200);

        } else {
            http_response_code(404);
            $array['error'] = 'ID inexistente';
        }

    } else {
        http_response_code(400);
        $array['error'] = 'ID não enviado';
    }
    
} else {
    http_response_code(405);
    $array['error'] = 'Método não permitido (apenas GET)';
}
 
require '../return.php';
