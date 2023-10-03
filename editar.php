<?php
require_once 'config/conn.php';

$idContaPagar = $_GET["idContaPagar"];

$sql = "SELECT cp.*, te.nome AS nome_empresa 
        FROM tbl_conta_pagar cp
        INNER JOIN tbl_empresa te ON cp.id_empresa = te.id_empresa
        WHERE id_conta_pagar = :idContaPagar";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(":idContaPagar", $idContaPagar);
$stmt->execute();

$contasPagar = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contas a Pagar</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Mascara -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <!-- Scripts -->
    <script src="assets/script.js"></script>
</head>

<body>
    <div class="container mt-5">
        <a href="index.php" class="btn btn-primary">Voltar</a>
        <h1>Editar: <?= $contasPagar["nome_empresa"] ?></h1>

        <form id="formEditarConta">
            <div class="form-group">
                <input type="hidden" class="form-control" id="idContaPagar" name="idContaPagar" value="<?= $contasPagar["id_conta_pagar"] ?>">
            </div>
            <div class="form-group">
                <label for="dataPagamento">Data de Pagamento:</label>
                <input type="date" class="form-control" id="dataPagamento" name="dataPagamento" value="<?= $contasPagar["data_pagar"] ?>" required>
            </div>
            <div class="form-group">
                <label for="valorPagamento">Valor a ser pago (R$):</label>
                <input type="text" class="form-control money" id="valorPagamento" name="valorPagamento" required value="<?= $contasPagar["valor"] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Editar</button>
        </form>
</body>

</html>