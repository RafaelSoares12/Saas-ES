<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include "../infra/connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"));
    
    $titulo = $data->titulo;
    $descricao = $data->descricao;
    $data_limite = $data->data_limite;

    $stmt = $conn->prepare("INSERT INTO tasks (titulo, descricao, data_limite) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $titulo, $descricao, $data_limite);
    
    if ($stmt->execute()) {
        echo json_encode(["message" => "Tarefa criada com sucesso!"]);
    } else {
        echo json_encode(["error" => "Erro ao criar a tarefa"]);
    }
} else {
    http_response_code(405); // Método não permitido
    echo json_encode(["error" => "Método não permitido"]);
}

$conn->close();
?>
