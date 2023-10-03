<?php
require_once '../../config/conn.php';

header("Content-type: application/json");

//Editar conta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        //transformar valor em float
        $valor = str_replace('.', '', $_POST["valor"]);
        $valor = str_replace(',', '.', $valor);
        $valor = floatval($valor);

        $sql = "UPDATE tbl_conta_pagar SET valor = :valor, data_pagar = :dataPagar WHERE id_conta_pagar = :idContaPagar";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":idContaPagar", $_POST["contaId"]);
        $stmt->bindParam(":valor", $valor);
        $stmt->bindParam(":dataPagar", $_POST["dataPagar"]);

        $stmt->execute();

        $response = array("status" => 1, "message" => "Conta editada com sucesso!");
    } catch (PDOException $e) {
        $response = array("status" => 0, "message" => "Erro no banco de dados: " . $e->getMessage());
    }
} else {
    $response = array("status" => 0, "message" => "Ocorreu um erro.");
}

echo json_encode($response);
