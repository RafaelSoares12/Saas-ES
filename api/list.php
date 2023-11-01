<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include "../infra/connection.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $tarefas = array();

    $sql = "SELECT * FROM tasks";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tarefas[] = $row;
        }
    }

    echo json_encode($tarefas);
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método não permitido"]);
}

$conn->close();
?>
