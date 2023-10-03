<?php
require_once '../../config/conn.php';

header("Content-type: application/json");

//Pagar conta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        //Verifica se a conta está paga
        $sql = "SELECT pago FROM tbl_conta_pagar WHERE id_conta_pagar = :contaId";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":contaId", $_POST["contaId"]);
        $stmt->execute();
        $row = $stmt->fetch();


        if ($row["pago"] == 1) {
            $response = array("status" => 0, "message" => "Conta já está paga!");
        } else {
            //Verifica a data de vencimento da conta
            $sql = "SELECT * FROM tbl_conta_pagar WHERE id_conta_pagar = :contaId";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(":contaId", $_POST["contaId"]);

            $stmt->execute();

            $row = $stmt->fetch();

            $dataAtual = date("Y-m-d");
            $dataVencimento = $row["data_pagar"];

            if ($dataAtual < $dataVencimento) {
                //Aplica o desconto de 5%
                $valorPago = $row["valor"] * 0.95;
            } else if ($dataAtual > $dataVencimento) {
                //Aplica o acréscimo de 10% após a data de vencimento
                $valorPago = $row["valor"] * 1.10;
            } else if ($dataAtual == $dataVencimento) {
                //Não aplica desconto nem acréscimo
                $valorPago = $row["valor"];
            }

            //Atualiza o status da conta para pago
            $sql = "UPDATE tbl_conta_pagar SET pago = 1, valor_pago = :valorPago WHERE id_conta_pagar = :contaId";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(":valorPago", $valorPago);
            $stmt->bindParam(":contaId", $_POST["contaId"]);

            $stmt->execute();

            $rowCount = $stmt->rowCount();
            if ($rowCount > 0) {
                $response = array("status" => 1, "message" => "Conta paga com sucesso: R$ " . number_format($valorPago, 2, ",", "."));
            } else {
                $response = array("status" => 0, "message" => "Erro ao pagar conta!");
            }
        }
    } catch (PDOException $e) {
        $response = array("status" => 0, "message" => "Erro no banco de dados: " . $e->getMessage());
    }
} else {
    $response = array("status" => 0, "message" => "Ocorreu um erro.");
}

echo json_encode($response);
