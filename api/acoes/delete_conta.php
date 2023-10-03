<?php
require_once '../../config/conn.php';

header("Content-type: application/json");

//Deletar conta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $sql = "DELETE FROM tbl_conta_pagar WHERE id_conta_pagar = :idContaPagar";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":idContaPagar", $_POST["idContaPagar"]);

        $stmt->execute();

        $rowCount = $stmt->rowCount();
        if ($rowCount > 0) {
            $response = array("status" => 1, "message" => "Conta deletada com sucesso!");
        } else {
            $response = array("status" => 0, "message" => "Erro ao deletar conta!");
        }
    } catch (PDOException $e) {
        $response = array("status" => 0, "message" => "Erro no banco de dados: " . $e->getMessage());
    }
} else {
    $response = array("status" => 0, "message" => "Ocorreu um erro.");
}

echo json_encode($response);
