<?php 

require '../config.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'get') {

    $sql = $pdo->query("SELECT * FROM notes");

    if ($sql->rowCount() > 0) {
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $item) {

            $array['result'][] = [
                'id' => $item['id'],
                'title' => $item['title']
            ];

        }

        http_response_code(200);
    }

} else {
    http_response_code(405);
    $array['error'] = 'Método não permitido (apenas GET)';
}
 
require '../return.php';
