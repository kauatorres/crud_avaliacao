<?php
require_once '../../config/conn.php';

header("Content-type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        //transformar valor em float
        $valor = str_replace('.', '', $_POST["valor"]);
        $valor = str_replace(',', '.', $valor);
        $valor = floatval($valor);

        $sql = "INSERT INTO tbl_conta_pagar (id_empresa, data_pagar, pago, valor) VALUES (:empresaId, :dataPagar, :pago, :valor)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":empresaId", $_POST["empresaId"]);
        $stmt->bindParam(":dataPagar", $_POST["dataPagar"]);
        $stmt->bindValue(":pago", 0);
        $stmt->bindParam(":valor", $valor);

        $stmt->execute();

        $rowCount = $stmt->rowCount();
        if ($rowCount > 0) {
            $response = array("status" => 1, "message" => "Conta cadastrada com sucesso!");
        } else {
            $response = array("status" => 0, "message" => "Erro ao cadastrar conta!");
        }
    } catch (PDOException $e) {
        $response = array("status" => 0, "message" => "Erro no banco de dados: " . $e->getMessage());
    }
} else {
    $response = array("status" => 0, "message" => "Dados incompletos");
}

echo json_encode($response);
